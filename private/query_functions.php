<?php

    function find_all_suppliers() {
        global $db;
        
        $sql = "SELECT * FROM supplier ";
        $sql .= "ORDER BY supplierName ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_all_category() {
        global $db;
        $sql = "SELECT * FROM category ";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_category_ids() {
        global $db;
        $sql = "SELECT categoryId FROM category ";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_all_item() {
        global $db;
        $sql = "SELECT * FROM item ";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_item_from_pricelist_by_id($id, $po) {
        global $db;
        $sql = "SELECT * FROM itemsupplier WHERE itemId= '" . db_escape($db, $id) . "' AND postalCode='" . db_escape($db, $po) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_all_itemdetails_by_id($id) {
        global $db;
        $sql = "SELECT item.itemID, item.title, item.categoryId, item.currentPrice, item.galleryfile, item.sellingstate, item.saletitle, "; 
        $sql .= "item.toprated, item.saleid, item.reorder, itemlocation.locationId, itemlocation.locationQuantity ";    
        $sql .= "FROM item ";
        $sql .= "JOIN itemlocation ON item.itemID = itemlocation.itemID ";
        $sql .= "WHERE item.itemID='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $subject; // returns an assoc. full array
    }

    function find_itemLocation_by_id($id) {
        global $db;
        $sql = "SELECT * FROM itemLocation ";
        $sql .= "WHERE itemID='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_items_by_locationId($id) {
        global $db;
        $sql = "SELECT itemLocation.itemId, item.title, itemlocation.locationQuantity ";
        $sql .= "FROM itemLocation ";
        $sql .= "INNER JOIN item ON itemLocation.itemId = item.itemId ";
        $sql .= "WHERE locationId ='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function update_itemLocation_by_id($item) {
        global $db;
        $sql = "UPDATE itemLocation SET ";
        $sql .= "locationQuantity='" .  db_escape($db, $item['locationQuantity']) . "' ";
        $sql .= "WHERE locationId='" . db_escape($db, $item['id']) . "' AND itemId='" . db_escape($db, $item['itemId']) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            // if update failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function find_all_itemSupplier() {
        global $db;
        $sql = "SELECT itemsupplier.itemId, itemsupplier.currentPrice, itemsupplier.postalCode, supplier.supplierName, supplier.deliveryDays ";
        $sql .= "FROM itemSupplier ";
        $sql .= "INNER JOIN supplier ON itemsupplier.postalCode = supplier.postalCode ";
        $sql .= "ORDER BY itemsupplier.itemId;";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_itemSupplier_by_id($id) {
        global $db;
        $sql = "SELECT itemsupplier.itemId, supplier.supplierName, supplier.postalCode, itemsupplier.currentPrice, supplier.deliveryDays ";
        $sql .= "FROM itemSupplier ";
        $sql .= "JOIN supplier ON itemsupplier.postalCode = supplier.postalCode ";
        $sql .= "WHERE itemId = '" . db_escape($db, $id) . "' ";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_itemSupplier_by_fast_delivery($id) {
        global $db;
        $sql = "SELECT itemsupplier.itemId, supplier.supplierName, supplier.postalCode, ";
        $sql .= "itemsupplier.currentPrice,supplier.deliveryDays ";
        $sql .= "FROM itemsupplier ";
        $sql .= "JOIN supplier ON itemsupplier.postalCode = supplier.postalCode ";
        $sql .= "WHERE itemId = '" . db_escape($db, $id) . "' ";
        $sql .= "order by deliveryDays, currentPrice asc limit 1 ";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_itemSupplier_by_low_price($id) {
        global $db;
        $sql = "SELECT itemsupplier.itemId, supplier.supplierName, supplier.postalCode, ";
        $sql .= "itemsupplier.currentPrice, supplier.deliveryDays ";
        $sql .= "FROM itemsupplier ";
        $sql .= "JOIN supplier ON itemsupplier.postalCode = supplier.postalCode ";
        $sql .= "WHERE itemId = '" . db_escape($db, $id) . "' ";
        $sql .= "order by currentPrice, deliveryDays asc limit 1 ";

        
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_all_location() {
        global $db;
        $sql = "SELECT * FROM location ";
        $sql .= "ORDER BY locationId ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_all_employee() {
        global $db;
        $sql = "SELECT employeeId, firstName, lastName, email, jobRole ";
        $sql .= "FROM employee ";
        $sql .= "ORDER BY employeeId;";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_employee_by_id($id) {
        global $db;

        $sql = "SELECT * FROM employee ";
        $sql .= "WHERE employeeId='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $subject; // returns an assoc. full array
    }

    function update_employee($subject) {
        global $db;
        $sql = "UPDATE employee SET ";
        $sql .= "firstName='" . db_escape($db, $subject['firstName']) . "',";
        $sql .= "lastName='" . db_escape($db, $subject['lastName']) ."',";
        $sql .= "email='" . db_escape($db, $subject['email']) ."',";
        $sql .= "jobRole='" . db_escape($db, $subject['jobRole']) ."' ";
        $sql .= "WHERE employeeId='" . db_escape($db, $subject['id']) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        if($result) {
            return true;
        } else {
            // if update failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function find_all_sale() {
        global $db;
        $sql = "SELECT * FROM sale;";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_sale_by_id($id) {
        global $db;

        $sql = "SELECT * FROM sale ";
        $sql .= "WHERE saleId='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $subject; // returns an assoc. full array
    }

    function find_supplier_by_id($id) {
        global $db;
        
        $sql = "SELECT * FROM supplier ";
        $sql .= "WHERE postalCode='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $subject; // returns an assoc. full array
    }

    function find_suppliercontact_by_id($id) {
        global $db;
        $sql = "SELECT * FROM supplierContact ";
        $sql .= "WHERE supplierPostalCode='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_unauthorised_orders() {
        global $db;
        $sql = "SELECT poID, employeeId, supplierPostalCode, created, orderStatus ";
        $sql .= "FROM purchaseOrder ";
        $sql .= "WHERE orderStatus = 'Unauthorised';";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function update_order_status($order_status) {
        global $db;
        $sql = "UPDATE purchaseOrder SET ";
        $sql .= "orderStatus='" .  db_escape($db, $order_status['status']) . "' ";
        $sql .= "WHERE poID='" . db_escape($db, $order_status['id']) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            // if update failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_order_status_delivered($order_status) {
        global $db;
        $sql = "UPDATE purchaseOrder SET ";
        $sql .= "orderStatus='" .  db_escape($db, $order_status['status']) . "', ";
        $sql .= "deliveredOn= CURDATE() ";
        $sql .= "WHERE poID='" . db_escape($db, $order_status['id']) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            // if update failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_order_quantity($qty, $po, $itemId) {
        global $db;
        $sql = "UPDATE poDetails SET ";
        $sql .= "quantity='" .  db_escape($db, $qty) . "' ";
        $sql .= "WHERE poID='" . db_escape($db, $po) . "' AND itemId='" . db_escape($db, $itemId) . "' ";
        $sql .= "LIMIT 1";

        echo $sql;

        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            // if update failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function find_last_month_orders() {
        global $db;
        $sql = "SELECT poID, employeeId, supplierPostalCode, created, orderStatus, ";
        $sql .= "DATE_ADD(purchaseorder.created, INTERVAL supplier.deliveryDays DAY) AS 'expectedDelivery',deliveredOn ";
        $sql .= "FROM purchaseOrder ";
        $sql .= "JOIN supplier ON purchaseOrder.supplierpostalCode = supplier.postalCode ";
        $sql .= "WHERE YEAR(created) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) ";
        $sql .= "AND MONTH(created) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH);";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_authorised_orders() {
        global $db;
        $sql = "SELECT poID, employeeId, supplierPostalCode, created, orderStatus, ";
        $sql .= "DATE_ADD(purchaseorder.created, INTERVAL supplier.deliveryDays DAY) AS 'expectedDelivery' ";
        $sql .= "FROM purchaseOrder ";
        $sql .= "JOIN supplier ON purchaseOrder.supplierpostalCode = supplier.postalCode ";
        $sql .= "WHERE orderStatus = 'Authorised';";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_cancelled_orders() {
        global $db;
        $sql = "SELECT poID, employeeId, supplierPostalCode, created, orderStatus ";
        $sql .= "FROM purchaseOrder ";
        $sql .= "WHERE orderStatus = 'Cancelled';";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_delivered_orders() {
        global $db;
        $sql = "SELECT poID, employeeId, supplierPostalCode, created, ";
        $sql .= "DATE_ADD(purchaseorder.created, INTERVAL supplier.deliveryDays DAY) AS 'expectedDelivery',deliveredOn, orderStatus ";
        $sql .= "FROM purchaseOrder ";
        $sql .= "JOIN supplier ON purchaseOrder.supplierpostalCode = supplier.postalCode ";
        $sql .= "WHERE orderStatus = 'Delivered';";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_poDetails_by_id($id) {
        global $db;
        $sql = "SELECT poDetails.poID, poDetails.itemId, poDetails.quantity, purchaseOrder.created, purchaseOrder.orderStatus, ";
        $sql .= "purchaseOrder.employeeId, purchaseOrder.supplierPostalCode, supplier.deliveryDays, ";
        $sql .= "concat(employee.firstName,' ', employee.lastName) AS 'employeeName', ";
        $sql .= "itemSupplier.currentPrice, ";
        $sql .= "round(itemSupplier.currentPrice*poDetails.quantity, 2) AS 'total' ";
        $sql .= "FROM poDetails ";
        $sql .= "INNER JOIN purchaseOrder ON  poDetails.poID=purchaseOrder.poID ";
        $sql .= "INNER JOIN supplier ON purchaseOrder.supplierPostalCode=supplier.postalCode ";
        $sql .= "INNER JOIN employee ON purchaseOrder.employeeId = employee.employeeId ";
        $sql .= "INNER JOIN itemSupplier ON poDetails.itemId=itemSupplier.itemId AND purchaseOrder.supplierPostalCode = itemsupplier.postalCode ";
        $sql .= "WHERE purchaseOrder.poID='" . db_escape($db, $id) . "' ";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result; // returns an assoc. full array
    }

    function create_sale($discount, $itemId, $startDate, $endDate) {
        global $db;
        $sql = "INSERT INTO sale ";
        $sql .= "(discount, itemId, startDate, endDate) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $discount) . "',";
        $sql .= "'" . db_escape($db, $itemId) . "',";
        $sql .= "'" . db_escape($db, $startDate) . "',";
        $sql .= "'" . db_escape($db, $endDate) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);
        //for insert statements $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_sale($subject) {
        global $db;
        $sql = "UPDATE sale SET ";
        $sql .= "discount='" . db_escape($db, $subject['discount']) . "',";
        // $sql .= "categoryId='" .$subject['categoryId'] ."',";
        $sql .= "itemId='" . db_escape($db, $subject['itemId']) ."',";
        $sql .= "startDate='" . db_escape($db, $subject['startDate']) ."',";
        $sql .= "endDate='" . db_escape($db, $subject['endDate']) ."' ";
        $sql .= "WHERE saleId='" . db_escape($db, $subject['id']) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            // if update failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function add_new_category($categoryId, $categoryName, $employeeId) {
        global $db;
        $sql = "INSERT INTO category (categoryId, categoryName, employeeId) ";
        $sql .="VALUES (";
        $sql .="$categoryId,";
        $sql .="'$categoryName', ";
        $sql .="'$employeeId'";
        $sql .=")";
        $result = mysqli_query($db, $sql);

        if ($result) {
            return true;

        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function create_purchaseOrder($order) {
        global $db;
        $sql = "INSERT INTO purchaseOrder ";
        $sql .= "(supplierPostalCode, created, employeeId, orderStatus) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $order['supplierPostalCode']) . "',";
        $sql .= "'" . db_escape($db, $order['created']) . "',";
        $sql .= "'" . db_escape($db, $order['employeeId']) . "',";
        $sql .= "'" . db_escape($db, $order['orderStatus']) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);
    
        // For INSERT statements, $result is true/false
        if($result) {
          return true;
        } else {
          // INSERT failed
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function create_poDetails($order1) {
        global $db;
        $sql = "INSERT INTO poDetails ";
        $sql .= "(poID, itemId, quantity) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $order1['poID']) . "',";
        $sql .= "'" . db_escape($db, $order1['itemId']) . "',";
        $sql .= "'" . db_escape($db, $order1['quantity']) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);
    
        // For INSERT statements, $result is true/false
        if($result) {
          return true;
        } else {
          // INSERT failed
          echo mysqli_error($db);
          db_disconnect($db);
        //   echo '-- ' , $sql;
          exit;
        }
    }

    function find_existent_po($po) {
        global $db;
        $sql = "SELECT poID, supplierPostalCode, created, employeeId, orderStatus ";
        $sql .= "FROM purchaseOrder ";
        $sql .= "WHERE supplierPostalCode ='" . db_escape($db, $po) . "' ";
        $sql .= "AND orderStatus = 'Unauthorised'; ";    
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $admin = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $admin;
    }
    
    function find_existent_item_in_poDetails($order1) {
        global $db;
        $sql = "SELECT * ";
        $sql .= "FROM podetails ";
        $sql .= "WHERE poID= '" . db_escape($db, $order1['poID']) . "' ";   
        $sql .= "AND itemId = '" . db_escape($db, $order1['itemId']) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $admin = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $admin;
    }

    function add_poDetails($order1) {
        global $db;
        $sql = "UPDATE poDetails ";
        $sql .= "SET quantity = quantity + '" . db_escape($db, $order1['quantity']) . "' ";
        $sql .= "WHERE poID = '" . db_escape($db, $order1['poID']) . "' ";   
        $sql .= "AND itemId = '" . db_escape($db, $order1['itemId']) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
    
        // For INSERT statements, $result is true/false
        if($result) {
          return true;
        } else {
          // INSERT failed
          echo mysqli_error($db);
          db_disconnect($db);
        //   echo '-- ' , $sql;
          exit;
        }
    }

    function validate_admin($admin) {

        if(is_blank($admin['firstName'])) {
          $errors[] = "First name cannot be blank.";
        } elseif (!has_length($admin['firstName'], array('min' => 2, 'max' => 255))) {
          $errors[] = "First name must be between 2 and 255 characters.";
        }
    
        if(is_blank($admin['lastName'])) {
          $errors[] = "Last name cannot be blank.";
        } elseif (!has_length($admin['lastName'], array('min' => 2, 'max' => 255))) {
          $errors[] = "Last name must be between 2 and 255 characters.";
        }
    
        if(is_blank($admin['email'])) {
          $errors[] = "Email cannot be blank.";
        } elseif (!has_length($admin['email'], array('max' => 255))) {
          $errors[] = "Last name must be less than 255 characters.";
        } elseif (!has_valid_email_format($admin['email'])) {
          $errors[] = "Email must be a valid format.";
        }
    
        if(is_blank($admin['jobRole'])) {
            $errors[] = "Role name cannot be blank.";
          } elseif (!has_length($admin['jobRole'], array('min' => 4, 'max' => 30))) {
            $errors[] = "Role name must be between 4 and 30 characters.";
          }
    
        if(is_blank($admin['accountPassword'])) {
          $errors[] = "Password cannot be blank.";
        } elseif (!has_length($admin['accountPassword'], array('min' => 8))) {
          $errors[] = "Password must contain 8 or more characters";
        } elseif (!preg_match('/[A-Z]/', $admin['accountPassword'])) {
          $errors[] = "Password must contain at least 1 uppercase letter";
        } elseif (!preg_match('/[a-z]/', $admin['accountPassword'])) {
          $errors[] = "Password must contain at least 1 lowercase letter";
        } elseif (!preg_match('/[0-9]/', $admin['accountPassword'])) {
          $errors[] = "Password must contain at least 1 number";
        }
        // } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['accountPassword'])) {
        //   $errors[] = "Password must contain at least 1 symbol";
        // }
    
        if(is_blank($admin['confirm_accountPassword'])) {
          $errors[] = "Confirm password cannot be blank.";
        } elseif ($admin['accountPassword'] !== $admin['confirm_accountPassword']) {
          $errors[] = "Password and confirm password must match.";
        }
    
        return $errors;
    }

    function insert_employee($admin) {
        global $db;
    
        $errors = validate_admin($admin);
        if (!empty($errors)) {
          return $errors;
        }
        $hashed_password = password_hash($admin['accountPassword'], PASSWORD_BCRYPT);
    
        $sql = "INSERT INTO employee ";
        $sql .= "(firstName, lastName, email, jobRole, permission, accountPassword) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $admin['firstName']) . "',";
        $sql .= "'" . db_escape($db, $admin['lastName']) . "',";
        $sql .= "'" . db_escape($db, $admin['email']) . "',";
        $sql .= "'" . db_escape($db, $admin['jobRole']) . "',";
        $sql .= "'" . db_escape($db, $admin['permission']) . "',";
        $sql .= "'" . db_escape($db, $hashed_password) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);
    
        // For INSERT statements, $result is true/false
        if($result) {
          return true;
        } else {
          // INSERT failed
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function find_employee_by_username($username) {
        global $db;

        $sql = "SELECT * FROM employee ";
        $sql .= "WHERE email='" . db_escape($db, $username) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $admin = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $admin; // returns an assoc. full array
    }

    function find_user($user) {
        global $db;
        $sql = "SELECT * FROM employee ";
        $sql .= "WHERE employeeId='" . db_escape($db, $user) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $subject;
    }

    function find_low_stock_by_id($employeeId) {
        global $db;
        $sql = "SELECT item.itemId, item.categoryId, category.employeeId, item.reorder, itemLocation.locationQuantity, item.currentPrice ";
        $sql .= "FROM item ";
        $sql .= "inner join category on item.categoryId = category.categoryId ";
        $sql .= "join itemLocation on item.itemId = itemLocation.itemId ";
        $sql .= "WHERE itemLocation.locationQuantity <= item.reorder ";
        $sql .= "and category.employeeId = '" . db_escape($db, $employeeId) . "' ";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_low_stock() {
        global $db;
        $sql = "SELECT item.itemId, item.categoryId, category.employeeId, item.reorder, itemLocation.locationQuantity, item.currentPrice ";
        $sql .= "FROM item ";
        $sql .= "inner join category on item.categoryId = category.categoryId ";
        $sql .= "join itemLocation on item.itemId = itemLocation.itemId ";
        $sql .= "WHERE itemLocation.locationQuantity <= item.reorder;";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function count_low_stock() {
        global $db;
        $sql = "SELECT count(item.itemId) as x ";
        $sql .= "FROM item ";
        $sql .= "inner join category on item.categoryId = category.categoryId ";
        $sql .= "join itemLocation on item.itemId = itemLocation.itemId ";
        $sql .= "WHERE itemLocation.locationQuantity <= item.reorder;";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $subject;
    }

    function count_low_stock_by_id($employeeId) {
        global $db;
        $sql = "SELECT count(item.itemId) as x ";
        $sql .= "FROM item ";
        $sql .= "inner join category on item.categoryId = category.categoryId ";
        $sql .= "join itemLocation on item.itemId = itemLocation.itemId ";
        $sql .= "WHERE itemLocation.locationQuantity <= item.reorder ";
        $sql .= "and category.employeeId = '" . db_escape($db, $employeeId) . "' ";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $subject;
    }

    function count_unauthorised_orders() {
        global $db;
        $sql = "SELECT count(poID) as x ";
        $sql .= "FROM purchaseorder ";
        $sql .= "WHERE orderStatus = 'Unauthorised';";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $subject;
    }

    function count_deliveries_today() {
        global $db;
        $sql = "SELECT count(purchaseOrder.poID) as x ";
        $sql .= "FROM purchaseorder ";
        $sql .= "JOIN supplier ON purchaseOrder.supplierpostalCode = supplier.postalCode ";
        $sql .= "WHERE purchaseOrder.orderStatus = 'Authorised'  ";
        $sql .= "AND DATE_ADD(purchaseorder.created, INTERVAL supplier.deliveryDays DAY) = CURDATE();";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result); //Extract data from array
        mysqli_free_result($result);
        return $subject;
    }

    function find_expect_delivery() {
        global $db;
        $sql = "SELECT purchaseOrder.poID, purchaseOrder.created, supplier.deliveryDays, ";
        $sql .= "DATE_ADD(purchaseorder.created, INTERVAL supplier.deliveryDays DAY) AS 'expectDelivery', ";
        $sql .= "purchaseorder.orderStatus ";
        $sql .= "FROM purchaseOrder ";
        $sql .= "JOIN supplier ON purchaseOrder.supplierpostalCode = supplier.postalCode ";
        $sql .= "WHERE purchaseOrder.orderStatus = 'Authorised' ";
        $sql .= "ORDER BY expectDelivery ";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_expect_delivery_this_week(){
        global $db;
        $sql = "SELECT purchaseOrder.poID, purchaseOrder.created, supplier.deliveryDays, ";
        $sql .= "DATE_ADD(purchaseorder.created, INTERVAL supplier.deliveryDays DAY) AS 'expectDelivery', ";
        $sql .= "purchaseorder.orderStatus ";
        $sql .= "FROM purchaseOrder ";
        $sql .= "JOIN supplier ON purchaseOrder.supplierpostalCode = supplier.postalCode ";
        $sql .= "WHERE purchaseOrder.orderStatus = 'Authorised' AND DATE_ADD(purchaseorder.created, INTERVAL supplier.deliveryDays DAY) BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY) ";
        $sql .= "ORDER BY expectDelivery;";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_late_deliveries(){
        global $db;
        $sql = "SELECT purchaseOrder.poID, employeeId, supplierPostalCode, purchaseOrder.created, ";
        $sql .= "DATE_ADD(purchaseorder.created, INTERVAL supplier.deliveryDays DAY) AS 'expectDelivery', ";
        $sql .= "purchaseorder.deliveredOn, purchaseorder.orderStatus ";
        $sql .= "FROM purchaseOrder ";
        $sql .= "JOIN supplier ON purchaseOrder.supplierpostalCode = supplier.postalCode ";
        $sql .= "WHERE DATE_ADD(purchaseorder.created, INTERVAL supplier.deliveryDays DAY) < purchaseOrder.deliveredOn";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }
    
?>