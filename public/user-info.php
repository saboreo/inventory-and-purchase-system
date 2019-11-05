<?php require_once('../private/initialize.php'); 
require_login();
$user = $_SESSION['admin_id'];
$subject = find_user($user);
?>

<?php $page_title = 'Employees'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Employee</li>
        </ol>
        <!-- Page Content -->
        <h1>Employee</h1>
        <hr>
      </div>

        <div class="container">
            <form>
                <fieldset class="form-group">
                    <div class="row">

                    <label class="col-sm-4 col-form-label">Employee ID:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['employeeId']); ?> ">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">First Name</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['firstName']); ?>">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['lastName']); ?>">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['email']); ?>">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Role</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['jobRole']); ?>">
                    <br>
                    </div>

                    </div>
                </fieldset>
            </form>
        </div>
  </div>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>