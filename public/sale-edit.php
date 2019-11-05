<?php require_once('../private/initialize.php'); 
require_login();
?>
<?php if ($_SESSION['permission'] < 3) { ?>
<?php
    $id = $_GET['id'] ?? '1';
    // $subject = find_sale_by_id($id); //Extract data from array


    if(is_post_request()) {

        $subject = [];
        $subject['id'] = $id;
        $subject['discount'] = $_POST['discount'] ?? '';
        // $subject['categoryId'] = $_POST['categoryId'] ?? '';
        $subject['itemId'] = $_POST['itemId'] ?? '';
        $subject['startDate'] = $_POST['startDate'] ?? '';
        $subject['endDate'] = $_POST['endDate'] ?? '';

        // $discount = $_POST['discount'] ?? '';
        // $categoryId = $_POST['categoryId'] ?? '';
        // $startDate = $_POST['startDate'] ?? '';
        // $endDate = $_POST['endDate'] ?? '';
        $result = update_sale($subject);
        // $result = update_sale($id, $discount, $categoryId, $startDate, $endDate);
        redirect_to(url_for('/sale.php'));

    } else {
        // redirect_to(url_for('/index.php'));
        $subject = find_sale_by_id($id); //Extract data from array
    }

?>
<?php include(SHARED_PATH . '/header.php'); ?>

    <div id="content-wrapper">
        <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
            <a href="<?php echo url_for('sale.php'); ?>">Sales</a>
            </li>
            <li class="breadcrumb-item active">Edit Sale</li>
        </ol>
        <!-- Page Content -->
        <h1>Edit Sale: <?php echo $id;?></h1>
        <hr>
        </div>
        <div class="container">

            <form action="<?php echo url_for('/sale-edit.php?id=' .h(u($id))); ?>" method="post">
                <fieldset class="form-group">
                    <div class="row">
                        <!-- <label class="col-sm-4 col-form-label">Sale ID:</label>
                        <div class="col-sm-8">
                        <input type="text" readonly class="form-control" value="<?php echo h($subject['saleId']); ?>">
                        <br>
                        </div> -->

                        <label class="col-sm-4 col-form-label">Discount %:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?php echo h($subject['discount']); ?>" name="discount">
                        <br>
                        </div>

                        <!-- <label class="col-sm-4 col-form-label">Category ID:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?php echo h($subject['categoryId']); ?>" name="categoryId">
                        <br>
                        </div> -->

                        <label class="col-sm-4 col-form-label">Item ID:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?php echo h($subject['itemId']); ?>" name="itemId">
                        <br>
                        </div>

                        <!-- <label class="col-sm-4 col-form-label">Select Category ID: (select one)</label>
                        <div class="col-sm-8">
                        <select class="form-control" name="categoryId" value="" name="categoryId">
                        <?php $subject_set = find_all_category();?> //Extract data from array
                        <td><?php echo h($subject['categoryId']); ?></td>
                            <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
                            <option>
                            <td><?php echo h($page['categoryId']); ?></td>
                            </option>
                            <?php } ?>
                        </select>
                        <br>
                        </div> -->

                        <label class="col-sm-4 col-form-label">Start Date:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?php echo h($subject['startDate']); ?>" name="startDate">
                        <br>
                        </div>

                        <label class="col-sm-4 col-form-label">End Date:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?php echo h($subject['endDate']); ?>" name="endDate">
                        <br>
                        </div>
                    </div>
                </fieldset>
                <button type="update" class="col-sm-2 btn btn-success">Update</button>
            </form>

        </div>
    </div>
<!-- # wrapper end bellow
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>

<?php } else {
    redirect_to(url_for('/index.php'));
    } ?>