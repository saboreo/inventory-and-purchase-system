<?php

require_once('../private/initialize.php');

require_login();

if(is_post_request()) {
  $subject = [];
  $admin['firstName'] = $_POST['firstName'] ?? '';
  $admin['lastName'] = $_POST['lastName'] ?? '';
  $admin['email'] = $_POST['email'] ?? '';
  $admin['permission'] = $_POST['permission'] ?? '';
  $admin['jobRole'] = $_POST['jobRole'] ?? '';
  $admin['accountPassword'] = $_POST['accountPassword'] ?? '';
  $admin['confirm_accountPassword'] = $_POST['confirm_accountPassword'] ?? '';

  $result = insert_employee($admin);
  if($result === true) {
    $new_id = mysqli_insert_id($db); // get id from created user
    $_SESSION['message'] = 'Admin created.';
    redirect_to(url_for('employee.php'));
  } else {
    $errors = $result; // this not needed
    //redirect_to(url_for('index.php'));
  }

} else {
  // display the blank form
  $admin = [];
  $admin["firstName"] = '';
  $admin["lastName"] = '';
  $admin["email"] = '';
  $admin["jobRole"] = '';
  $admin["permission"] = '';
  $admin['accountPassword'] = '';
  $admin['confirm_accountPassword'] = '';
}

?>
<?php if ($_SESSION['permission'] == 1) { ?>


  <?php $page_title = 'Employee'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

    <div id="content-wrapper">
        <div class="container-fluid">

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
            <a href="<?php echo url_for('employee.php'); ?>">Employees</a>
            </li>
            <li class="breadcrumb-item active">Employee</li>
        </ol>

        <h1>Employee</h1>
        <?php echo display_errors($errors); ?>
        <hr>
        </div>
        <div class="container">

            <form action="<?php echo url_for('employee-new.php'); ?>" method="post">
                <fieldset class="form-group">
                    <div class="row">

                    <label class="col-sm-4 col-form-label">First Name</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?php echo h($admin['firstName']); ?>" name="firstName">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?php echo h($admin['lastName']); ?>" name="lastName">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Role</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?php echo h($admin['jobRole']); ?>" name="jobRole">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Permision Level:</label>
                    <div class="form-group col-sm-8">
                    <select class="form-control" id="exampleFormControlSelect1" name="permission">
                      <option>3</option>
                      <option>2</option>
                      <option>1</option>
                    </select>
                    <p>
                      Permission levels are: Admin level- 1; Management level- 2; Assistant level- 3.
                    </p>
                    </div>


                    <label class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" value="<?php echo h($admin['email']); ?>" name="email">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                    <input type="password" class="form-control" value="" name="accountPassword">
                    <br>
                    <p>
                      Must be at least 8 characters, 1 uppercase letter and 1 number.
                    </p>
                    </div>

                    <label class="col-sm-4 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                    <input type="password" class="form-control" value="" name="confirm_accountPassword">
                    <br>
                    </div>

                    </div>
                </fieldset>
                <input type="submit" class="btn btn-success" value="Create New Employee">
            </form>

        </div>
    </div>

    <?php } else {
    redirect_to(url_for('/index.php'));
    } ?>
<!-- # wrapper end bellow-->
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>