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
    
    switch($command) {
        case "message_reported_user" :
        
            $buyerID         = $_SESSION["id"];
            $sellerID        = $_POST["sellerID"];
            $lastMessageDate = $global_date;
            $message_sent    = $_POST["message"];
            $chatID          = 0;
            
            $sql    = "SELECT id FROM eb_chat_header WHERE buyerID = $buyerID AND sellerID = $sellerID";
            $result = mysqli_query($con,$sql);
            
            while ($row  = mysqli_fetch_row($result)) {
                $chatID = $row[0];
            }
            
            if ($chatID == 0) {
                $query = "
                    INSERT INTO eb_chat_header (
                        buyerID,
                        sellerID,
                        lastMessageDate,
                        isAdmin
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        1
                    )
                ";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt,"sss",$buyerID,$sellerID,$lastMessageDate);
                    mysqli_stmt_execute($stmt);
                    
                    $chatID = mysqli_insert_id($con);
                    
                    $query = "
                        INSERT INTO eb_chat_details (
                            chatID,
                            message,
                            dateCreated,
                            itemID,
                            sentToID
                        ) VALUES (
                            ?,
                            ?,
                            ?,
                            0,
                            ?
                        )
                    ";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"ssss",$chatID,$message_sent,$lastMessageDate,$sellerID);
                        mysqli_stmt_execute($stmt);
                        
                        $error   = false;
                        $color   = "red";
                        $message = "";
                        
                    } else {
                        $error   = true;
                        $color   = "red";
                        $message = "Error connecting to seller. Please try again later";
                    }
                } else {
                    $error   = true;
                    $color   = "red";
                    $message = "Error connecting to seller. Please try again later";
                }
            } else {
                $query = "
                    INSERT INTO eb_chat_details (
                        chatID,
                        message,
                        dateCreated,
                        itemID,
                        sentToID
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        0,
                        ?
                    )
                ";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt,"ssss",$chatID,$message_sent,$lastMessageDate,$sellerID);
                    mysqli_stmt_execute($stmt);
                    
                    $error   = false;
                    $color   = "red";
                    $message = "";
                    
                } else {
                    $error   = true;
                    $color   = "red";
                    $message = "Error connecting to seller. Please try again later";
                }
            }
            
            $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message
            );
            echo json_encode($json);
        
        break;
        
        case "startup_message" :
            
            $itemID          = $_POST["itemID"];
            $message_sent    = $_POST["message_sent"];
            $buyerID         = $_SESSION["clientID"];
            $chatID          = 0;
            $lastMessageDate = $global_date;
            
            $sql    = "SELECT id FROM eb_chat_header WHERE buyerID = $buyerID AND sellerID = (SELECT createdBy FROM eb_products WHERE id = $itemID)";
            $result = mysqli_query($con,$sql);
            
            while ($row  = mysqli_fetch_row($result)) {
                $chatID = $row[0];
            }
            
            if ($chatID == 0) {
                $query = "
                    INSERT INTO eb_chat_header (
                        buyerID,
                        sellerID,
                        lastMessageDate
                    ) VALUES (
                        ?,
                        (SELECT createdBy FROM eb_products WHERE id = ?),
                        ?
                    )
                ";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt,"sss",$buyerID,$itemID,$lastMessageDate);
                    mysqli_stmt_execute($stmt);
                    
                    $chatID = mysqli_insert_id($con);
                    
                    $query = "
                        INSERT INTO eb_chat_details (
                            chatID,
                            message,
                            dateCreated,
                            itemID,
                            sentToID
                        ) VALUES (
                            ?,
                            ?,
                            ?,
                            ?,
                            (SELECT createdBy FROM eb_products WHERE id = ?)
                        )
                    ";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"sssss",$chatID,$message_sent,$lastMessageDate,$itemID,$itemID);
                        mysqli_stmt_execute($stmt);
                        
                        $error   = false;
                        $color   = "red";
                        $message = "";
                        
                    } else {
                        $error   = true;
                        $color   = "red";
                        $message = "Error connecting to seller. Please try again later";
                    }
                } else {
                    $error   = true;
                    $color   = "red";
                    $message = "Error connecting to seller. Please try again later";
                }
            } else {
                $query = "
                    INSERT INTO eb_chat_details (
                        chatID,
                        message,
                        dateCreated,
                        itemID,
                        sentToID
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        (SELECT createdBy FROM eb_products WHERE id = ?)
                    )
                ";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt,"sssss",$chatID,$message_sent,$lastMessageDate,$itemID,$itemID);
                    mysqli_stmt_execute($stmt);
                    
                    $error   = false;
                    $color   = "red";
                    $message = "";
                    
                } else {
                    $error   = true;
                    $color   = "red";
                    $message = "Error connecting to seller. Please try again later";
                }
            }
            
            $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message
            );
            echo json_encode($json);
            
        break;
    
        case "chatbox_buyer" :
            
            $id   = $_SESSION["clientID"];
            $name = $_POST["name"];
        
            $sql    = '
                SELECT
                    CONCAT(b.lastName,", ",b.firstName," ",b.lastName) AS fullName,
                    (
                        SELECT 
                            message 
                        FROM 
                            eb_chat_details
                        WHERE
                            chatID = a.id
                        ORDER BY
                            dateCreated DESC
                        LIMIT 1
                    ) AS lastMessage,
                    lastMessageDate,
                    (
                        SELECT COUNT(1) FROM eb_chat_details WHERE sentTOID = a.buyerID AND isRead = 0
                    ) AS countUnread,
                    a.id,
                    a.sellerID
                FROM
                    eb_chat_header a
                INNER JOIN
                    eb_registration b
                ON
                    a.sellerID = b.id
                WHERE
                    a.buyerID = '.$id.'
                AND
                    CONCAT(b.lastName,", ",b.firstName," ",b.lastName) LIKE "%'.$name.'%"
                ORDER BY
                    a.lastMessageDate DESC
            ';
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $json[] = array(
                    'fullName'        => $row[0],
                    'lastMessage'     => $row[1],
                    'lastMessageDate' => $row[2],
                    'countUnread'     => $row[3],
                    'initial'         => ucwords(substr($row[0], 0,1)),
                    'id'              => $row[4],
                    'chatmateID'      => $row[5]
                );
            }
            echo json_encode($json);
            
        break;
    
        case "chatbox_admin" :
            
            $id   = $_SESSION["id"];
            $name = $_POST["name"];
        
            $sql    = '
                SELECT
                    CONCAT(b.lastName,", ",b.firstName," ",b.lastName,IF(a.isAdmin = 1 AND a.sellerID = '.$id.', " (Administrator)","")) AS fullName,
                    (
                            SELECT 
                                    message 
                            FROM 
                                    eb_chat_details
                            WHERE
                                    chatID = a.id
                            ORDER BY
                                    dateCreated DESC
                            LIMIT 1
                    ) AS lastMessage,
                    lastMessageDate,
                    (
                            SELECT COUNT(1) FROM eb_chat_details WHERE sentTOID = '.$id.' AND isRead = 0
                    ) AS countUnread,
                    a.id,
                    a.sellerID
                FROM
                    eb_chat_header a
                INNER JOIN
                    eb_registration b
                ON
                    a.sellerID = b.id
                WHERE
                    a.buyerID = '.$id.'
                AND
                    CONCAT(b.lastName,", ",b.firstName," ",b.lastName) LIKE "%'.$name.'%"
                ORDER BY
                    a.lastMessageDate DESC
            ';
    
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $json[] = array(
                    'fullName'        => $row[0],
                    'lastMessage'     => $row[1],
                    'lastMessageDate' => $row[2],
                    'countUnread'     => $row[3],
                    'initial'         => ucwords(substr($row[0], 0,1)),
                    'id'              => $row[4],
                    'chatmateID'      => $row[5]
                );
            }
            echo json_encode($json);
            
        break;
    
        case "messages_admin_1" :
            
            $chatID = $_POST["chatID"];
            $id     = $_SESSION["id"];
            $messageID = 0;
            
            $sql    = '
                SELECT
                    a.message,
                    DATE_FORMAT(a.dateCreated, "%m/%d/%Y %h:%i %p") AS dateCreated,
                    (SELECT sellerID FROM eb_chat_header WHERE id = a.chatID) AS senderID,
                    a.sentToID AS receiverID,
                    a.id
                FROM
                    eb_chat_details a
                WHERE
                    a.chatID = '.$chatID.'
                AND
                    a.sentToID = '.$id.'
                AND
                    a.isDelivered = 0
                ORDER BY
                    a.dateCreated ASC;
            ';

            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $messageMode = "Receiver";
                
                if ($row[2] == $row[3]) {
                    $messageMode = "Sender";
                }
                
                $json[] = array(
                    'message'     => $row[0],
                    'dateCreated' => $row[1],
                    'messageMode' => $messageMode
                );
                
                $messageID = $row[4];
            }
            
            $query = "UPDATE eb_chat_details SET isDelivered = 1 WHERE id = ?";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"s",$messageID);
                mysqli_stmt_execute($stmt);
                
                $query = "UPDATE eb_chat_details SET isRead = 1 WHERE sentToID = ?";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt,"s",$id);
                    mysqli_stmt_execute($stmt);
                    
                    $error   = false;
                } else {
                    $error   = true;
                }
            } else {
                $error   = true;
            }
            
            echo json_encode($json);
            
        break;
    
        case "messages_admin" :
            
            $chatID = $_POST["chatID"];
            
            $sql    = '
                SELECT
                    a.message,
                    DATE_FORMAT(a.dateCreated, "%m/%d/%Y %h:%i %p") AS dateCreated,
                    (SELECT sellerID FROM eb_chat_header WHERE id = a.chatID) AS senderID,
                    a.sentToID AS receiverID
                FROM
                    eb_chat_details a
                WHERE
                    a.chatID = '.$chatID.'
                ORDER BY
                    a.dateCreated ASC;
            ';
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $messageMode = "Receiver";
                
                if ($row[2] == $row[3]) {
                    $messageMode = "Sender";
                }
                
                $json[] = array(
                    'message'     => $row[0],
                    'dateCreated' => $row[1],
                    'messageMode' => $messageMode
                );
            }
            echo json_encode($json);
            
        break;
    
        
    
        case "chatbox_seller" :
            
            $id   = $_SESSION["id"];
            $name = $_POST["name"];
        
            $sql    = '
                SELECT
                    CONCAT(b.lastName,", ",b.firstName," ",b.lastName,IF(a.isAdmin = 1 AND a.sellerID = '.$id.', " (Administrator)","")) AS fullName,
                    (
                            SELECT 
                                    message 
                            FROM 
                                    eb_chat_details
                            WHERE
                                    chatID = a.id
                            ORDER BY
                                    dateCreated DESC
                            LIMIT 1
                    ) AS lastMessage,
                    lastMessageDate,
                    (
                            SELECT COUNT(1) FROM eb_chat_details WHERE sentTOID = a.sellerID AND isRead = 0
                    ) AS countUnread,
                    a.id,
                    a.buyerID
                FROM
                    eb_chat_header a
                INNER JOIN
                    eb_registration b
                ON
                    a.buyerID = b.id
                WHERE
                    a.sellerID = '.$id.'
                AND
                    CONCAT(b.lastName,", ",b.firstName," ",b.lastName) LIKE "%'.$name.'%"
                ORDER BY
                    a.lastMessageDate DESC
            ';
            
   
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $json[] = array(
                    'fullName'        => $row[0],
                    'lastMessage'     => $row[1],
                    'lastMessageDate' => $row[2],
                    'countUnread'     => $row[3],
                    'initial'         => ucwords(substr($row[0], 0,1)),
                    'id'              => $row[4],
                    'chatmateID'      => $row[5]
                );
            }
            echo json_encode($json);
            
        break;
    
        case "messages_buyer" :
            
            $chatID = $_POST["chatID"];
            
            $sql    = '
                SELECT
                    a.message,
                    DATE_FORMAT(a.dateCreated, "%m/%d/%Y %h:%i %p") AS dateCreated,
                    (SELECT buyerID FROM eb_chat_header WHERE id = a.chatID) AS senderID,
                    a.sentToID AS receiverID
                FROM
                    eb_chat_details a
                WHERE
                    a.chatID = '.$chatID.'
                ORDER BY
                    a.dateCreated ASC;
            ';
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $messageMode = "Receiver";
                
                if ($row[2] == $row[3]) {
                    $messageMode = "Sender";
                }
                
                $json[] = array(
                    'message'     => $row[0],
                    'dateCreated' => $row[1],
                    'messageMode' => $messageMode
                );
            }
            echo json_encode($json);
            
        break;
    
        case "messages_buyer_1" :
            
            $chatID = $_POST["chatID"];
            $id     = $_SESSION["clientID"];
            $messageID = 0;
            
            $sql    = '
                SELECT
                    a.message,
                    DATE_FORMAT(a.dateCreated, "%m/%d/%Y %h:%i %p") AS dateCreated,
                    (SELECT buyerID FROM eb_chat_header WHERE id = a.chatID) AS senderID,
                    a.sentToID AS receiverID,
                    a.id
                FROM
                    eb_chat_details a
                WHERE
                    a.chatID = '.$chatID.'
                AND
                    a.sentToID = '.$id.'
                AND
                    a.isDelivered = 0
                ORDER BY
                    a.dateCreated ASC;
            ';
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $messageMode = "Receiver";
                
                if ($row[2] == $row[3]) {
                    $messageMode = "Sender";
                }
                
                $json[] = array(
                    'message'     => $row[0],
                    'dateCreated' => $row[1],
                    'messageMode' => $messageMode
                );
                
                $messageID = $row[4];
            }
            
            $query = "UPDATE eb_chat_details SET isDelivered = 1 WHERE id = ?";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"s",$messageID);
                mysqli_stmt_execute($stmt);
                
                $query = "UPDATE eb_chat_details SET isRead = 1 WHERE sentToID = ?";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt,"s",$id);
                    mysqli_stmt_execute($stmt);
                    
                    $error   = false;
                } else {
                    $error   = true;
                }
            } else {
                $error   = true;
            }
            
            echo json_encode($json);
            
        break;
    
    
        case "messages_seller" :
            
            $chatID = $_POST["chatID"];
            
            $sql    = '
                SELECT
                    a.message,
                    DATE_FORMAT(a.dateCreated, "%m/%d/%Y %h:%i %p") AS dateCreated,
                    (SELECT sellerID FROM eb_chat_header WHERE id = a.chatID) AS senderID,
                    a.sentToID AS receiverID
                FROM
                    eb_chat_details a
                WHERE
                    a.chatID = '.$chatID.'
                ORDER BY
                    a.dateCreated ASC;
            ';
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $messageMode = "Sender";
                
                if ($row[2] == $row[3]) {
                    $messageMode = "Receiver";
                }
                
                $json[] = array(
                    'message'     => $row[0],
                    'dateCreated' => $row[1],
                    'messageMode' => $messageMode
                );
            }
            echo json_encode($json);
            
        break;
    
        case "messages_seller_1" :
            
            $chatID    = $_POST["chatID"];
            $id        = $_SESSION["id"];
            $messageID = 0;
            
            $sql    = '
                SELECT
                    a.message,
                    DATE_FORMAT(a.dateCreated, "%m/%d/%Y %h:%i %p") AS dateCreated,
                    (SELECT sellerID FROM eb_chat_header WHERE id = a.chatID) AS senderID,
                    a.sentToID AS receiverID,
                    a.id
                FROM
                    eb_chat_details a
                WHERE
                    a.chatID = '.$chatID.'
                AND
                    a.sentToID = '.$id.'
                AND
                    a.isDelivered = 0
                ORDER BY
                    a.dateCreated ASC;
            ';
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $messageMode = "Sender";
                
                if ($row[2] == $row[3]) {
                    $messageMode = "Receiver";
                }
                
                $json[] = array(
                    'message'     => $row[0],
                    'dateCreated' => $row[1],
                    'messageMode' => $messageMode
                );
                
                $messageID = $row[4];
            }
            
            $query = "UPDATE eb_chat_details SET isDelivered = 1 WHERE id = ?";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"s",$messageID);
                mysqli_stmt_execute($stmt);
                
                $query = "UPDATE eb_chat_details SET isRead = 1 WHERE sentToID = ?";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt,"s",$id);
                    mysqli_stmt_execute($stmt);
                    
                    $error   = false;
                } else {
                    $error   = true;
                }
            } else {
                $error   = true;
            }
            
            echo json_encode($json);
            
        break;
    
        case "send_message" :
            
            $chatID      = $_POST["chatID"];
            $chatmateID  = $_POST["chatmateID"];
            $message     = $_POST["message"];
            $isDelivered = 0;
            
            $query = "INSERT INTO eb_chat_details (chatID,message,dateCreated,sentToID,isDelivered) VALUES (?,?,?,?,?)";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"sssss",$chatID,$message,$global_date,$chatmateID,$isDelivered);
                mysqli_stmt_execute($stmt);
                
                $error = false;
                $message = "Message Sent";
                $color = "green";
                
            } else {
                $error = true;
                $message = "Something went wrong";
                $color = "red";
            }
            
            $json[] = array(
                'error' => $error,
                'message' => $message,
                'color' => $color
            );
            echo json_encode($json);
            
        break;
    
        case "rerpot_user" :
            
            $ref            = $_POST["ref"];
            $createdBy      = $_SESSION["clientID"];
            $userIDreported = $_POST["userIDreported"];
            $dateCreated    = $global_date;
            $message        = $_POST["message"];
            
            $query = "INSERT INTO eb_inquiries (ref,createdBy,userIDreported,dateCreated,message) VALUES (?,?,?,?,?)";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"sssss",$ref,$createdBy,$userIDreported,$dateCreated,$message);
                mysqli_stmt_execute($stmt);
                
                $error = false;
                $message = "Report has been sent";
                $color = "green";
                
            } else {
                $error = true;
                $message = "Something went wrong";
                $color = "red";
            }
            
            $json[] = array(
                'error' => $error,
                'message' => $message,
                'color' => $color
            );
            echo json_encode($json);
            
        break;
    }
    
    mysqli_close($con);
?>