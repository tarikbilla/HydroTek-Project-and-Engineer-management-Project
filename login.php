<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TH Tech</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <!-- Php Code Here -->
  <?php
    //include config
    require_once('includes/config.php');

    //check if already logged in move to home page
    if($user->is_logged_in() ){ header('Location: index.php'); exit(); }

    //process login form if submitted
    if(isset($_POST['submit'])){

      if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
      if (!isset($_POST['password'])) $error[] = "Please fill out all fields";

      $username = $_POST['username'];
      if ( $user->isValidUsername($username)){
        if (!isset($_POST['password'])){
          $error[] = 'A password must be entered';
        }
        $password = $_POST['password'];

        if($user->login($username,$password)){
          $_SESSION['username'] = $username;
          header('Location: index.php');
          exit;

        } else {
          $error[] = 'Wrong username or password.';
        }
      }else{
        $error[] = 'Usernames are required to be Alphanumeric, and between 3-16 characters long';
      }

    }//end if submit
  ?>

  <!-- ./end php code -->



  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <div class="text-center">
                      <?php
                        //check for any errors
                        if(isset($error)){
                          foreach($error as $error){
                            echo '<p class="text-danger">'.$error.'</p>';
                          }
                        }

                        if(isset($_GET['action'])){

                          //check the action
                          switch ($_GET['action']) {
                            case 'active':
                              echo '<p class="text-danger">Your account is now active you may now log in.</p>';
                              break;
                            case 'reset':
                              echo '<p class="text-success">Please check your inbox for a reset link.</p>';
                              break;
                            case 'resetAccount':
                              echo '<p class="text-success">Password changed, you may now login.</p>';
                              break;
                          }

                        }

                        
                        ?>
                  </div>
                  <form class="user" role="form" method="post" action="">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" id="exampleInputUsername" aria-describedby="emailHelp" placeholder="Enter Username..." required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <input type="submit" name="submit" value="Login" class="btn btn-primary btn-user btn-block">
                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
