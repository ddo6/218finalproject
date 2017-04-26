<?php
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}

if($action == 'list_products'){
    
    $products = get_products();
    
    include('product_list.php');
    } 
    else if ($action == 'delete_product') {
    $product_code = $_POST['product_code'];
    delete_product($product_code);
    header("Location: .");
    } 
    else if ($action == 'show_add_form') {
    include('product_add.php');
    } 
    else if ($action == 'add_product') {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $version = $_POST['version'];
    $release_date = $_POST['release_date'];
    }

    //Input Validation
   if (empty($code) || emty($name) ||  
   empty($version) || empty($release_date)) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        add_product($code, $name, $version, $release_date);
        header("Location: .");
    } 
?>
