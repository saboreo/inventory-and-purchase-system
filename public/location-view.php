<?php require_once('../private/initialize.php'); 
require_login();
?>

<?php 
$id = $_GET['id'] ?? '02-01-01';
$subject_set = find_items_by_locationId($id);

if(is_post_request()) {

    $item = [];
    $item['id'] = $id;
    $item['itemId'] = $_POST['itemId'] ?? '';
    $item['locationQuantity'] = $_POST['qty'] ?? '';
    $result = update_itemLocation_by_id($item);
    redirect_to(url_for('/location-view.php?id=' . h(u($id)) ));
    // redirect_to(url_for('/orders-unauthorised.php'));
  } else {
    // redirect_to(url_for('/index.php'));
    // $subject_set = find_poDetails_by_id($id); //Extract data from array
  }
?>


<?php $page_title = 'Location-View'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?php echo url_for('location.php'); ?>">Locations</a>
          </li>
          <li class="breadcrumb-item active">Location-View</li>
        </ol>
        <!-- Page Content -->
        <h1>Location - View</h1>
        <hr>
      </div>
      <div class="container">

        <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Item ID</th>
                    <th>Title</th>
                    <th>Quantity</th>
                    <?php if ($_SESSION['permission'] < 3) { ?>
                    <th></th>
                    <?php } ?>
                  </tr>
                </thead>
            <tbody>
            <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
            <tr>
            <form action="<?php echo url_for('/location-view.php?id=' .h(u($id))); ?>" method="post">
                    <td><input type="text" readonly class="form-control " value="<?php echo h($page['itemId']); ?>" name="itemId"></td>
                    <!-- <td><input type="text" readonly class="form-control " value="<?php echo h($page['title']); ?>"></td> -->
                    <td><?php echo h($page['title']); ?></td>
                    <?php if ($_SESSION['permission'] < 3) { ?>
                    <td><input type="text" class="form-control " value="<?php echo h($page['locationQuantity']); ?>" name="qty"></td>
                    <td><button type="submit" class="btn btn-success">Update</button></td>
                    <?php } else { ?>
                    <td><input type="text" readonly class="form-control " value="<?php echo h($page['locationQuantity']); ?>"></td>
                    <?php } ?>
                    </form>
            </tr>
            <?php } ?>
            </tbody>
          </table>

          <?php
            mysqli_free_result($subject_set); // free up the data set
          ?>
      </div>
  </div>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>