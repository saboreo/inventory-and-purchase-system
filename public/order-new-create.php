<?php  require_once('../private/initialize.php');

require_login();

if(is_post_request()) {
    $order = [];
    $order['supplierPostalCode'] = $_POST['supplierPostalCode'] ?? '';
    $order['created'] = $_POST['created'] ?? '';
    $order['employeeId'] = $_POST['employeeId'] ?? '';
    $order['orderStatus'] = $_POST['orderStatus'] ?? '';
  
    $result = create_purchaseOrder($order);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      // if order is true then add item details to the db
      $orderDetails = [];
      $orderDetails['poID'] = $new_id ?? '';
      $orderDetails['itemId'] = $id ?? '';
      $orderDetails['quantity'] = $_POST['quantity'] ?? '1';
      $result2 = create_poDetails($orderDetails);
  
      // redirect_to(url_for('orders-unauthorised.php'));
    } else {
      // $errors = $result; // this not needed
      redirect_to(url_for('index.php'));
    }
  
  } else {
    // display the blank form
  //   $subject = [];
  //   $subject["supplierPostalCode"] = '';
  //   $subject["created"] = '';
  //   $subject["email"] = '';
  //   $subject["jobRole"] = '';
  //   $subject["permission"] = '';
  //   $subject['accountPassword'] = '';
  //   $subject['confirm_accountPassword'] = '';
  }

?>