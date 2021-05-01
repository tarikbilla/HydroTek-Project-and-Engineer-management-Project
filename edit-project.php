<?php require_once('header.php');?>

<?php 
  //if not logged in admin show message
if( !$user->is_logged_in_admin() ){ 
  echo '<h1 class="h1 text-center">You Are Not Allowed to This Page.<br>Please Contact With Admin.</h1>'; 
}
 
//get value from database
if (isset($_GET['pid'])) {

  foreach ($db->query('SELECT * FROM projects WHERE id='.$_GET['pid']) as $row) {
    $id = $row["id"];
    $title = $row["title"];
    $tender_no = $row["tender_no"];
    $bill_no = $row["bill_no"];
    $description = $row["description"];
  }
}

//if form has been submitted process it
if(isset($_POST['updateproject'])){

  try {

      //insert into database with a prepared statement
      $stmt = $db->prepare('UPDATE projects SET title=:title, tender_no=:tender_no, bill_no=:bill_no, description=:description WHERE id=:id');

      $stmt->execute(array(
        ':id' => $id,
        ':title' => $_POST["title"],
        ':tender_no' => $_POST["tender_no"],
        ':bill_no' => $_POST["bill_no"],
        ':description' => $_POST["description"]
      ));

      //redirect to index page
      header('Location: ?pid='.$id.'&action=success');
      exit;

    //else catch the exception and show the error.
    } catch(PDOException $e) {
        $error[] = $e->getMessage();
    }

}

 ?>
<?php if( $user->is_logged_in_admin() ){  ?>
        <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Project</h1>

    <div class="row">

      <div class="col-lg-12">

        <!-- Card  -->
        <div class="card shadow mb-4">
              
          <!-- Card Body -->
          <div class="card-body">
            <?php 
              //if action is joined show sucess
              if(isset($_GET['action']) && $_GET['action'] == 'success'){
                echo '<p class="h3 text-success">Update Successful. <a href="all-project.php" class=" btn btn-sm btn-primary shadow-sm"> Goto All Projects</a></p>';
              }
            ?>
            <form class="was-validated" method="post" action="">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="projectTitle">Title</label>
                  <input type="text" name="title" class="form-control" id="project_title" placeholder="Title" value="<?php if (isset($_GET['pid'])) {echo $title;} ?>" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="tenderNo">Tender No</label>
                  <input type="text" name="tender_no" class="form-control" id="tender_no" placeholder="Tender No" value="<?php if (isset($_GET['pid'])) {echo $tender_no;}?>" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="billNo">Bill No</label>
                  <input type="text" name="bill_no" class="form-control" id="bill_no" placeholder="Bill No" value="<?php if (isset($_GET['pid'])) {echo $bill_no;}?>" required>
                </div>
              </div>


              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="billNo">Description</label>
                  <textarea name="description" class="form-control is-invalid" id="" placeholder="Description here..."  required><?php if (isset($_GET['pid'])) {echo $description;}?></textarea>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-2">
                  <input type="submit" name="updateproject" value="Update" class="btn btn-primary btn-user btn-block">
                </div>
              </div>
              
            </form>

          </div>
        </div>

      </div>

    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php }else{echo '<div class="container-fluid h-75"></div>';} ?>
<?php require_once('footer.php');?>
