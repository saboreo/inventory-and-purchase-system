<?php require_once('../private/initialize.php'); 
require_login();
?>

<?php $subject_set = find_all_sale(); ?>

<?php $page_title = 'Sales'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Sales</li>
        </ol>
        <!-- Page Content -->
        <h1>Sales</h1>
        <hr>
      </div>

      <div class="container">
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Item ID ..." title="Type in Item ID">
        <table class="table table-striped" id="myTable">
                <thead>
                  <tr>
                    <th>Sale ID</th>
                    <th>Discount</th>
                    <!-- <th>Category ID</th> -->
                    <th>Item ID</th>
                    <!-- <th>Category Name</th> -->
                    <th>Start</th>
                    <th>End</th>
                    <?php if ($_SESSION['permission'] < 3) { ?>
                    <th></th>
                    <?php } ?>
                    <!-- <th></th>
                    <th></th> -->
                  </tr>
                </thead>
            <tbody>
            <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
              <tr>
                <td><?php echo h($page['saleId']); ?></td>
                <td><?php echo h($page['discount']); ?>%</td>
                <!-- <td><?php echo h($page['categoryId']); ?></td> -->
                <td><?php echo h($page['itemId']); ?></td>
                <!-- <td><?php echo h($page['categoryName']); ?></td> -->
                <td><?php echo h($page['startDate']); ?></td>
                <td><?php echo h($page['endDate']); ?></td>
                <?php if ($_SESSION['permission'] < 3) { ?>
                <td><a class="action" href="<?php echo url_for('/sale-edit.php?id=' . h(u($page['saleId']))); ?>">Edit</a></td>
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
  <script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }
    </script>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>