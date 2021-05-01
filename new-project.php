<?php require_once('header.php');?>

<?php 
//if not logged in admin show message
if( !$user->is_logged_in_admin() ){ 
  echo '<h1 class="h1 text-center">You Are Not Allowed to Create a Project.<br>Please Contact With Admin.</h1>'; 
}
 
//if form has been submitted process it
if(isset($_POST['addproject'])){

  try {

      //insert into database with a prepared statement
      $stmt = $db->prepare('INSERT INTO projects (title,tender_no,bill_no,description,creator_admin_username) VALUES (:title, :tender_no, :bill_no, :description, :creator_admin_username)');
      $stmt->execute(array(
        ':title' => $_POST["title"],
        ':tender_no' => $_POST["tender_no"],
        ':bill_no' => $_POST["bill_no"],
        ':description' => $_POST["description"],
        ':creator_admin_username' => $_SESSION['username']
      ));
      $id = $db->lastInsertId('id');

      //redirect to index page
      header('Location: new-project.php?action=success');
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
    <h1 class="h3 mb-4 text-gray-800">Create New Project</h1>

    <div class="row">

      <div class="col-lg-12">

        <!-- Card  -->
        <div class="card shadow mb-4">
              
          <!-- Card Body -->
          <div class="card-body">
            <?php
            //check for any errors
            if(isset($error)){
              foreach($error as $error){
                echo '<p class="text-danger">'.$error.'</p>';
              }
            }

            //if action is joined show sucess
            if(isset($_GET['action']) && $_GET['action'] == 'success'){
              echo "<p class='h3 text-success'>New Project Created Successful.</p>";
            }
            ?>
            <form class="was-validated" role="form" method="post" action="" autocomplete="off">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="projectTitle">Title</label>
                  <input type="text" name="title" class="form-control" id="project_title" placeholder="Title Here.." required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="tenderNo">Tender No</label>
                  <input type="text" name="tender_no" class="form-control" id="tender_no" placeholder="Tender No" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="billNo">Bill No</label>
                  <input type="text" name="bill_no" class="form-control" id="bill_no" placeholder="Bill No" required>
                </div>
              </div>


              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="billNo">Description</label>
                  <textarea name="description" class="form-control is-invalid" id="" placeholder="Description here..." required></textarea>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-2">
                  <input type="submit" name="addproject" value="Create" class="btn btn-primary btn-user btn-block">
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
