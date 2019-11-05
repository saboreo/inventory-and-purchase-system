<?php require_once('../private/initialize.php'); 
require_login();
?>

<?php $subject_set = find_cancelled_orders(); ?>

<?php $page_title = 'Orders'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Cancelled Orders</li>
        </ol>
        <!-- Page Content -->
        <h1>Cancelled Orders</h1>
        <hr>
      </div>
      <div class="container">
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for ID ..." title="Type in an ID">
        <table class="table table-striped" id="myTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Employee ID</th>
                    <th>Supplier</th>
                    <th>Created</th>
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
                <td><?php echo h($page['orderStatus']); ?></td>
                <td><a class="action" href="<?php echo url_for('/order-details.php?id=' . h(u($page['poID']))); ?>">View</a></td>
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