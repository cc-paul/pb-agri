<?php
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception;
    //
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';

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
        case "login_account" :
            
            $username = $_POST["username"];
            $password = $_POST["password"];
            $position = "";
            
            $sql      = "
                SELECT
                    a.id,
                    CONCAT( a.firstName, ' ', a.middleName, ' ', a.lastName ) AS fullName,
                    a.username,
                    DATE_FORMAT( a.dateCreated, '%m/%d/%Y' ) AS member_since,
                    a.position,
                    a.mobileNumber,
                    a.emailAddress
                FROM
                    eb_registration a
                WHERE
                    a.username = '$username' 
                AND 
                    a.`password` = MD5( '$password' )
                AND
                    a.status = 'Approved'
                AND
                    a.position != 'Client' 
                AND 
                    a.isActive = 1
            ";
            
            $result   = mysqli_query($con,$sql);
            $count    = mysqli_num_rows($result);
        
        
            if ($count != 0) {
                while ($row = mysqli_fetch_row($result)) {
                    $_SESSION['id']               = $row[0];
                    $_SESSION['fullName']         = $row[1];
                    $_SESSION['username']         = $row[2];
                    $_SESSION['member_since']     = $row[3];
                    $_SESSION['position']         = $row[4];
                    $position                     = $row[4];
                    $_SESSION['mobileNumber']     = $row[5];
                    $_SESSION['emailAddress']     = $row[6];
                }
        
                $error   = false;
                $color   = "gree";
                $message = "Account successfully login";
            } else {
                $error   = true;
                $color   = "red";
                $message = "Account does not exist";
            }
            
            $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message,
                'position' => $position
            );
            echo json_encode($json);
        break;
    
        case "login_client" :
            
            $username = $_POST["username"];
            $password = $_POST["password"];
            $position = "";
            
            $sql      = "
                SELECT
                    a.*
                FROM
                    eb_registration a
                WHERE
                    a.username = '$username' 
                AND 
                    a.`password` = MD5( '$password' )
                AND
                    a.position = 'Client' 
                AND 
                    a.isActive = 1
            ";
            
            $result   = mysqli_query($con,$sql);
            $count    = mysqli_num_rows($result);
        
        
            if ($count != 0) {
                while ($row = mysqli_fetch_row($result)) {
                    $_SESSION['isClientLogin'] = 1;
                    $_SESSION['clientID']           = $row[0];
                    $_SESSION['clientUsername']     = $row[1];
                    $_SESSION['clientFirstName']    = $row[2];
                    $_SESSION['clientMiddleName']   = $row[3];
                    $_SESSION['clientLastName']     = $row[4];
                    $_SESSION['clientEmailAddress'] = $row[5];
                    $_SESSION['clientMobileNumber'] = $row[6];
                    $_SESSION['clientAddress']      = $row[7];
                }
        
                $error   = false;
                $color   = "gree";
                $message = "Account successfully login";
            } else {
                $error   = true;
                $color   = "red";
                $message = "Account does not exist";
            }
            
            $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message,
                'position' => $position
            );
            echo json_encode($json);
        break;
        
        case "register_account" :
            
            $username     = $_POST["username"];
            $firstName    = $_POST["firstName"];
            $middleName   = $_POST["middleName"];
            $lastName     = $_POST["lastName"];
            $emailAddress = $_POST["emailAddress"];
            $mobileNumber = $_POST["mobileNumber"];
            $currentAddress = $_POST["currentAddress"];
            $password = $_POST["password"];
            $position = $_POST["position"];
            $status = $_POST["status"];
            $companyName = $_POST["companyName"];
            $companyAddress = $_POST["companyAddress"];
            
            $arr_exist = array();
            
            $find_email = mysqli_query($con,"SELECT * FROM eb_registration WHERE emailAddress = '$emailAddress'");
            if (mysqli_num_rows($find_email) != 0) {
                mysqli_next_result($con);
                array_push($arr_exist,"Email");
            }
            
            $find_user = mysqli_query($con,"SELECT * FROM eb_registration WHERE username = '$username'");
            if (mysqli_num_rows($find_user) != 0) {
                mysqli_next_result($con);
                array_push($arr_exist,"Username");
            }
            
            $find_company = mysqli_query($con,"SELECT * FROM eb_company_profile WHERE companyName = '$companyName' UNION ALL SELECT * FROM eb_company_profile_dupli WHERE companyName = '$companyName'");
            if (mysqli_num_rows($find_company) != 0) {
                mysqli_next_result($con);
                array_push($arr_exist,"Company Name");
            }
            
            if (count($arr_exist) != 0) {
                $error   = true;
                $color   = "orange";
                $message = "";
                
                if (count($arr_exist) == 3) {
                    $value_0 = $arr_exist[0];
                    $value_1 = $arr_exist[1];
                    $value_2 = $arr_exist[2];
                    
                    $message = "$value_0, $value_1 and $value_2 already exist";
                } else if (count($arr_exist) == 2) {
                    $value_0 = $arr_exist[0];
                    $value_1 = $arr_exist[1];
                    
                    $message = "$value_0 and $value_1 already exist";
                } else {
                    $value_0 = $arr_exist[0];
                    
                    $message = "$value_0 already exist";
                }
            } else {
                $query = "INSERT INTO eb_registration (username,firstName,middleName,lastName,emailAddress,mobileNumber,currentAddress,password,dateCreated,status,position) VALUES (?,?,?,?,?,?,?,MD5(?),?,?,?)";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt,"sssssssssss",$username,$firstName,$middleName,$lastName,$emailAddress,$mobileNumber,$currentAddress,$password,$global_date,$status,$position);
                    mysqli_stmt_execute($stmt);
                    
                    $error   = false;
                    $color   = "green";
                    $message = "Account has been saved successfully. You may now login your account";
                    
                    $createdBy = mysqli_insert_id($con);
                    
                    $query = "INSERT INTO eb_company_profile_dupli (companyName,companyAddress,createdBy) VALUES (?,?,?)";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"sss",$companyName,$companyAddress,$createdBy);
                        mysqli_stmt_execute($stmt);
                    }
                    
                    if ($position == 'Client') {
                        $message = "Account has been saved successfully.";
                    }
                } else {
                    $error   = true;
                    $color   = "red";
                    $message = "Error saving account "."Error description: " . mysqli_error($con);
                }
            }
            
            
            $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message
            );
            echo json_encode($json);
            
        break;
    
        
        case "update_account" :
            
        
            $clientID            = $_SESSION['clientID'];
            $currentUserName     = $_SESSION['clientUsername'];
            $currentEmailAddress = $_SESSION['clientEmailAddress'];
            
            $username       = $_POST["username"];
            $firstName      = $_POST["firstName"];
            $middleName     = $_POST["middleName"];
            $lastName       = $_POST["lastName"];
            $emailAddress   = $_POST["emailAddress"];
            $mobileNumber   = $_POST["mobileNumber"];
            $currentAddress = $_POST["currentAddress"];
            
            $arr_exist = array();
            
            if (strtolower($emailAddress) != strtolower($currentEmailAddress)) {
                $find_email = mysqli_query($con,"SELECT * FROM eb_registration WHERE emailAddress = '$emailAddress'");
                if (mysqli_num_rows($find_email) != 0) {
                    mysqli_next_result($con);
                    array_push($arr_exist,"Email");
                }
            }
            
            if (strtolower($currentUserName) != strtolower($username)) {
                $find_user = mysqli_query($con,"SELECT * FROM eb_registration WHERE username = '$username'");
                if (mysqli_num_rows($find_user) != 0) {
                    mysqli_next_result($con);
                    array_push($arr_exist,"Username");
                }
            }
            
            if (count($arr_exist) != 0) {
                $error   = true;
                $color   = "orange";
                $message = "";
                
                if (count($arr_exist) != 2) {
                    $message = implode(" and ",$arr_exist) . " already exist";
                } else {
                    $message = $arr_exist[0] . " and " . $arr_exist[1] . " " . " already exist";
                }
            } else {
                $query = "UPDATE eb_registration SET username=?,firstName=?,middleName=?,lastName=?,emailAddress=?,mobileNumber=?,currentAddress=? WHERE id=?";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt,"ssssssss",$username,$firstName,$middleName,$lastName,$emailAddress,$mobileNumber,$currentAddress,$clientID);
                    mysqli_stmt_execute($stmt);
                    
                
                    $_SESSION['clientUsername']     = $username;
                    $_SESSION['clientFirstName']    = $firstName;
                    $_SESSION['clientMiddleName']   = $middleName;
                    $_SESSION['clientLastName']     = $lastName;
                    $_SESSION['clientEmailAddress'] = $emailAddress;
                    $_SESSION['clientMobileNumber'] = $mobileNumber;
                    $_SESSION['clientAddress']      = $currentAddress;
                    
                    $error   = false;
                    $color   = "green";
                    $message = "Account has been updated successfully.";
                } else {
                    $error   = true;
                    $color   = "red";
                    $message = "Error updating account "."Error description: " . mysqli_error($con);
                }
            }
            
            
            $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message
            );
            echo json_encode($json);
            
        break;
        
    
        case "change_password" :
            
            $id       = isset($_SESSION["id"]) ? $_SESSION["id"] : $_SESSION["clientID"];
            $password = $_POST["password"];
            
            
            $query = "UPDATE eb_registration SET `password` = MD5(?) WHERE id = ?";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"ss",$password,$id);
                mysqli_stmt_execute($stmt);
                
                $error   = false;
                $color   = "green";
                $message = "Password has been updated successfully"; 
            } else {
                $error   = true;
                $color   = "red";
                $message = "Error updating password "."Error description: " . mysqli_error($con);
            }
            
             $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message
            );
            echo json_encode($json);
            
        break;
    
        case "send_email" :
            
            $email = $_POST["email"];
            $otp   = mt_rand(1000,9999);
            
            $query = "INSERT INTO eb_otp (emailAddress,otp) VALUES (?,?)";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"ss",$email,$otp);
                mysqli_stmt_execute($stmt);
                
                $error   = false;
                $color   = "green";
                $message = "Your OTP is " . $otp;
                
                //$mail = new PHPMailer(true);                              
                //try {
                //    $mail->isSMTP(); // using SMTP protocol                                     
                //    $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
                //    $mail->SMTPAuth = true;  // enable smtp authentication                             
                //    $mail->Username = 'agrimerchants027@gmail.com';  // sender gmail host              
                //    $mail->Password = 'nuvrswrjziskhlmk'; // sender gmail host password                          
                //    $mail->SMTPSecure = 'tls';  // for encrypted connection                           
                //    $mail->Port = 587;   // port for SMTP     
                //
                //    $mail->setFrom('agrimerchants027@gmail.com', "Agri Merchants"); // sender's email and name
                //    $mail->addAddress($email, str_replace(",","",$email));  // receiver's email and name
                //
                //    $mail->Subject = 'Agri Merchants OTP Sending';
                //    $mail->Body    = "Your OTP is " . $otp;
                //
                //    $mail->send();
                //    //echo 'Message has been sent';
                //    
                //    $error   = false;
                //    $color   = "";
                //    $message = "";
                //} catch (Exception $e) { // handle error.
                //    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                //    
                //    $error   = false;
                //    $color   = "red";
                //    $message = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
                //}
                
            } else {
                $error   = true;
                $color   = "red";
                $message = "Error creating OTP";
            }
            
            $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message
            );
            echo json_encode($json);
        
        break;
    
        case "change_pass" :
            
            $email    = $_POST["email"];
            $otp      = $_POST["otp"];
            $password = $_POST["password"];
            
            $find_query = mysqli_query($con,"SELECT * FROM eb_otp WHERE emailAddress = '$email' AND otp = '$otp' AND isUsed = 0");
            if (mysqli_num_rows($find_query) != 0) {
                mysqli_next_result($con);
                
                $query = "UPDATE eb_otp SET isUsed = 1 WHERE emailAddress = ? AND otp = ?";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt,"ss",$email,$otp);
                    mysqli_stmt_execute($stmt);
                    
                    $query = "UPDATE eb_registration SET password = MD5(?) WHERE emailAddress = ?";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"ss",$password,$email);
                        mysqli_stmt_execute($stmt);
                        
                        $error   = false;
                        $color   = "green";
                        $message = "Password has been changed"; 
                    } else {
                        $error   = true;
                        $color   = "red";
                        $message = "Error updating password";
                    }
                } else {
                    $error   = true;
                    $color   = "red";
                    $message = "Error updating OTP";
                }
                
            } else {
                $error   = true;
                $color   = "red";
                $message = "OTP does not exsist";
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