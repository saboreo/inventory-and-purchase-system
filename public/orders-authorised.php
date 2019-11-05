<?php require_once('../private/initialize.php'); 
require_login();
?>

<?php $subject_set = find_authorised_orders(); ?>

<?php $page_title = 'Orders'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Authorised Orders</li>
        </ol>
        <!-- Page Content -->
        <h1>Authorised Orders</h1>
        <hr>
      </div>
      <div class="container">
        <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Employee ID</th>
                    <th>Supplier</th>
                    <th>Created</th>
                    <th>Expexted Delivery</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
            <tbody>
            <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
              <tr>
                <td><?php echo h($page['poID']); ?></td>
                <td><?php echo h($page['employeeId']); ?></td>
                <td><?php echo h($page['supplierPostalCode']); ?></td>
                <td><?php echo h($page['created']); ?></td>
                <td><?php echo h($page['expectedDelivery']); ?></td>
                <td><?php echo h($page['orderStatus']); ?></td>
                <?php if ($_SESSION['permission'] < 3) { ?>
                <td><a class="action" href="<?php echo url_for('/order-status-limited.php?id=' . h(u($page['poID']))); ?>">Edit</a></td>
                <?php } else { ?>
                <td><a class="action" href="<?php echo url_for('/order-details.php?id=' . h(u($page['poID']))); ?>">View</a></td>
                <?php } ?>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          <?php
            mysqli_free_result($subject_set); // free up the data set
          ?>
      </div>
  </div>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>