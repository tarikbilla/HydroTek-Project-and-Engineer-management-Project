<?php require_once('header.php');?>



        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Projects</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php total_Project($db);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total KD (All projects)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php total_kd($db);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Delivery (All Projects)</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php total_delivery($db);?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Due (All Products)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php total_due($db);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <!-- Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Projects</h3>
          </div>
          <!-- Content Row -->
          <div class="row">

           <?php foreach ($db->query('SELECT * FROM projects') as $row) {
              if(is_project_access($db,$row['id'],$_SESSION['username'] ) || $user->is_logged_in_admin()){
            ?>
            <!-- Project -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">
                    <a href="view-project.php?pid=<?php echo $row['id']; ?>"><?php echo substr($row["title"], 0,25)."..."; ?></a>
                  </h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                      <a class="dropdown-item" href="edit-project.php?pid=<?php echo $row['id']; ?>">Edit</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="view-project.php?pid=<?php echo $row['id']; ?>">View</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                  <!-- Content Row -->
                  <div class="row pb-3">
                    <div class="col-12">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Tender No: <?php echo $row["tender_no"]; ?></div>
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Bill No: <?php echo $row["bill_no"]; ?></div>
                      <div class="text-xs font-weight-bold mb-1"><?php echo substr($row["description"], 0,80)."..."; ?></div>
                    </div>
                  </div>
                  <!-- Content Row -->
                  <div class="row pb-3">
                    <!-- Total KD Card Example -->
                    <div class="col-xl-12 col-md-12 mb-12">
                      <div class="card border-left-primary h-100 py-2">
                        <div class="card-body py-0">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total KD</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php total_KD_of_a_Project($db,$row['id']);?></div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Content Row -->
                  <div class="row pb-3">
                    <!-- Total Delivary KD Card Example -->
                    <div class="col-xl-12 col-md-12 mb-12">
                      <div class="card border-left-success h-100 py-2">
                        <div class="card-body py-0">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Delivery KD</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php total_delivery_a_Project($db,$row['id']); ?></div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Content Row -->
                  <div class="row pb-3">
                    <!-- Total Due KD Card Example -->
                    <div class="col-xl-12 col-md-12 mb-12">
                       <div class="card border-left-warning h-100 py-2">
                        <div class="card-body py-0">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Due KD</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php total_due_a_Project($db,$row['id']); ?></div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                
                  <!-- Content Row -->
                  <div class="row pb-3">
                    <!-- Total Progress Card Example -->
                    <div class="col-xl-12 col-md-12 mb-12">
                      <div class="card border-left-info h-100 py-2">
                        <div class="card-body py-0">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Progress </div>
                              <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php total_percent_a_Project($db,$row['id']); ?>%</div>
                                </div>
                                <div class="col">
                                  <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php total_percent_a_Project($db,$row['id']); ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!-- /.end project-->
            <?php }}?>
           
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php require_once('footer.php');?>


      