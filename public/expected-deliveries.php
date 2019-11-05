
<?php require_once('../private/initialize.php'); ?>

<?php 
  $subject_set = find_expect_delivery();
  $subject_set1 = find_expect_delivery_this_week();
?>

<?php $page_title = 'Expect Delivery'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">To be Delivered</li>
        </ol>
        <!-- Page Content -->
        <h1>To be Delivered:</h1>
        <hr>
      </div>

      <div class="container">
        <button  id="one" class="col-sm-2 btn btn-success">All Deliveries</button>
        <button  id="two" class="col-sm-2 btn btn-success">Next 7 Days</button>
    </div>

      <div id="main" class="container">
        <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Po ID</th>
                    <th>Created</th>
                    <th>Delivery Days</th>
                    <th>Expected Delivery</th>
                    <th>Order Status</th>
                    <!-- <th></th> -->
                  </tr>
                </thead>
            <tbody>
            <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
              <tr>
                <td><?php echo h($page['poID']); ?></td>
                <td><?php echo h($page['created']); ?></td>
                <td><?php echo h($page['deliveryDays']); ?></td>
                <td><?php echo h($page['expectDelivery']); ?></td>
                <td><?php echo h($page['orderStatus']); ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          <?php
            mysqli_free_result($subject_set); // free up the data set
          ?>
      </div>

      <script>
        $(document).ready(function(){
              $("#second").hide();
          $("#one").click(function(){
              $("#second").hide();
              $("#main").show();
          });
          $("#two").click(function(){
              $("#main").hide();
              $("#second").show();
          });
        });
    </script>

      <div id="second" class="container">
        <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Po ID</th>
                    <th>Created</th>
                    <th>Delivery Days</th>
                    <th>Expected Delivery</th>
                    <th>Order Status</th>
                    <!-- <th></th> -->
                  </tr>
                </thead>
            <tbody>
            <?php while($page = mysqli_fetch_assoc($subject_set1)) { ?>
              <tr>
                <td><?php echo h($page['poID']); ?></td>
                <td><?php echo h($page['created']); ?></td>
                <td><?php echo h($page['deliveryDays']); ?></td>
                <td><?php echo h($page['expectDelivery']); ?></td>
                <td><?php echo h($page['orderStatus']); ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          <?php
            mysqli_free_result($subject_set1); // free up the data set
          ?>
      </div>

  </div>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>