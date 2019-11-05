
<?php require_once('../private/initialize.php'); 
require_login();
$employeeId = $_SESSION['admin_id'];
?>

<?php $subject_set = find_low_stock_by_id($employeeId); 
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
          <li class="breadcrumb-item active">Low Stock</li>
        </ol>
        <!-- Page Content -->
        <h1>Low Stock</h1>
        <hr>
      </div>

      <div class="container">
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Item ID ..." title="Type in Item ID">
        <table class="table table-striped" id="myTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Reorder Level</th>
                    <th>In Stock</th>
                    <th></th>
                  </tr>
                </thead>
            <tbody>
            <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
              <tr>
                <td><?php echo h($page['itemId']); ?></td>
                <td><?php echo h($page['categoryId']); ?></td>
                <td>£<?php echo h($page['currentPrice']); ?></td>
                <td><?php echo h($page['reorder']); ?></td>
                <td><?php echo h($page['locationQuantity']); ?></td>
                <td><a class="action" href="<?php echo url_for('/order-reorder.php?id=' . h(u($page['itemId']))); ?>">Reorder</a></td>
                <!-- <td><a class="action" href="#">Edit</a></td> -->
              </tr>
            <?php } ?>
            </tbody>
          </table>
          <?php
            mysqli_free_result($subject_set); // free up the data set
          ?>
      </div>

  </div>
  <script>
      $(document).ready(function(){
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
    </script>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>