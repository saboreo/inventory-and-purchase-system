
<?php require_once('../private/initialize.php'); 
require_login();
$employeeId = $_SESSION['admin_id'];
$id = $_GET['id'] ?? '1'; // PHP > 7.0 // if not found, assign value 1
?>

<?php 
$subject_set = find_itemSupplier_by_id($id);
$subject1_set = find_itemSupplier_by_fast_delivery($id);
$subject2_set = find_itemSupplier_by_low_price($id);
?>

<?php $page_title = 'Low Stock'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
          <a href="<?php echo url_for('stock-low.php'); ?>">Low Stock</a>
          </li>
          <li class="breadcrumb-item active">Reorder</li>
        </ol>
        <!-- Page Content -->
        <h3>Available Stock for Reordering.</h3>
        <hr>
      </div>

    <script>
        $(document).ready(function(){
            $("#second").hide();
            $("#third").hide();
        $("#one").click(function(){
            $("#main").show();
            $("#second").hide();
            $("#third").hide();
        });
        $("#two").click(function(){
            $("#second").show();
            $("#main").hide();
            $("#third").hide();
        });
        $("#three").click(function(){
            $("#third").show();
            $("#main").hide();
            $("#second").hide();
        });
        });
    </script>

    <div class="container">
        <button  id="one" class="col-sm-2 btn btn-success">Available Stock</button>
        <button  id="two" class="col-sm-2 btn btn-success">Fastest Delivery</button>
        <button id="three" class="col-sm-2 btn btn-success">Lowest Price</button>
    </div>
    
    <div id="main" class="container">
        <table class="table table-striped">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Supplier</th>
                    <th>Postal Code</th>
                    <th>Price</th>
                    <th>Delivery Days</th>
                    <th></th>
                    </tr>
                </thead>
            <tbody>
            <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
                <tr>
                <td><?php echo h($page['itemId']); ?></td>
                <td><?php echo h($page['supplierName']); ?></td>
                <td><?php echo h($page['postalCode']); ?></td>
                <td>£<?php echo h($page['currentPrice']); ?></td>
                <td><?php echo h($page['deliveryDays']); ?></td>
                <td><a class="action" href="<?php echo url_for('/order-new.php?id=' . h(u($page['itemId'])) . '&po=' . h(u($page['postalCode'])) . '&dd=' . h(u($page['deliveryDays'])) ); ?>">Order</a></td>
                </tr>
            <?php } ?>
            </tbody>
            </table>
            <?php
             mysqli_free_result($subject_set); // free up the data set
            ?>
    </div>

    <div id="second" class="container">
        <table class="table table-striped">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Supplier</th>
                    <th>Postal Code</th>
                    <th>Price</th>
                    <th>Delivery Days</th>
                    <th></th>
                    </tr>
                </thead>
            <tbody>
            <?php while($page1 = mysqli_fetch_assoc($subject1_set)) { ?>
                <tr>
                <td><?php echo h($page1['itemId']); ?></td>
                <td><?php echo h($page1['supplierName']); ?></td>
                <td><?php echo h($page1['postalCode']); ?></td>
                <td>£<?php echo h($page1['currentPrice']); ?></td>
                <td><?php echo h($page1['deliveryDays']); ?></td>
                <td>
                <a class="action" href="<?php echo url_for('/order-new.php?id=' .h(u($page1['itemId'])). '&po=' .h(u($page1['postalCode'])) . '&dd=' . h(u($page1['deliveryDays'])) ); ?>">Order</a>
                </td>
                </tr>
            <?php } ?>
            </tbody>
            </table>
            <?php
             mysqli_free_result($subject1_set); // free up the data set
            ?>
    </div>

    <div id="third" class="container">
        <table class="table table-striped">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Supplier</th>
                    <th>Postal Code</th>
                    <th>Price</th>
                    <th>Delivery Days</th>
                    <th></th>
                    </tr>
                </thead>
            <tbody>
            <?php while($page2 = mysqli_fetch_assoc($subject2_set)) { ?>
                <tr>
                <td><?php echo h($page2['itemId']); ?></td>
                <td><?php echo h($page2['supplierName']); ?></td>
                <td><?php echo h($page2['postalCode']); ?></td>
                <td>£<?php echo h($page2['currentPrice']); ?></td>
                <td><?php echo h($page2['deliveryDays']); ?></td>
                <td><a class="action" href="<?php echo url_for('/order-new.php?id=' . h(u($page2['itemId'])) . '&po=' . h(u($page2['postalCode'])) . '&dd=' . h(u($page2['deliveryDays'])) ); ?>">Order</a></td>
                </tr>
            <?php } ?>
            </tbody>
            </table>
            <?php
             mysqli_free_result($subject2_set); // free up the data set
            ?>
    </div>
  </div>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>

