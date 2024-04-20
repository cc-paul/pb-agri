<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception;
    //
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    
    $email = $_POST["email"];
    $body  = $_POST["body"];
    
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
        $mail->addAddress($email, str_replace(",","",$email));  // receiver's email and name
    
        $mail->Subject = 'Agri Merchants OTP Sending';
        $mail->Body    = $body;
    
        $mail->send();
        //echo 'Message has been sent';
        
        $error   = false;
        $color   = "";
        $message = "";
    } catch (Exception $e) { // handle error.
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        
        $error   = false;
        $color   = "red";
        $message = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
    }
    
    $json[] = array(
        'error' => $error,
        'color' => $color,
        'message' => $message
    );
    echo json_encode($json);
?>