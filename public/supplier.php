<?php require_once('../private/initialize.php'); 
require_login();
?>

<?php $subject_set = find_all_suppliers(); ?>

<?php $page_title = 'Suppliers'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Suppliers</li>
        </ol>
        <!-- Page Content -->
        <h1>Suppliers</h1>
        <hr>
      </div>
      
      <div class="container">
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Post Code ..." title="Type in the Post Code">
        <table class="table table-striped" id="myTable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Post Code</th>
                    <th>Location</th>
                    <th>Country</th>
                    <th>Delivery Days</th>
                    <th></th>
                  </tr>
                </thead>
            <tbody>
            <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
              <tr>
                <td><?php echo h($page['supplierName']); ?></td>
                <td><?php echo h($page['postalCode']); ?></td>
                <td><?php echo h($page['location']); ?></td>
                <td><?php echo h($page['country']); ?></td>
                <td><?php echo h($page['deliveryDays']); ?></td>
                <td><a class="action" href="<?php echo url_for('/supplier-edit.php?id=' . h(u($page['postalCode']))); ?>">View</a></td>
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

<?php ?>