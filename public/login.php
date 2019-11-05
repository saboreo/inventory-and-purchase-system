<?php require_once('../private/initialize.php'); 
// login is not required to open this page
$errors = [];     // array to store error msg
$username = '';
$password = '';

if(is_post_request()) {     //if the form been submited the proceed bellow

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {   //if field is blank return error
    $errors[] = "Username can not be blank.";
  }
  if(is_blank($password)) {   //if field is blank return error
    $errors[] = "Password can not be blank.";
  }
  // if there were no errors, try to login

  if(empty($errors)) {
    // Using one variable ensures that msg is the same
    $login_failure_msg = "Login was unsuccessful.";

    $admin = find_employee_by_username($username); // pass the username to sql query and check if it returns true
    if($admin) {    // if true then ...

      if(password_verify($password, $admin['accountPassword'])) { //check if entered password matched with the password field in the DB
        // password matches
        log_in_admin($admin);     //try to login the user
        redirect_to(url_for('/index.php'));   // if true redirect to the main page
      } else {
        // username found, but password does not match
        $errors[] = $login_failure_msg;
      }

    } else {
      // no username found
      $errors[] = $login_failure_msg;
    }

  }

}
?>
<?php
  if(!isset($page_title)) {     // set page title
    $page_title = 'Watermill';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login - <?php echo h($page_title); ?></title>
  <link rel="stylesheet" href="<?php echo url_for('css/admin.css'); ?>">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Watermill - Login</div>
      <div class="card-body">

        <form action="<?php echo url_for('login.php'); ?>" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="username" id="inputEmail" class="form-control" placeholder="" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button><br>
          <?php echo display_errors($errors); ?>
        </form>
      </div>
    </div>
  </div>

  <div class="container-1">
    <img src="images/watermillF.png" class="rounded mx-auto d-block" alt="" width="320" height="236">
    <style>
      .container-1 {
          margin-top: 40px;
      }
    </style>
  </div>

</body>
</html>