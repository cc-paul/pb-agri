<?php
    if(!isset($_SESSION)) { session_start(); }
    include dirname(__FILE__,2) . '/config.php';
    include $main_location . '/connection/conn.php';
    
    $productID = $_POST["productID"];
    $filename = date('YmdHis', time());
    $error   = false;
    $color   = "green";
    $message = "";
	
	if ( 0 < $_FILES['file']['error'] ) {
        
        $error   = true;
        $color   = "red";
        $message = "Error uploading files"; 
        
    } else {
        move_uploaded_file($_FILES['file']['tmp_name'], '../../../assets/product/product-' . $productID.".jpg");
        
        $error   = false;
        $color   = "green";
        $message = "Image has been attached"; 
    }
    
    $json[] = array(
        'error' => $error,
        'color' => $color,
        'message' => $message
    );
    echo json_encode($json);
?>