<?php require_once('../private/initialize.php'); 
require_login();

$employeeId = $_SESSION['admin_id'];


?>

<?php $page_title = 'Dashboard'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

  <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo url_for('/index.php'); ?>">Dashboard</a>
            </li>
          </ol>
        </div>

        <div class="container">
        <div class="row">

<div class="col-xl-3 col-sm-6 mb-3">
  <div class="card text-white bg-primary o-hidden h-100">
    <div class="card-body">
      <div class="card-body-icon">
        <i class="fas fa-fw fa-comments"></i>
      </div>
      <div class="mr-5">0 - New Messages!</div>
    </div>
    <a class="card-footer text-white clearfix small z-1" href="#">
      <span class="float-left">View Details</span>
      <span class="float-right">
        <i class="fas fa-angle-right"></i>
      </span>
    </a>
  </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
  <div class="card text-white bg-warning o-hidden h-100">
    <div class="card-body">
      <div class="card-body-icon">
        <i class="fab fa-react"></i>
      </div>

      <?php if ($_SESSION['permission'] == 3) { ?>
      <?php $subject = count_low_stock_by_id($employeeId); ?>
      <div class="mr-5"><?php echo $subject['x']; ?> - Item(s) Low in Stock!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo url_for('/stock-low.php'); ?>">
      

      <?php }  else { ?>
        <?php $subject2 = count_low_stock(); ?>
        <div class="mr-5"><?php echo $subject2['x']; ?> - Item(s) Low in Stock!</div>
        </div>
    <a class="card-footer text-white clearfix small z-1" href="<?php echo url_for('/stock-low-all.php'); ?>">
      <?php } ?>


      <span class="float-left">View Details</span>
      <span class="float-right">
        <i class="fas fa-angle-right"></i>
      </span>
    </a>
  </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
  <div class="card text-white bg-success o-hidden h-100">
    <div class="card-body">
      <div class="card-body-icon">
        <i class="fas fa-fw fa-shopping-cart"></i>
      </div>
      <?php $orders = count_unauthorised_orders(); ?>
      <div class="mr-5"><?php echo $orders['x']; ?> - Orders to Authorise!</div>
    </div>
    <a class="card-footer text-white clearfix small z-1" href="<?php echo url_for('/orders-unauthorised.php'); ?>">
      <span class="float-left">View Details</span>
      <span class="float-right">
        <i class="fas fa-angle-right"></i>
      </span>
    </a>
  </div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
  <div class="card text-white bg-danger o-hidden h-100">
    <div class="card-body">
      <div class="card-body-icon">
        <i class="fas fa-fw fa-life-ring"></i>
      </div>
      <?php $orders = count_deliveries_today(); ?>
      <div class="mr-5"><?php echo $orders['x']; ?> - Delivery(ies) Today!</div>
    </div>
    <a class="card-footer text-white clearfix small z-1" href="<?php echo url_for('/expected-deliveries.php'); ?>">
      <span class="float-left">View Details</span>
      <span class="float-right">
        <i class="fas fa-angle-right"></i>
      </span>
    </a>
  </div>
</div>

</div>
</div>




  </div>




<!-- # wrapper end -->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>