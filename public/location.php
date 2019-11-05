<?php require_once('../private/initialize.php'); 
require_login();
?>

<?php $subject_set = find_all_location(); ?>

<?php $page_title = 'Locations'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Locations</li>
        </ol>
        <!-- Page Content -->
        <h1>Locations</h1>
        <hr>
      </div>
      <div class="container">
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Location ID ..." title="Type in Location ID">
        <table class="table table-striped" id="myTable">
                <thead>
                  <tr>
                    <th>Location ID</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th></th>
                    <!-- <th></th>
                    <th></th> -->
                  </tr>
                </thead>
            <tbody>
            <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
              <tr>
                <td><?php echo h($page['locationId']); ?></td>
                <td><?php echo h($page['locationDescription']); ?></td>
                <td><?php echo h($page['locationStatus'] == 1 ? 'Active' : 'Disabled'); ?></td>
                <td><a class="action" href="<?php echo url_for('/location-view.php?id=' . h(u($page['locationId']))); ?>">View</a></td>
                <!-- <td><a class="action" href="<?php echo url_for('/pages/edit.php?id=' . h(u($page['id']))); ?>">Edit</a></td> -->
                <!-- <td><a class="action" href="">Delete</a></td> -->
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
        td = tr[i].getElementsByTagName("td")[0];
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