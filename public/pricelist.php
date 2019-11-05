<?php require_once('../private/initialize.php'); // read initializa.php file first
      require_login(); // require login function
?>
<?php $subject_set = find_all_itemSupplier(); ?> <!-- Assign variable to retrieved SQL data -->
<?php $page_title = 'Price List'; ?>
<?php include(SHARED_PATH . '/header.php'); ?> <!-- include header file -->
<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Supplier Price List</li>
        </ol>
        <!-- Page Content -->
        <h1>Supplier Price List</h1>
        <hr>
      </div>
      <div class="container">
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Item ID ..." title="Type in Item ID">
        <table class="table table-striped" id="myTable"><!-- Display table view -->
                <thead>
                  <tr>
                    <th>Item ID</th>
                    <th>Price</th>
                    <th>Supplier</th>
                    <th>Post Code</th>
                    <th>Delivery Days</th>
                  </tr>
                </thead>
            <tbody>
            <?php while($page = mysqli_fetch_assoc($subject_set)) { ?> <!-- loop by using function through array of data retrieved by SQL query -->
              <tr>
                <td><?php echo h($page['itemId']); ?></td> <!-- assign value from multidimensional array -->
                <td>£<?php echo h($page['currentPrice']); ?></td>
                <td><?php echo h($page['supplierName']); ?></td>
                <td><?php echo h($page['postalCode']); ?></td>
                <td><?php echo h($page['deliveryDays']); ?></td>
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
<?php include(SHARED_PATH . '/footer.php'); ?> <!-- include footer file -->