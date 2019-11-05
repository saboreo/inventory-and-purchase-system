<?php require_once('../private/initialize.php'); 
require_login();
$employeeId = $_SESSION['admin_id'];
$po = $_GET['po'] ?? '1'; // supplier post code
$dd = $_GET['dd'] ?? '1'; // delivery days
$id = $_GET['id'] ?? '1'; // PHP > 7.0 // if not found, assign value 1 // item ID
$subject_set = find_item_from_pricelist_by_id($id, $po);
$blah = $id;

$addToOrder = find_existent_po($po);
//echo $addToOrder['poID'];

if (isset($_POST['new'])) {
  # NEW-button was clicked

  if(is_post_request()) {
    $order = [];
    $order['supplierPostalCode'] = $_POST['supplierPostalCode'] ?? '';
    $order['created'] = $_POST['created'] ?? '';
    $order['employeeId'] = $_POST['employeeId'] ?? '';
    $order['orderStatus'] = $_POST['orderStatus'] ?? '';
  
    $result = create_purchaseOrder($order);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      // if order is true then add item details to the db
      $order1['poID'] = $new_id ?? '';
      $order1['itemId'] = $_POST['itemId'] ?? '';
      $order1['quantity'] = $_POST['quantity'] ?? '';
      $result2 = create_poDetails($order1);
  
      // redirect_to(url_for('orders-unauthorised.php'));
      redirect_to(url_for('order-details.php?id=' . $new_id) );
    } else {
      // $errors = $result; // this not needed
      redirect_to(url_for('index.php'));
    }
  } else {
    // display the blank form
  }

}
elseif (isset($_POST['add'])) {
  # ADD-button was clicked
  if(is_post_request()) {
    $order1 = [];
    $order1['poID'] = $_POST['addToPO'] ?? '';
    $order1['itemId'] = $_POST['itemId'] ?? '';
    $order1['quantity'] = $_POST['quantity'] ?? '';
  
    $itemMatch = find_existent_item_in_poDetails($order1);
    if(isset($itemMatch)) {
      $result = add_poDetails($order1);
    } else {
      $addNext = create_poDetails($order1);
    }
    
    $insertedPo = $addToOrder['poID'];
    redirect_to(url_for('order-details.php?id=' . $order1['poID']) );

  } else {
    // $errors = $result; // this not needed
    redirect_to(url_for('index.php'));
  }
}



?>

<?php $page_title = 'New Order'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
          <a href="<?php echo url_for('stock-low.php'); ?>">Low Stock</a>
          </li>
          <li class="breadcrumb-item active">New Order</li>
        </ol>
        <!-- Page Content -->
        <h1>Order Details:</h1>
        <hr>
      </div>
      <div class="container">

        <form action="<?php echo url_for('order-new.php'); ?>" method="post">
            <fieldset class="form-group">
                <div class="row">
                    <label class="col-sm-4 col-form-label">Created:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h(date("Y-m-d")); ?>" name="created">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Supplier:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($po); ?>" name="supplierPostalCode">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Delivery Days:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($dd); ?>" name ="deliveryDays">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Employee:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($employeeId); ?>" name="employeeId">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Status:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="Unauthorised" name="orderStatus">
                    <br>
                    </div>


                    <?php if(isset($addToOrder['poID'])) { ?>
                      <label class="col-sm-4 col-form-label">Available Purchase Order to Use:</label>
                      <div class="col-sm-8">
                      <input type="text" readonly class="form-control" value="<?php echo h($addToOrder['poID']); ?>" name="addToPO">
                      <br>
                      </div>
                    <?php } ?>

                </div>

            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>Item ID</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
                        <tr>
                        <!-- <td><?php echo h($page['itemId']); ?></td> -->
                        <td><input type="text" readonly class="form-control" value="<?php echo h($page['itemId']); ?>" name="itemId"></td>
                        <td><input type="text" readonly class="form-control" value="£<?php echo h($page['currentPrice']); ?>" name="price">
                        </td>
                        <td><input type="text" class="form-control" value="1" name="quantity"></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php
                mysqli_free_result($subject_set); // free up the data set
            ?>

            </fieldset>
            <!--<button type="submit" name="order-new" class="col-sm-2 btn btn-success">Create New Order</button> -->
            <input type="submit" class="col-sm-2 btn btn-success" name="new" value="Create New Order">
            <?php if(isset($addToOrder['poID'])) { ?>
              <input type="submit" class="col-sm-2 btn btn-success" name="add" value="Add to Available PO">

            <!--<a type="action" href="<?php echo url_for('/order-combine.php?ItemID=' . h(u($id)) . '&supplier=' . h($po) . '&poID=' . h(u($addToOrder['poID'])) . '&qty=' . $_SESSION['qty'] = $_POST['quantity'] ); ?>" class="col-sm-2 btn btn-success">Add to Available PO</a> -->
            <?php } ?>
        </form>

      </div>
    </div>
<!-- # wrapper end bellow-->
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>