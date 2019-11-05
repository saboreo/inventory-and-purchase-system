<?php require_once('../private/initialize.php'); 
require_login();
?>
<?php if ($_SESSION['permission'] < 3) { ?>
<?php 
$id = $_GET['id'] ?? '1'; // PHP > 7.0 // if not found, assign value 1
$subject_set = find_poDetails_by_id($id);
$subject = mysqli_fetch_assoc($subject_set);
$subject_set1 = find_poDetails_by_id($id);
 //Extract data from array


if(is_post_request()) {

    while($page = mysqli_fetch_assoc($subject_set1)) {
        global $db;
        $sql = "UPDATE itemLocation SET ";
        $sql .= "locationQuantity= locationQuantity + '" . db_escape($db, $page['quantity']) . "' ";
        $sql .= "WHERE itemId='" . db_escape($db, $page['itemId']) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
    }

    if($result) {
      //return true;
      redirect_to(url_for('/orders-delivered.php'));
  } else {
      // if update failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
  }

} else {
// redirect_to(url_for('/index.php'));
// $subject_set = find_poDetails_by_id($id); //Extract data from array
    //echo 'oops, this didnt work ...';
}
?>

<?php $page_title = 'Order Details'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('orders-unauthorised.php'); ?>">Unauthorised Orders</a>
          </li>
          <li class="breadcrumb-item active">Order Details</li>
        </ol>
        <!-- Page Content -->
        <h1>Order Details: <?php echo $id?></h1>
        <hr>
      </div>
      <div class="container">

        <form>
          <fieldset class="form-group">
              <div class="row">
                <label class="col-sm-4 col-form-label">Order ID:</label>
                <div class="col-sm-8">
                <input type="text" readonly class="form-control" value="<?php echo $id; ?>">
                <br>
                </div>

                <label class="col-sm-4 col-form-label">Created:</label>
                <div class="col-sm-8">
                <input type="text" readonly class="form-control" value="<?php echo h($subject['created']); ?>">
                <br>
                </div>

                <label class="col-sm-4 col-form-label">Supplier:</label>
                <div class="col-sm-8">
                <input type="text" readonly class="form-control" value="<?php echo h($subject['supplierPostalCode']); ?>">
                <br>
                </div>

                <label class="col-sm-4 col-form-label">Delivery Days:</label>
                <div class="col-sm-8">
                <input type="text" readonly class="form-control" value="<?php echo h($subject['deliveryDays']); ?>">
                <br>
                </div>

                <label class="col-sm-4 col-form-label">Employee:</label>
                <div class="col-sm-8">
                <input type="text" readonly class="form-control" value="<?php echo h($subject['employeeName']); ?>">
                <br>
                </div>

                <?php 
                  $subject_set = find_poDetails_by_id($id);
                  $maybe=0;
                  while($page = mysqli_fetch_assoc($subject_set)) {
                    $maybe += $page['total'];
                  }
                ?>

                <label class="col-sm-4 col-form-label">Grand Total:</label>
                <div class="col-sm-8">
                <input type="text" readonly class="form-control" value="£<?php echo $maybe; ?>">
                <br>
                </div>

                <label class="col-sm-4 col-form-label">Status:</label>
                <div class="col-sm-8">
                <input type="text" readonly class="form-control" value="<?php echo h($subject['orderStatus']); ?>">
                <br>
                </div>

              </div>
          </fieldset>
        </form>

      <?php $subject_set = find_poDetails_by_id($id); ?>
      <form action="<?php echo url_for('order-details-update.php?id=' .h(u($id)) ); ?>" method="post">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Total Price</th>
            </tr>
          </thead>
          <tbody>
          <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
            <tr>
              <td><?php echo h($page['itemId']); ?></td>
              <td><?php echo h($page['quantity']); ?></td>
              <td>£<?php echo h($page['currentPrice']); ?></td>
              <td>£<?php echo h($page['total']); ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
        <td><button type="submit" class=" btn btn-success">Update Stock Levels</button></td>
        </form>
          <?php
            mysqli_free_result($subject_set); // free up the data set
          ?>
      </div>
    </div>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
<?php } else {
    redirect_to(url_for('/index.php'));
    } ?>