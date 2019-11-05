<?php require_once('../private/initialize.php'); 
require_login();
?>
<?php if ($_SESSION['permission'] < 3) { ?>
<?php
    // $id = $_GET['id'] ?? '1';

    $subject = find_all_item(); //Extract data from array
?>
<?php $page_title = 'New Sale'; ?>
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
            <li class="breadcrumb-item active">New Sale</li>
        </ol>
        <!-- Page Content -->
        <h1>New Sale:</h1>
        <hr>
        </div>
        <div class="container">

            <form action="<?php echo url_for('/sale-create.php'); ?>" method="post">
                <fieldset class="form-group">
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Discount %:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="15" name="discount">
                        <br>
                        </div>

                        <label class="col-sm-4 col-form-label">Select Item ID: (select one)</label>
                        <div class="col-sm-8">
                        <select class="form-control" name="itemId">
                            <?php while($page = mysqli_fetch_assoc($subject)) { ?>
                            <option>
                            <td><?php echo h($page['itemId']); ?></td>
                            </option>
                            <?php } ?>
                        </select>
                        <br>
                        </div>
                        
                        <label class="col-sm-4 col-form-label">Start Date:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="2019-03-10" name="startDate">
                        <br>
                        </div>
                        <label class="col-sm-4 col-form-label">End Date:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="2019-03-17" name="endDate">
                        <br>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="col-sm-2 btn btn-success">Submit</button>
            </form>
        </div>
    </div>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
<?php } else {
    redirect_to(url_for('/index.php'));
    } ?>