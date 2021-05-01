<?php require_once('header.php');?> 

<?php

//if not logged in admin show message
if( !$user->is_logged_in_admin() ){ 
  echo '<h1 class="h1 text-center">You Are Not Allowed to Create a User<br>Please Contact With Admin</h1>'; 
}

//if form has been submitted process it
if(isset($_POST['submit'])){

    if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['email'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['password'])) $error[] = "Please fill out all fields";

  $username = $_POST['username'];

  //very basic validation
  if(!$user->isValidUsername($username)){
    $error[] = 'Usernames must be at least 3 Alphanumeric characters';
  } else {
    $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
    $stmt->execute(array(':username' => $username));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($row['username'])){
      $error[] = 'Username provided is already in use.';
    }

  }

  if(strlen($_POST['password']) < 3){
    $error[] = 'Password is too short.';
  }

  if(strlen($_POST['passwordConfirm']) < 3){
    $error[] = 'Confirm password is too short.';
  }

  if($_POST['password'] != $_POST['passwordConfirm']){
    $error[] = 'Passwords do not match.';
  }

  //email validation
  $email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $error[] = 'Please enter a valid email address';
  } else {
    $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
    $stmt->execute(array(':email' => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($row['email'])){
      $error[] = 'Email provided is already in use.';
    }

  }


  //if no errors have been created carry on
  if(!isset($error)){

    //hash the password
    $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

    //create the activasion code
    $activasion = md5(uniqid(rand(),true));

    try {

      //insert into database with a prepared statement
      $stmt = $db->prepare('INSERT INTO members (rules,username,password,email,first_name,last_name,active,creator_admin_username) VALUES (:rules, :username, :password, :email, :fname, :lname, :active, :creator_admin_username)');
      $stmt->execute(array(
        ':rules' => $_POST["userroles"],
        ':username' => $username,
        ':password' => $hashedpassword,
        ':email' => $email,
        ':fname' => $_POST["fname"],
        ':lname' => $_POST["lname"],
        ':active' => $activasion,
        ':creator_admin_username' => $_SESSION['username']
      ));
      $id = $db->lastInsertId('memberID');

      //send email
      $to = $_POST['email'];
      $subject = "Registration Confirmation";
      $body = "<p>Welcome to Our software.<br>Login Details:</p><p>Usernames:". $username."<br>Password:". $_POST['password']."</p>";

      $mail = new Mail();
      $mail->setFrom(SITEEMAIL);
      $mail->addAddress($to);
      $mail->subject($subject);
      $mail->body($body);
      $mail->send();

      //redirect to index page
      header('Location: add-user.php?action=joined');
      exit;

    //else catch the exception and show the error.
    } catch(PDOException $e) {
        $error[] = $e->getMessage();
    }

  }

}


?>

<?php if( $user->is_logged_in_admin() ){  ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800">Add New User</h1>

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
          if(isset($_GET['action']) && $_GET['action'] == 'joined'){
            echo "<p class='h3 text-success'>Registration Successful. Send Welcome Email to This User.</p>";
          }
          ?>
            <form class="was-validated" role="form" method="post" action="">
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="firstName">First Name</label>
                    <input type="text" name="fname" class="form-control form-control-user" id="" placeholder="First Name" required>
                </div>
                <div class="col-sm-6">
                <label for="lastName">Last Name</label>
                    <input type="text" name="lname" class="form-control form-control-user" id="" placeholder="Last Name" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                <label for="lastName">Username</label>
                    <input type="text" name="username" class="form-control form-control-user" id="" placeholder="Username" required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="firstName">Email</label>
                    <input type="email" name="email" class="form-control form-control-user" id="" placeholder="Email Address" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="password">Password</label>
                    <input type="password" name="password" class="form-control form-control-user" id="" placeholder="Password" required>
                </div>
                <div class="col-sm-6">
                <label for="confirmPassword">Cofirm Password</label>
                    <input type="password" name="passwordConfirm" class="form-control form-control-user" id="" placeholder="Repeat Password" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                <label for="userRulse">User Rules</label>
                  <select name="userroles" class="custom-select" required>
                    <option value="">Select Rules</option>
                    <option value="engineer">Engineer</option>
                    <option value="admin">Admin</option>
                    <option value="other">Other</option>
                  </select>
                </div>

               <!--  <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="profilePicture">Select Profile Picture</label>  
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile">
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                  </div>
                </div> -->
              </div>

              <div class="form-row">
                <div class="form-group col-md-2">
                  <input type="submit" name="submit" value="Add User" class="btn btn-primary btn-user btn-block">
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
      