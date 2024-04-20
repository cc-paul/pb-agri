<?php
    if(!isset($_SESSION)) { session_start(); }
    include dirname(__FILE__,2) . '/config.php';
    include $main_location . '/connection/conn.php';
    
    $videoID  = $_POST["videoID"];
    $error    = false;
    $color    = "green";
    $message  = "";
	
	if ( 0 < $_FILES['file']['error'] ) {
        $error   = true;
        $color   = "red";
        $message = "There is an error uploading your video. Please try again later";
    } else {
        if (move_uploaded_file($_FILES['file']['tmp_name'], '../../../video/' . $videoID.".mp4")) {
            
            
            $query = "UPDATE eb_products SET hasVideo = 1 WHERE id = ?";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"s",$videoID);
                mysqli_stmt_execute($stmt);
               
                $error   = false;
                $color   = "green";
                $message = "Video has been added successfully";
               
            } else {
                 $error   = true;
                $color   = "red";
                $message = "There is an error uploading your video. Please try again later";
            }
            
        } else {
            $error   = true;
            $color   = "red";
            $message = "There is an error uploading your video. Please try again later";
        }
    }
    
    $json[] = array(
        'error' => $error,
        'color' => $color,
        'message' => $message
    );
    echo json_encode($json);
    
    mysqli_close($con);
?>