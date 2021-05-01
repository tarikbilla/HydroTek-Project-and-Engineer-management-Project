<?php require_once('header.php');?>

<?php 
//get value from database 
if (isset($_SESSION['project_id']) && isset($_GET['id'])) {

  foreach ($db->query('SELECT * FROM products WHERE project_id='.$_SESSION["project_id"].' and id='.$_GET['id']) as $row) {
      $id = $row['id'];
      $item = $row['item'];
      $description = $row['description'];
      $qty = $row['qty'];
      $unit = $row['unit'];
      $unit_rate_kd = $row['unit_rate_kd']; 
      $total_kd = $row['total_kd']; 
      $delivery = $row['delivery']; 
      $delivery_percent = $row['delivery_percent']; 
      $total_delivery_qty = $row['total_delivery_qty']; 
      $installatin = $row['installatin']; 
      $installatin_percent = $row['installatin_percent']; 
      $commissioning = $row['commissioning']; 
      $commissioning_percent = $row['commissioning_percent']; 
      $total_progress = $row['total_progress'];
      $total_invoice = $row['total_invoice']; 
      $balance_tobe_invoiced = $row['balance_tobe_invoiced'];
      $balance_work = $row['balance_work'];
  }
}

//if form has been submitted process it
if(isset($_POST['updateData'])){

  try {

      //insert into database with a prepared statement
      $stmt = $db->prepare('UPDATE products SET item=:item, description=:description, qty=:qty, unit=:unit, unit_rate_kd=:unit_rate_kd, total_kd=:total_kd, delivery=:delivery, total_delivery_qty=:total_delivery_qty, delivery_percent=:delivery_percent, installatin=:installatin, installatin_percent=:installatin_percent, commissioning=:commissioning, commissioning_percent=:commissioning_percent, total_progress=:total_progress, total_invoice=:total_invoice, balance_tobe_invoiced=:balance_tobe_invoiced, balance_work=:balance_work WHERE id=:id');

      $stmt->execute(array(
        ':id' => $_GET["id"],
      'item' => $_POST['item'],
      'description' => $_POST['description'],
      'qty' => $_POST['qty'],
      'unit' => $_POST['unit'],
      'unit_rate_kd' => $_POST['unit_rate_kd'], 
      'total_kd' => $_POST['total_kd'], 
      'total_delivery_qty' => $_POST['total_delivery_qty'], 
      'delivery' => $_POST['delivery'], 
      'delivery_percent' => $_POST['delivery_percent'], 
      'installatin' => $_POST['installatin'], 
      'installatin_percent' => $_POST['installatin_percent'], 
      'commissioning' => $_POST['commissioning'], 
      'commissioning_percent' => $_POST['commissioning_percent'], 
      'total_progress' => $_POST['total_progress'],
      'total_invoice' => $_POST['total_invoice'], 
      'balance_tobe_invoiced' => $_POST['balance_tobe_invoiced'],
      'balance_work' => $_POST['balance_work'],
      ));

      //update log data
      setLogData($db, $_SESSION['project_id'], "Update Item <a href='update-item.php?id=".$_GET["id"]."'>". $_POST['item']."</a>");
      //redirect to index page
      header('Location: ?id='.$id.'&action=success');
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
      <h1 class="h3 mb-4 text-gray-800">Add New Item</h1>

      <div class="row">

        <div class="col-lg-12">

        <!-- Card  -->
        <div class="card shadow mb-4">
              
          <!-- Card Body -->
          <div class="card-body">
            <?php 
              //if action is joined show sucess
              if(isset($_GET['action']) && $_GET['action'] == 'success'){
                echo '<p class="h3 text-success">Update Successful. <a href="view-project.php?pid='.$_SESSION['project_id'].'" class=" btn btn-sm btn-primary shadow-sm"> Goto Project</a></p>';
              }
            ?>
            <form class="was-validated" method="post" action="">
              <!-- row -->
              <div class="row pb-3">
                <!-- col -->
              <div class="col-lg-6">
                <div class="h5 mb-4 text-primary">Only For Admin</div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="itemLabel">ITEM</label>
                    <input type="text" name="item" class="form-control form-control-user" id="" placeholder="Item Here" value="<?php if (isset($_GET['id'])) {echo $item;} ?>"  required <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                  </div>
                </div>

                <div class="form-row pb-3">
                  <div class="form-group col-md-12">
                    <label for="billNo">Description</label>
                    <textarea name="description" class="form-control" id="" placeholder="Description here..." <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>><?php if (isset($_GET['id'])) {echo $description;} ?></textarea>
                  </div>
                </div>

                <div class="form-row pb-3">
                  <div class="form-group col-md-12">
                    <label for="billNo">QTY</label>
                    <input type="text" name="qty" class="form-control form-control-user" id="inQTY" onchange="getTotalKD()" placeholder="Enter QTY" value="<?php if (isset($_GET['id'])) {echo $qty;} ?>" required <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                  </div>
                </div>

                <div class="form-row pb-3">
                  <div class="form-group col-md-12">
                    <label for="billNo">UNIT</label>
                    <input type="text" name="unit" class="form-control form-control-user" id="inUNIT" onchange="getTotalKD()" placeholder="Unit here" value="<?php if (isset($_GET['id'])) {echo $unit;} ?>" required <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                  </div>
                </div>

                <div class="form-row pb-3">
                  <div class="form-group col-md-12">
                    <label for="billNo">UNIT RATE</label>
                    <input type="text" name="unit_rate_kd" class="form-control form-control-user" id="unitRate" onchange="getTotalKD()" placeholder="Unit Rate Here" value="<?php if (isset($_GET['id'])) {echo $unit_rate_kd;} ?>" required <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                  </div>
                </div>

                <div class="form-row pb-3">
                  <div class="form-group col-md-12">
                    <label for="billNo">TOTAL KD</label>
                    <input type="text" name="total_kd" class="form-control form-control-user" id="totalKD" onchange="setTotalKD()" placeholder="Total KD Here" value="<?php if (isset($_GET['id'])) {echo $total_kd;} ?>" required <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                  </div>
                </div>
              </div>

              <!-- col -->
              <div class="col-lg-6 border-left">
                <div class="h5 mb-4 text-primary">Admin & Engineer</div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="TotalInvoice">Total Delivery QTY</label>
                    <input type="number" name="total_delivery_qty" class="form-control form-control-user" id="total_delivery_qty" onchange="availableDeliveryqty()" value="<?php if (isset($_GET['id'])) {echo $total_delivery_qty;} ?>" placeholder="">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="remaining_qty">Remaining QTY</label>
                    <input type="text" name="remaining_qty" class="form-control form-control-user" id="remaining_qty" value="" placeholder="" disabled="">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="deliveryLabel">Delivery</label>
                    <div class="input-group mb-0">
                      <input type="text" name="delivery_percent" class="form-control col-sm-3" id="delPer" onchange="getDeliveryKD()" value="<?php if (isset($_GET['id'])) {echo $delivery_percent;} ?>" placeholder="Percent" aria-label="Username" aria-describedby="basic-addon1" required <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">%</span>
                      </div>
                      <input type="text" name="delivery" class="form-control form-control-user" id="delivery" placeholder="" value="<?php if (isset($_GET['id'])) {echo $delivery;} ?>" readonly>
                    </div>
                  </div>
                </div>

  
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="Installatin">Installatin</label>
                    <div class="input-group mb-0">
                      <input type="text" name="installatin_percent" class="form-control col-sm-3" placeholder="Percent" id="insPer" onchange="getInstallatinKD()" value="<?php if (isset($_GET['id'])) {echo $installatin_percent;} ?>" aria-label="Username" aria-describedby="basic-addon1" required <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">%</span>
                      </div>
                      <input type="text" name="installatin" class="form-control form-control-user" id="installatin" placeholder="" value="<?php if (isset($_GET['id'])) {echo $installatin;} ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="forCommissioning">Commissioning</label>
                    <div class="input-group mb-0">
                      <input type="text" name="commissioning_percent" class="form-control col-sm-3" placeholder="Percent" id="comPer" onchange="getCommissioningKD()" value="<?php if (isset($_GET['id'])) {echo $commissioning_percent;} ?>" aria-label="Username" aria-describedby="basic-addon1" required <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">%</span>
                      </div>
                      <input type="text" name="commissioning" class="form-control form-control-user" id="commissioning" value="<?php if (isset($_GET['id'])) {echo $commissioning;} ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="TotalProgress">Total Progress</label>
                    <input type="text" name="total_progress" class="form-control form-control-user" id="total_progress" value="<?php if (isset($_GET['id'])) {echo $total_progress;} ?>" placeholder="" <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="TotalInvoice">Total Invoice</label>
                    <input type="text" name="total_invoice" class="form-control form-control-user" id="total_invoice" value="<?php if (isset($_GET['id'])) {echo $total_invoice;} ?>" placeholder="" <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="Balancetobeinvoiced">Balance to be invoiced</label>
                    <input type="text" name="balance_to_be_inv" class="form-control form-control-user" value="<?php if (isset($_GET['id'])) {echo $balance_tobe_invoiced;} ?>" id="balance_to_be_inv" placeholder="" <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="TotalInvoice">Balance Work</label>
                    <input type="text" name="balance_work" class="form-control form-control-user" id="balance_work" value="<?php if (isset($_GET['id'])) {echo $balance_work;} ?>" placeholder="" <?php if(!$user->is_logged_in_admin()){echo 'readonly';}?>>
                  </div>
                </div>

              </div>
              </div>
              <!-- ./row -->


              <div class="form-row">
                <div class="form-group col-md-2" >
                  <input type="submit" name="updateData" value="Update"class="btn btn-primary btn-user btn-block">
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

<?php require_once('footer.php');?>
      