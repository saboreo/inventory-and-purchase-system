<?php  require_once('../private/initialize.php');

require_login();

if (is_post_request()) {

        
        $categoryId = $_POST['categoryId'];
        $categoryName = $_POST['categoryName'];
        $employeeId = $_POST['employeeId'];

        $result = add_new_category($categoryId, $categoryName, $employeeId);
        redirect_to('../public/category.php');
    } else {
        redirect_to('../public/category-new.php');
    }
?>