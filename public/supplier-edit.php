
<?php require_once('../private/initialize.php'); 
require_login();
?>

<?php
    $id = $_GET['id'] ?? '1';

    $subject = find_supplier_by_id($id); //Extract data from array
    $subject_set = find_suppliercontact_by_id($id);
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
            <a href="<?php echo url_for('supplier.php'); ?>">Suppliers</a>
            </li>
            <li class="breadcrumb-item active">Supplier</li>
        </ol>
        <!-- Page Content -->
        <h1>Supplier:</h1>
        <hr>
        </div>
        <div class="container">
            <form>
                <fieldset class="form-group">
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Postal Code:</label>
                        <div class="col-sm-8">
                        <input type="text" readonly class="form-control" value="<?php echo h($subject['postalCode']); ?>">
                        <br>
                        </div>

                        <label class="col-sm-4 col-form-label">Name:</label>
                        <div class="col-sm-8">
                        <input type="text" readonly class="form-control" value="<?php echo h($subject['supplierName']); ?>">
                        <br>
                        </div>

                        <label class="col-sm-4 col-form-label">Address:</label>
                        <div class="col-sm-8">
                        <input type="text" readonly class="form-control" value="<?php echo h($subject['location']); ?>">
                        <br>
                        </div>

                        <label class="col-sm-4 col-form-label">Country:</label>
                        <div class="col-sm-8">
                        <input type="text" readonly class="form-control" value="<?php echo h($subject['country']); ?>">
                        <br>
                        </div>

                        <label class="col-sm-4 col-form-label">Delivery Days:</label>
                        <div class="col-sm-8">
                        <input type="text" readonly class="form-control" value="<?php echo h($subject['deliveryDays']); ?>">
                        <br>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Contact ID</th>
                            <th>Contact Name</th>
                            <th>Contact Position</th>
                            <th>Email </th>
                            <th>Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($page = mysqli_fetch_assoc($subject_set)) { ?>
                            <tr>
                            <td><?php echo h($page['contactId']); ?></td>
                            <td><?php echo h($page['contactName']); ?></td>
                            <td><?php echo h($page['contactPosition']); ?></td>
                            <td><?php echo h($page['email']); ?></td>
                            <td><?php echo h($page['phoneNumber']); ?></td>
                            
                            </tr>
                        <?php } ?>
                        </tbody>
                        </table>
                </fieldset>
            </form>
        </div>
    </div>
<!-- # wrapper end bellow-->
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>