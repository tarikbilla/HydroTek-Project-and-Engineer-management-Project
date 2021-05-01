<?php require_once('header.php');?>
<?php if(isset($_GET['pid'])){$_SESSION['project_id'] = $_GET['pid'];}?>

<?php 
if(is_project_access($db,$_SESSION['project_id'],$_SESSION['username'] ) || $user->is_logged_in_admin()){}else{
  header('Location: all-project.php');
}

//if add new user access
if(isset($_POST['addUser'])){

  try {

     
      //insert into database with a prepared statement
      $stmt = $db->prepare('INSERT INTO project_access(project_id, username, access_by) VALUES(:project_id, :username, :access_by)');
      $stmt->execute(array(
        ':project_id' => $_SESSION['project_id'],
        ':username' => $_POST["username"],
        ':access_by' => $_SESSION['username']
      ));

      //redirect to index page
      header('Location: view-project.php');
      exit;

    //else catch the exception and show the error.
    } catch(PDOException $e) {
        $error[] = $e->getMessage();
        echo 'error';
    }
}

//delete user access 
  if (isset($_GET['del']) && $user->is_logged_in_admin()) {
      try {
      //insert into database with a prepared statement
      $stmt = $db->prepare('DELETE FROM project_access WHERE id=:id');
      $stmt->execute(array(
        ':id' => $_GET["del"]
      ));

      //redirect to index page
      header('Location: view-project.php');
      exit;

    //else catch the exception and show the error.
    } catch(PDOException $e) {
        $error[] = $e->getMessage();
    }
  }

 ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <?php foreach ($db->query('SELECT * FROM projects WHERE id='.$_SESSION["project_id"]) as $row) { ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?php echo $row["title"]?></h1>
      <?php if( $user->is_logged_in_admin() ){?>
      <a href="add-item.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Add New Item</a>
      <?php } ?>
    </div>
  <div class="row pb-3">
    <div class="col-sm-8 ">
      <div class="font-weight-bold text-uppercase mb-1">
        <strong>Tender No:</strong> <?php echo $row["tender_no"]?>
      </div>
      <div class="font-weight-bold text-uppercase mb-1">
        <strong>Bill No:</strong> <?php echo $row["bill_no"]?>
      </div>
      <div class="font-weight-bold mb-1"><?php echo $row["description"]?></div>
    </div>

    <div class="col-sm-4 p-3 bg-light card">
      <?php if( $user->is_logged_in_admin() ){  ?>
      <div class="h5">Add Engineer This project</div>
      <form action="" method="post" class="" >
          <div class="input-group">
            <input type="text" name="username" class="form-control form-control-sm" id="" placeholder="Username">
            <button type="submit" name="addUser" class="btn btn-sm btn-primary input-group-append">Add</button>
          </div>
      </form>
      <?php } ?>

      <h6 class="h6 mt-1">Enginners for This Project:</h6>
      <div class="mt-1">
        <?php foreach ($db->query('SELECT * FROM project_access WHERE project_id='.$_SESSION["project_id"]) as $row) { ?>
        <a href="view-project.php?del=<?php echo $row['id'];?>" class="btn btn-sm btn-outline-primary mb-1"><?php echo $row["username"];?></a>
      <?php } ?>
      </div>

    </div>
  </div>
  <?php } ?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <?php
            //check for any errors
            if(isset($error)){
              foreach($error as $error){
                echo '<p class="text-danger">'.$error.'</p>';
              }
            }

            //if action is succes show sucess
            if(isset($_GET['action']) && $_GET['action'] == 'successItem'){
              echo "<p class='h3 text-success'>New Item Added Successful.</p>";
            }
            ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable"  cellspacing="0">
          <thead>
            <tr>
              <th>SL No.</th>
              <th>ITEM</th>
              <th>DESCRIPTION</th>
              <th>QTY</th>
              <th>UNIT</th>
              <th>UNIT RATE</th>
              <th>TOTAL KD</th>
              <th>Delivery</th>
              <th>Installatin</th>
              <th>Commissioning</th>
              <th>Total Progress</th>
              <th>Total Invoice</th>
              <th>Balance to be invoiced</th>
              <th>Balance Work</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th><?php total_KD_of_a_Project($db,$_SESSION['project_id']);?></th>
              <th><?php total_delivery_a_Project($db,$_SESSION['project_id']); ?></th>
              <th><?php total_installatin_a_Project($db,$_SESSION['project_id']); ?></th>
              <th><?php total_commissioning_a_Project($db,$_SESSION['project_id']); ?></th>
              <th><?php total_progress_a_Project($db,$_SESSION['project_id']); ?></th>
              <th><?php total_invoice_a_Project($db,$_SESSION['project_id']); ?></th>
              <th><?php total_BTBI_a_Project($db,$_SESSION['project_id']); ?></th>
              <th><?php total_balance_work_a_Project($db,$_SESSION['project_id']); ?></th>
            </tr>
          </tfoot>
          <tbody>
            <?php
              $count=0;
              foreach ($db->query('SELECT * FROM products WHERE project_id='.$_SESSION["project_id"]) as $row) {
              $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td>
                <a href="update-item.php?id=<?php echo $row['id']; ?>">
                  <?php echo $row['item']; ?>
                </a>
              </td>
              <td><?php echo $row['description']; ?></td>
              <td><?php echo $row['qty']; ?></td>
              <td><?php echo $row['unit']; ?></td> 
              <td><?php echo $row['unit_rate_kd']; ?></td>
              <td><?php echo $row['total_kd']; ?></td> 
              <td><?php echo $row['delivery']; ?></td>
              <td><?php echo $row['installatin']; ?></td> 
              <td><?php echo $row['commissioning']; ?></td>
              <td><?php echo $row['total_progress']; ?></td> 
              <td><?php echo $row['total_invoice']; ?></td>
              <td><?php echo $row['balance_tobe_invoiced']; ?></td>
              <td><?php echo $row['balance_work']; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
</div><!-- End of Main Content -->

<?php require_once('footer.php');?>
      