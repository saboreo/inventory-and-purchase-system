<?php require_once('../private/initialize.php'); 
require_login();
?>
<?php if ($_SESSION['permission'] < 3) { ?>
<?php $page_title = 'New-Category'; ?>
<?php include(SHARED_PATH . '/header.php'); 
$subject = find_all_employee();
?>

    <div id="content-wrapper">
        <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
            <a href="<?php echo url_for('category.php'); ?>">Categories</a>
            </li>
            <li class="breadcrumb-item active">Category:</li>
        </ol>
        <!-- Page Content -->
        <h1>New Category</h1>
        <hr>
        </div>
        <div class="container">

        <form  action="<?php echo url_for('/category-create.php'); ?>" method="post">
                <fieldset class="form-group">
                    <div class="row">
                       
                        <label class="col-sm-4 col-form-label">Category ID:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" name="categoryId" placeholder="183394" >
                        <br>
                        </div>

                        <label class="col-sm-4 col-form-label">Category Name:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" name="categoryName" placeholder="Outdoor String Lights">
                        <br>
                        </div>

                        <!-- <label class="col-sm-4 col-form-label">Employee ID:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" name="employeeId" >
                        <br>
                        </div> -->

                        <label class="col-sm-4 col-form-label">Select Employee ID:</label>
                        <div class="col-sm-8">
                        <select class="form-control" name="employeeId">
                            <?php while($page = mysqli_fetch_assoc($subject)) { ?>
                            <option>
                            <td><?php echo h($page['employeeId']); ?></td>
                            </option>
                            <?php } ?>
                        </select>
                        <br>
                        </div>

                    </div>
                    <button type="submit" name="addCategory" class="col-sm-2 btn btn-success">Add Category</button>
                </fieldset>
            </form>
        </div>
    </div>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
<?php } else {
    redirect_to(url_for('/index.php'));
    } ?>