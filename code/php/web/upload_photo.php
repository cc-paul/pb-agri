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
        move_uploaded_file($_FILES['file']['tmp_name'], '../../../assets/product/product-' . $filename.".jpg");
        
        
        $query = "INSERT INTO eb_product_image (productID,fileName) VALUES (?,?)";
        if ($stmt = mysqli_prepare($con, $query)) {
            mysqli_stmt_bind_param($stmt,"ss",$productID,$filename);
            mysqli_stmt_execute($stmt);
            
            $error   = false;
            $color   = "green";
            $message = "Image has been added successfully"; 
        } else {
            $error   = true;
            $color   = "red";
            $message = "Error uploading files"; 
        }


    }
    
    $json[] = array(
        'error' => $error,
        'color' => $color,
        'message' => $message
    );
    echo json_encode($json);
?>