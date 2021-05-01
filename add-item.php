<?php require_once('header.php');?>
<?php 
//if not logged in admin show message
if( !$user->is_logged_in_admin() ){ 
  echo '<h1 class="h1 text-center">You Are Not Allowed To This Page.<br>Please Contact With Admin.</h1>'; 
}
 
//if form has been submitted process it
if(isset($_POST['additem']) && isset($_SESSION['project_id'])){

  try {
     
      //insert into database with a prepared statement
      $stmt = $db->prepare('INSERT INTO products(project_id,creator_admin_uname,created_date,created_time,item,description,qty,unit,unit_rate_kd,total_kd) VALUES (:pid, :creator_admin_uname, :created_date, :created_time, :item, :description, :qty, :unit, :unit_rate_kd, :total_kd)');
      $stmt->execute(array(
        ':pid' => $_SESSION['project_id'],
        ':creator_admin_uname' => $_SESSION['username'],
        ':created_date' => date('d-m-Y'),
        ':created_time' => date("h:i:s"),
        ':item' => $_POST["item"],
        ':description' => $_POST["description"],
        ':qty' => $_POST["qty"],
        ':unit' => $_POST["unit"],
        ':unit_rate_kd' => $_POST["unit_rate"],
        ':total_kd' => $_POST["total_kd"]
      ));
      $id = $db->lastInsertId('id');
      //update log data
      setLogData($db, $_SESSION['project_id'], "Add Item <a href='update-item.php?id=".$id."'>". $_POST['item']."</a>");
      //redirect to index page
      header('Location: view-project.php?action=successItem');
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
      <h1 class="h3 mb-4 text-gray-800">Add New Item</h1>

      <div class="row">

        <div class="col-lg-12">

        <!-- Card  -->
        <div class="card shadow mb-4">
              
          <!-- Card Body -->
          <div class="card-body">
            <form class="was-validated" role="form" method="post" action="">
              <!-- row -->
              <div class="row pb-3">
                <!-- col -->
              <div class="col-lg-6">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="itemLabel">ITEM</label>
                    <input type="text" name="item" class="form-control form-control-user" id="" placeholder="Item Here" required>
                  </div>
                </div>

                <div class="form-row pb-3">
                  <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control is-invalid" id="" placeholder="Description here..." required></textarea>
                  </div>
                </div>

                <div class="form-row pb-3">
                  <div class="form-group col-md-6">
                    <label for="forQTY">QTY</label>
                    <input type="text" name="qty" class="form-control form-control-user" id="inQTY"  onchange="getTotalKD()" placeholder="Enter QTY" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="forUnit">UNIT</label>
                    <input type="text" name="unit" value="0" class="form-control form-control-user" id="inUNIT"  onchange="getTotalKD()" placeholder="Unit here">
                  </div>
                </div>

                <div class="form-row pb-3">
                  <div class="form-group col-md-6">
                    <label for="forUnitRate">UNIT RATE</label>
                    <input type="text" name="unit_rate" class="form-control form-control-user" id="unitRate" onchange="getTotalKD()" placeholder="Unit Rate Here" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="forTotalKD">TOTAL KD</label>
                    <input type="text" name="total_kd" class="form-control form-control-user" id="totalKD" onchange="setTotalKD()" placeholder="Total KD Here" required>
                  </div>
                </div>
              </div>
              </div>
              <!-- ./row -->


              <div class="form-row">
                <div class="form-group col-md-2" >
                  <input type="submit" name="additem" value="Add Item"class="btn btn-primary btn-user btn-block ">
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
      