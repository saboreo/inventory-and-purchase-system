
<?php require_once('../private/initialize.php'); 
require_login();
?>

<?php
    $id = $_GET['id'] ?? '1'; // PHP > 7.0 // if not found, assign value 1
    $subject = find_all_itemdetails_by_id($id); //Extract data from array
    $subject_set = find_itemLocation_by_id($id);
?>

<?php $page_title = 'Item'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

    <div id="content-wrapper">
        <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="<?php echo url_for('index.php'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
            <a href="<?php echo url_for('stock.php'); ?>">Stock</a>
            </li>
            <li class="breadcrumb-item active">Item</li>
        </ol>
        <!-- Page Content -->
        <h1>Item: <?php echo $id;?></h1>
        <hr>
        </div>
        <div class="container">
            
            <form>
                <fieldset class="form-group">
                    <div class="row">


                    <label class="col-sm-4 col-form-label">Item ID:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['itemID']); ?>">
                    <br>
                    </div>


                    <label class="col-sm-4 col-form-label">Title:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['title']); ?>">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Category ID:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['categoryId']); ?>">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Current Price:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="£<?php echo h($subject['currentPrice']); ?>">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Selling State:</label>
                    <div class="col-sm-8">
                        <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" name="visible" readonly class="custom-control-input" id="customCheck" value="0"/>
                        <input type="checkbox" name="visible" readonly class="custom-control-input" id="customCheck" value="1" <?php if($subject['sellingstate'] == "Active") { echo " checked"; } ?> />
                        <label class="custom-control-label" for="customCheck">Active</label>
                        <br>
                        </div>
                    </div>

                    <label class="col-sm-4 col-form-label">Sale Title:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['saletitle']); ?>">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Top Rated:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['toprated'] == 1 ? 'Yes' : 'No'); ?>">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Reorder Level:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['reorder']); ?>">
                    <br>
                    </div>

                    <!-- <label class="col-sm-4 col-form-label">Sale ID:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['saleid']); ?>">
                    <br>
                    </div> -->

                    <label class="col-sm-4 col-form-label">Gallery File:</label>
                    <div class="col-sm-8">
                    <input type="text" readonly class="form-control" value="<?php echo h($subject['galleryfile']); ?>">
                    <br>
                    </div>

                    <label class="col-sm-4 col-form-label">Image:</label>
                    <div class="col-sm-8">
                    <img src="images/<?php echo h($subject['galleryfile']); ?>" alt="" width="200" height="140">
                    <br>
                    </div>

                </fieldset>
                <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Location</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                    <tbody>
                    <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
                    <tr>
                        <td><?php echo h($page['locationId']); ?></td>
                        <td><?php echo h($page['locationQuantity']); ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </form>

        </div>
    </div>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>