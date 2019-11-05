<?php require_once('../private/initialize.php'); 
require_login();
?>
<?php if ($_SESSION['permission'] == 1) { ?>
<?php $subject_set = find_all_employee(); ?>

<?php $page_title = 'Employees'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Employees</li>
        </ol>
        <!-- Page Content -->
        <h1>Employees</h1>
        <hr>
      </div>
      <div class="container">
        <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                  </tr>
                </thead>
            <tbody>
            <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
              <tr>
                <td><?php echo h($page['employeeId']); ?></td>
                <td><?php echo h($page['firstName']); ?></td>
                <td><?php echo h($page['lastName']); ?></td>
                <td><?php echo h($page['email']); ?></td>
                <td><?php echo h($page['jobRole']); ?></td>
                <td><a class="action" href="<?php echo url_for('/employee-edit.php?id=' . h(u($page['employeeId']))); ?>">Edit</a></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          <?php
            mysqli_free_result($subject_set); // free up the data set
          ?>
          <a href="<?php echo url_for('employee-new.php'); ?>" class="btn btn-success" role="button">Add New Employee</a>
      </div>
  </div>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>

<?php } else {
    redirect_to(url_for('/index.php'));
    } ?>