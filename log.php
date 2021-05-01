<?php require_once('header.php');?>


  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Activity</h1>
    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Activity Data</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Date</th>
                <th>Time</th>
                <th>IP Address</th>
                <th>User</th>
                <th>ProjectID</th>
                <th>Detils</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Date</th>
                <th>Time</th>
                <th>IP Address</th>
                <th>User</th>
                <th>ProjectID</th>
                <th>Detils</th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach ($db->query('SELECT * FROM log ORDER BY id DESC') as $row) {?>
              <tr>
                <td><?php echo $row["date_log"]; ?></td>
                <td><?php echo $row["time_log"]; ?></td>
                <td><?php echo $row["ip_address"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td>
                <?php if ($row['project_id']==0) {
                  echo '-';
                } else{?><a href="view-project.php?pid=<?php echo $row['project_id'];?>"><?php echo $row["project_id"]; ?></a><?php } ?></td>
                <td><?php echo $row["details"]; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->
  </div>  <!-- End of Main Content -->

<?php require_once('footer.php');?>
      