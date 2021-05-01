<?php require_once('header.php');?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">All User</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <?php if( $user->is_logged_in_admin() ){echo '<th>Username</th>';} ?>
              <th>Email</th>
              <th>Phone No</th>
              <th>Rules</th>
              <th>Create By</th>
              <?php if( $user->is_logged_in_admin() ){echo '<th>Action</th>';} ?>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <?php if( $user->is_logged_in_admin() ){echo '<th>Username</th>';} ?>
              <th>Email</th>
              <th>Phone No</th>
              <th>Rules</th>
              <th>Create By</th>
              <?php if( $user->is_logged_in_admin() ){echo '<th>Action</th>';} ?>
              
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($db->query('SELECT * FROM members') as $row) {?>
            <tr>
              <td><?php echo $row["memberID"]; ?></td>
              <td><?php echo $row["first_name"]." ".$row["last_name"];?></td>
              <?php if( $user->is_logged_in_admin() ){?>
                <td><?php echo $row["username"]; ?></td>
              <?php } ?>
              <td><?php echo $row["email"]; ?></td>
              <td><?php echo $row["phone_no"]; ?></td>
              <td><?php echo $row["rules"]; ?></td>
              <td><?php echo $row["creator_admin_username"]; ?></td>
              <?php if( $user->is_logged_in_admin() ){?>
                <td><a href="update-profile.php?id=<?php echo $row['memberID'];?>" class="btn btn-sm btn-primary">Edit</a></td>
              <?php } ?>
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
      