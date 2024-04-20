<?php
    if(!isset($_SESSION)) { session_start(); } 
    include dirname(__FILE__,2) . '/config.php';
    include $main_location . '/connection/conn.php';
    include '../builder/builder_select.php';
    include '../builder/builder_table.php';
    
    $command = $_POST["command"];
    $error   = false;
    $color   = "green";
    $message = "";
    $json    = array();
    

    switch ($command) {
        case "save_company_profile" :
            
            $companyName = $_POST["companyName"];
            $oldCompanyName = $_POST["oldCompanyName"];
            $companyWebsite = $_POST["companyWebsite"];
            $companyAddress = $_POST["companyAddress"];
            $mobileNumber = $_POST["mobileNumber"];
            $emailAddress = $_POST["emailAddress"];
            $contactPerson = $_POST["contactPerson"];
            $aboutUs = $_POST["aboutUs"];
            $createdBy = $_SESSION["id"];
            $isCompanyExist = 0;
            
            if ($companyName != $oldCompanyName) {
                $find_companyName = mysqli_query($con,"SELECT * FROM eb_company_profile WHERE companyName = '$companyName'");
                if (mysqli_num_rows($find_companyName) != 0) {
                    mysqli_next_result($con);
                    
                    $error   = true;
                    $color   = "red";
                    $message = "Bussiness Name already exist";
                    $isCompanyExist = 1;
                }
            }
            
            if ($isCompanyExist == 0) {
                $checkStocks = mysqli_query($con,"SELECT * FROM eb_products WHERE createdBy = $createdBy AND isActive = 1");
                if (mysqli_num_rows($checkStocks) == 0) {
                    mysqli_next_result($con);
                    
                    $error   = true;
                    $color   = "red";
                    $message = "Unable to publish. Please add at least 1 product.";
                } else {
                    $query = "DELETE FROM eb_company_profile WHERE createdBy = ?";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"s",$createdBy);
                        mysqli_stmt_execute($stmt);
                        
                        $query = "INSERT INTO eb_company_profile (companyName,companyWebsite,companyAddress,mobileNumber,emailAddress,contactPerson,aboutUs,createdBy) VALUES (?,?,?,?,?,?,?,?)";
                        if ($stmt = mysqli_prepare($con, $query)) {
                            mysqli_stmt_bind_param($stmt,"ssssssss",$companyName,$companyWebsite,$companyAddress,$mobileNumber,$emailAddress,$contactPerson,$aboutUs,$createdBy);
                            mysqli_stmt_execute($stmt);
                            
                            $createdBy = $_SESSION["id"];
                            
                            $query = "DELETE FROM eb_company_profile_dupli WHERE createdBy = ?";
                            if ($stmt = mysqli_prepare($con, $query)) {
                                mysqli_stmt_bind_param($stmt,"s",$createdBy);
                                mysqli_stmt_execute($stmt);
                                
                                $query = "INSERT INTO eb_company_profile_dupli SELECT * FROM eb_company_profile WHERE createdBy = ?";
                                if ($stmt = mysqli_prepare($con, $query)) {
                                    mysqli_stmt_bind_param($stmt,"s",$createdBy);
                                    mysqli_stmt_execute($stmt);
                                }
                            }
                            
                            
                            
                            $error   = false;
                            $color   = "green";
                            $message = "Bussiness profile has been save successfully"; 
                        } else {
                            $error   = true;
                            $color   = "red";
                            $message = "Error updating bussiness profile";
                        }       
                    } else {
                        $error   = true;
                        $color   = "red";
                        $message = "Error deleting bussiness profile";
                    }       
                }
            }
            
            $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message
            );
            echo json_encode($json);
        break;
    
        case "get_lat_lng" :
            
            $createdBy = $_SESSION["id"];
            
            $sql    = "SELECT lat,lng FROM eb_company_profile WHERE createdBy = $createdBy";
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_assoc($result)) {
                $json[] = array(
                    'lat'          => $row["lat"],
                    'lng'          => $row["lng"]
                );
            }
            echo json_encode($json);
            
        break;
    
        case "update_company_map" :
            
            $createdBy = $_SESSION["id"];
            $lat       = $_POST["lat"];
            $lng       = $_POST["lng"];
            
            $query = "UPDATE eb_company_profile SET lat=?,lng=? WHERE createdBy = ?";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"sss",$lat,$lng,$createdBy);
                mysqli_stmt_execute($stmt);
               
                $error   = false;
                $color   = "green";
                $message = ""; 
               
            } else {
                $error   = true;
                $color   = "red";
                $message = "Unable to save lat/long" . mysqli_error($con); 
            }
            
            $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message
            );
            echo json_encode($json);
            
        break;
    }
    
    mysqli_close($con);
?>