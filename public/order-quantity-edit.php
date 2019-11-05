<?php require_once('../private/initialize.php'); 
require_login();

if (is_get_request()) {
    $po = $_GET['po'] ?? '1';
    $itemId = $_GET['item'] ?? '1';
    $qty = $_GET['quantity'] ?? '1';

    $result = update_order_quantity($qty, $po, $itemId);
    // $new_id = mysqli_insert_id($db); // this is to fetch newly created ID
    redirect_to(url_for('/order-status-edit.php?id=' . $po));
    // redirect_to(url_for('/sale-edit.php?id=' . $new_id)); // Assign newly created ID as a page ID

} else {
    redirect_to(url_for('/index.php'));
}

?>