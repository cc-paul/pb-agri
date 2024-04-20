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
        case "display_account" :
            
            $sql = "
                SELECT
                    a.username,
                    a.firstName,
                    a.middleName,
                    a.lastName,
                    a.emailAddress,
                    a.mobileNumber,
                    a.currentAddress,
                    IF(a.isActive,'Active','Disabled') AS isActive,
                    a.`status`,
                    a.position,
                    DATE_FORMAT(a.dateCreated,'%m/%d/%y') AS dateCreated,
                    a.id
                FROM
                    eb_registration a
                WHERE
                    a.position != 'Client'
                ORDER BY
                    a.dateCreated DESC
            ";
            return builder($con,$sql);
            
        break;
        
        case "display_top_seller" :
            
            $sql = "
                    SELECT 
                        a.itemName,
                        a.description,
                        a.manufacturersName,
                        FORMAT(a.totalSold,0) AS totalSold
                    FROM	
                        eb_products a 
                    WHERE   
                        a.isActive = 1
                        ORDER BY 
                    a.totalSold DESC
            ";
            return builder($con,$sql);
            
        break;
    
        case "display_top_buyer" :
            
            $sql = "
                    SELECT
                        CONCAT(c.lastName,', ',c.firstName,' ',c.middleName) AS clientName,
                        SUM(b.qty) AS totalQty,
                        FORMAT(SUM(b.qty) + SUM(b.price),2) AS grandTotal 
                    FROM
                        eb_checkout a 
                    INNER JOIN
                        eb_checkout_item b 
                    ON
                        a.refNumber = b.refNumber 
                    INNER JOIN
                        eb_registration c 
                    ON 
                        a.clientID = c.id 
                    GROUP BY
                        a.clientID 
                    ORDER BY
                        SUM(b.qty) DESC
            ";
            return builder($con,$sql);
            
        break;
        
        case "set_approval" :
            
            $id       = $_POST["id"];
            $position = $_POST["position"];
            $status   = $_POST["status"];
            $messageEmail = "";
            $sellersName = $_POST["sellersName"];
            $sellersEmail = $_POST["sellersEmail"];
            
            if ($status == "Approved") {
                $messageEmail = "Congratulations! Your account has been approved";
            } else {
                $messageEmail = "We sorry to inform you that your request has been declined";
            }
            
            $query = "UPDATE eb_registration SET `status` = ?,position=? WHERE id = ?";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"sss",$status,$position,$id);
                mysqli_stmt_execute($stmt);
                
                $error   = false;
                $color   = "green";
                $message = "Account has been updated successfully"; 
            } else {
                $error   = true;
                $color   = "red";
                $message = "Error updating account "."Error description: " . mysqli_error($con);
            }
            
             $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message
            );
            echo json_encode($json);
            
            $mail = new PHPMailer(true);                              
            try {
                $mail->isSMTP(); // using SMTP protocol                                     
                $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
                $mail->SMTPAuth = true;  // enable smtp authentication                             
                $mail->Username = 'agrimerchants027@gmail.com';  // sender gmail host              
                $mail->Password = 'nuvrswrjziskhlmk'; // sender gmail host password                          
                $mail->SMTPSecure = 'tls';  // for encrypted connection                           
                $mail->Port = 587;   // port for SMTP     
            
                $mail->setFrom('agrimerchants027@gmail.com', "Agri Merchants"); // sender's email and name
                $mail->addAddress($sellersEmail, str_replace(",","",$sellersName));  // receiver's email and name
            
                $mail->Subject = 'Agri Merchants Approval Status';
                $mail->Body    = $messageEmail;
            
                $mail->send();
                //echo 'Message has been sent';
            } catch (Exception $e) { // handle error.
                //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
            
        break;
    }
    
    mysqli_close($con);
?>