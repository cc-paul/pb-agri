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
        case "save_product" :
            
            
            
            $categoryID = $_POST["category"];
            $packID = $_POST["packtype"];
            $itemName = $_POST["itemname"];
            $description = $_POST["description"];
            $manufacturersName = $_POST["manufacturersName"];
            $dateManufactured = $_POST["dateManufactured"];
            $expirationDate = $_POST["expirationDate"];
            $costPrice = $_POST["costPrice"];
            $retailPrice = $_POST["retailPrice"];
            $stocks = $_POST["stocks"];
            $totalSold = $_POST["totalSold"];
            $isActive = $_POST["isActive"];
            $dateCreated = $global_date;
            $createdBy = $_SESSION["id"];
            $isNewProduct = $_POST["isNewProduct"];
            $oldProductName = $_POST["oldProductName"];
            $howToUse = $_POST["howToUse"];
            $id = $_POST["id"];
            $subCategoryID = $_POST["subCategoryID"];
            $fda = $_POST["fda"];
            $youtubeLink = $_POST["youtubeLink"];
            $query = " `from` = 'Admin' ";
            
            if ($_SESSION["position"] != 'Admin') {
                $query = " createdBy = " . $_SESSION["id"];
            }
            
            $arr_exist = array();
            
            if ($isNewProduct == 1) {
                $find_product = mysqli_query($con,"SELECT * FROM eb_products WHERE itemName = '$itemName' AND $query");
                if (mysqli_num_rows($find_product) != 0) {
                    mysqli_next_result($con);
                    array_push($arr_exist,"Product Name");
                }
                
                if (count($arr_exist) != 0) {
                    $error   = true;
                    $color   = "orange";
                    $message = "Product Name already exist";
                } else {
                    $query = "INSERT INTO eb_products (categoryID,packID,itemName,description,manufacturersName,dateManufactured,expirationDate,costPrice,retailPrice,stocks,totalSold,dateCreated,isActive,createdBy,howToUse,subCategoryID,fda,youtubeLink) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"ssssssssssssssssss",$categoryID,$packID,$itemName,$description,$manufacturersName,$dateManufactured,$expirationDate,$costPrice,$retailPrice,$stocks,$totalSold,$dateCreated,$isActive,$createdBy,$howToUse,$subCategoryID,$fda,$youtubeLink);
                        mysqli_stmt_execute($stmt);
                        
                        
                        $error   = false;
                        $color   = "green";
                        $message = "Product has been saved successfully";
                    } else {
                        $error   = true;
                        $color   = "red";
                        $message = "Error saving product";
                    }
                }
            } else {
                if ($itemName != $oldProductName) {
                    $find_product = mysqli_query($con,"SELECT * FROM eb_products WHERE itemName = '$itemName' AND $query");
                    if (mysqli_num_rows($find_product) != 0) {
                        mysqli_next_result($con);
                        array_push($arr_exist,"Product Name");
                    }
                }
                
                if (count($arr_exist) != 0) {
                    $error   = true;
                    $color   = "orange";
                    $message = "Product Name already exist";
                } else {
                    $query = "UPDATE eb_products SET youtubeLink=?,categoryID=?,subCategoryID=?,fda=?,packID=?,itemName=?,description=?,manufacturersName=?,dateManufactured=?,expirationDate=?,costPrice=?,retailPrice=?,stocks=?,totalSold=?,isActive=?,howToUse=? WHERE id =?";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"sssssssssssssssss",$youtubeLink,$categoryID,$subCategoryID,$fda,$packID,$itemName,$description,$manufacturersName,$dateManufactured,$expirationDate,$costPrice,$retailPrice,$stocks,$totalSold,$isActive,$howToUse,$id);
                        mysqli_stmt_execute($stmt);
                        
                        
                        $error   = false;
                        $color   = "green";
                        $message = "Product has been saved successfully";
                    } else {
                        $error   = true;
                        $color   = "red";
                        $message = "Error saving product";
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
    
        case "display_product" :
            
            $id = $_SESSION["id"];
            $query = " a.`from` = 'Admin' ";
            
            if ($_SESSION["position"] != 'Admin') {
                $query = " a.createdBy = $id ";
            }
            
            $sql = "
                SELECT
                    b.category,
                    c.packtype,
                    a.itemName,
                    a.description,
                    a.manufacturersName,
                    DATE_FORMAT(IF(a.dateManufactured = '00-00-0000','',a.dateManufactured),'%m/%d/%Y') AS dateManufactured,
                    DATE_FORMAT(IF(a.expirationDate = '00-00-0000','',a.expirationDate),'%m/%d/%Y') AS expirationDate,
                    FORMAT(a.costPrice,2) AS f_costPrice,
                    a.costPrice,
                    FORMAT(a.retailPrice,2) AS f_retailPrice,
                    a.retailPrice,
                    FORMAT(a.stocks,0) AS f_stocks,
                    a.stocks,
                    FORMAT(a.totalSold,0) AS f_totalSold,
                    a.totalSold,
                    IF(a.isActive = 1,'Active','Disabled') AS `status`,
                    a.id,
                    DATE_FORMAT(a.dateCreated,'%m/%d/%Y') AS dateCreated,
                    a.isActive,
                    a.categoryID,
                    a.packID,
                    IF(a.dateManufactured = '00-00-0000',null,a.dateManufactured) AS s_dateManufactured,
                    IF(a.expirationDate = '00-00-0000',null,a.expirationDate) AS s_expirationDate,
                    a.howToUse,
                    a.subCategoryID,
                    a.youtubeLink,
                    a.hasVideo
                FROM
                    eb_products a
                INNER JOIN
                    eb_category b
                ON
                    a.categoryID = b.id
                INNER JOIN
                    eb_packtype c
                ON
                    a.packID = c.id
                WHERE
                    $query
                ORDER BY
                    a.itemName ASC
            ";
            return builder($con,$sql);
            
        break;
    
        case "display_category" :
            
            $sql = "
                SELECT
                    a.category,
                    IF(a.isActive = 1,'Active','Disabled') AS `status`,
                    DATE_FORMAT(a.dateCreated,'%m/%d/%Y') AS dateCreated,
                    a.id,
                    a.isActive,
                    a.description,
                    IF(a.isSub != 1,'Category','Sub-Category') AS categoryType,
                    a.isSub
                FROM
                    eb_category a
                ORDER BY
                    a.category ASC;
            ";
            return builder($con,$sql);
            
        break;
    
        case "save_category" :
            
            $isNewCategory = $_POST["isNewCategory"];
            $oldCategoryName = $_POST["oldCategoryName"];
            $isActive = $_POST["isActive"];
            $category = $_POST["category"];
            $categoryID = $_POST["categoryID"];
            $description = $_POST["description"];
            $isActiveSub = $_POST["isActiveSub"];
            
            $arr_exist = array();
            
            if ($isNewCategory == 1) {
                $find_category = mysqli_query($con,"SELECT * FROM eb_category WHERE category = '$category' AND isSub = " .$isActiveSub);
                if (mysqli_num_rows($find_category) != 0) {
                    mysqli_next_result($con);
                    array_push($arr_exist,"Category");
                }
                
                if (count($arr_exist) != 0) {
                    $error   = true;
                    $color   = "orange";
                    $message = "Category already exist";
                } else {
                    $query = "INSERT INTO eb_category (category,dateCreated,isActive,description,isSub) VALUES (?,?,?,?,?)";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"sssss",$category,$global_date,$isActive,$description,$isActiveSub);
                        mysqli_stmt_execute($stmt);
                        
                        $error   = false;
                        $color   = "green";
                        $message = "Category has been save successfully"; 
                    } else {
                        $error   = true;
                        $color   = "red";
                        $message = "Error saving category";
                    }
                }
            } else {
                if ($oldCategoryName != $category) {
                    $find_category = mysqli_query($con,"SELECT * FROM eb_category WHERE category = '$category' AND isSub = " .$isActiveSub);
                    if (mysqli_num_rows($find_category) != 0) {
                        mysqli_next_result($con);
                        array_push($arr_exist,"Category");
                    }
                }
                
                if (count($arr_exist) != 0) {
                    $error   = true;
                    $color   = "orange";
                    $message = "Category already exist";
                } else {
                    $query = "UPDATE eb_category SET category=?,isActive=?,description=?,isSub=? WHERE id=?";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"sssss",$category,$isActive,$description,$isActiveSub,$categoryID);
                        mysqli_stmt_execute($stmt);
                        
                        $error   = false;
                        $color   = "green";
                        $message = "Category has been save successfully"; 
                    } else {
                        $error   = true;
                        $color   = "red";
                        $message = "Error saving category";
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
    
        case "display_packtype" :
            
            $sql = "
                SELECT
                    a.packtype,
                    IF(a.isActive = 1,'Active','Disabled') AS `status`,
                    DATE_FORMAT(a.dateCreated,'%m/%d/%Y') AS dateCreated,
                    a.id,
                    a.isActive
                FROM
                    eb_packtype a
                ORDER BY
                    a.packtype ASC;
            ";
            return builder($con,$sql);
            
        break;
    
        case "save_packtype" :
            
            $isNewPackType = $_POST["isNewPackType"];
            $oldPackTypeName = $_POST["oldPackTypeName"];
            $isActive = $_POST["isActive"];
            $packType = $_POST["packType"];
            $packTypeID = $_POST["packTypeID"];
            
            $arr_exist = array();
            
            if ($isNewPackType == 1) {
                $find_packType = mysqli_query($con,"SELECT * FROM eb_packtype WHERE packtype = '$packType'");
                if (mysqli_num_rows($find_packType) != 0) {
                    mysqli_next_result($con);
                    array_push($arr_exist,"Pack Type");
                }
                
                if (count($arr_exist) != 0) {
                    $error   = true;
                    $color   = "orange";
                    $message = "Pack Type already exist";
                } else {
                    $query = "INSERT INTO eb_packtype (packtype,dateCreated,isActive) VALUES (?,?,?)";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"sss",$packType,$global_date,$isActive);
                        mysqli_stmt_execute($stmt);
                        
                        $error   = false;
                        $color   = "green";
                        $message = "Pack Type has been save successfully"; 
                    } else {
                        $error   = true;
                        $color   = "red";
                        $message = "Error saving Pack Type";
                    }
                }
            } else {
                if ($oldPackTypeName != $packType) {
                    $find_packType = mysqli_query($con,"SELECT * FROM eb_packtype WHERE packType = '$packType'");
                    if (mysqli_num_rows($find_packType) != 0) {
                        mysqli_next_result($con);
                        array_push($arr_exist,"Pack Type");
                    }
                }
                
                if (count($arr_exist) != 0) {
                    $error   = true;
                    $color   = "orange";
                    $message = "Pack Type already exist";
                } else {
                    $query = "UPDATE eb_packtype SET packType=?,isActive=? WHERE id=?";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"sss",$packType,$isActive,$packTypeID);
                        mysqli_stmt_execute($stmt);
                        
                        $error   = false;
                        $color   = "green";
                        $message = "Pack Type has been save successfully"; 
                    } else {
                        $error   = true;
                        $color   = "red";
                        $message = "Error saving Pack Type";
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
    
        case "display_image" :
            
            $id = $_POST["id"];
            
            $sql = "SELECT id,filename FROM eb_product_image WHERE productID = $id AND isActive = 1";
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $json[] = array(
                    'id' => $row[0],
                    'fileName' => $row[1]
                );
            }
            echo json_encode($json);
            
        break;
    
        case "item_details" :
            
            $id = $_POST["id"];
            
            $sql = "
                SELECT
                    b.category,
                    a.itemName,
                    a.description,
                    a.manufacturersName,
                    IF(a.dateManufactured = '0000-00-00','Not Availabe',DATE_FORMAT(a.dateManufactured,'%m/%d/%Y')) AS dateManufactured,
                    IF(a.expirationDate = '0000-00-00','No Expiration Date',DATE_FORMAT(a.expirationDate,'%m/%d/%Y')) AS expirationDate,
                    REPLACE(FORMAT(a.retailPrice,2),'.00','') as retailPrice,
                    a.description,
                    IFNULL((SELECT fileName FROM eb_product_image WHERE productID = a.id AND isActive = 1 ORDER BY id LIMIT 1),'default') AS image,
                    IF(IFNULL(a.howToUse,'') = '','No Instruction Added',a.howToUse) AS howToUse,
                    a.fda,
                    FORMAT(a.stocks,0) AS stocks,
                    a.hasVideo,
                    IFNULL(a.youtubeLink,0) AS youtubeLink
                FROM
                    eb_products a
                INNER JOIN
                    eb_category b
                ON
                    a.categoryID = b.id
                WHERE
                    a.id = $id
            ";
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $json[] = array(
                    'category' => $row[0],
                    'itemName' => $row[1],
                    'description' => $row[2],
                    'manufacturersName' => $row[3],
                    'dateManufactured' => $row[4],
                    'expirationDate' => $row[5],
                    'retailPrice' => $row[6],
                    'description' => $row[7],
                    'image' => $row[8],
                    'howToUse' => $row[9],
                    'fda' => $row[10],
                    'stocks' => $row[11],
                    'hasVideo' => $row[12],
                    'youtubeLink' => $row[13]
                );
            }
            echo json_encode($json);
            
        break;
    
        case "delete_image" :
            
            $id = $_POST["id"];
            
            $query = "UPDATE eb_product_image SET isActive=0 WHERE id=?";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"s",$id);
                mysqli_stmt_execute($stmt);
                
                $error   = false;
                $color   = "green";
            } else {
                $error   = true;
                $color   = "red";
            }
            
            $json[] = array(
                'error' => $error,
                'color' => $color
            );
            echo json_encode($json);
            
        break;
    
        case "add_to_cart" :
            
            $itemID   = $_POST["id"];
            $clientID = $_SESSION["clientID"];
            
            $find_query = mysqli_query($con,"SELECT * FROM eb_cart  WHERE clientID = $clientID AND itemID = $itemID AND isRemoved = 0");
            if (mysqli_num_rows($find_query) == 0) {
                mysqli_next_result($con);
                
                
                $query = "INSERT INTO eb_cart (clientID,itemID) VALUES (?,?)";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt,"ss",$clientID,$itemID);
                    mysqli_stmt_execute($stmt);
                    
                    $error = false;
                    $message = "Item has been added to your cart";
                    
                } else {
                    $error = true;
                    $message = "Error adding item to cart";
                }

            } else {
                $error = true;
                $message = "This item is already in your cart";
            }
            
            
            $json[] = array(
                'error' => $error,
                'message' => $message
            );
            echo json_encode($json);
            
        break;
    
        case "remove_to_cart" :
            
            $id = $_POST["id"];
            
            $query = "UPDATE eb_cart SET isRemoved = 1 WHERE id = ?";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"s",$id);
                mysqli_stmt_execute($stmt);
                
                $error = false;
                $message = "Item has been remove to your cart";
                
            } else {
                $error = true;
                $message = "Error removing item to cart";
            }
            
            
            $json[] = array(
                'error' => $error,
                'message' => $message
            );
            echo json_encode($json);
            
        break;
        
    
        case "cart_items" :
            
            $clientID    = !isset($_SESSION["clientID"]) ? 0 : $_SESSION["clientID"];
            $productName = $_POST["itemName"];
            
            $sql = "
                SELECT
                    REPLACE(FORMAT(b.retailPrice,2),'.00','') AS retailPrice,
                    b.itemName,
                    b.manufacturersName,
                    IFNULL((SELECT fileName FROM eb_product_image WHERE productID = b.id AND isActive = 1 ORDER BY id LIMIT 1),'default') AS image,
                    a.id,
                    a.itemID
                FROM
                    eb_cart a
                INNER JOIN
                    eb_products b
                ON
                    a.itemID = b.id
                WHERE
                    a.isRemoved = 0
                AND
                    a.clientID = $clientID
                AND
                    b.itemName LIKE '%$productName%'
            ";
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_row($result)) {
                $json[] = array(
                    'retailPrice' => $row[0],
                    'itemName' => $row[1],
                    'manufacturersName' => $row[2],
                    'image' => $row[3],
                    'id' => $row[4],
                    'itemID' => $row[5]
                );
            }
            echo json_encode($json);
            
        break;
    
        case "checkout" :
            
            $refNumber = $_POST["refNumber"];
            $clientID  = $_SESSION["clientID"];
            $datePurchased = $global_date;
            $items = $_POST["items"];
            $ids = explode(",",$_POST["ids"]);
            
            $query = "INSERT INTO eb_checkout (refNumber,clientID,datePurchased) VALUES (?,?,?)";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"sss",$refNumber,$clientID,$datePurchased);
                mysqli_stmt_execute($stmt);
                
                
                if (mysqli_query($con,"INSERT INTO eb_checkout_item (refNumber,itemID,price,qty) VALUES ".$items)) {
                    $error = false;
                    $message = "Item has been checked out with the refererence number of ". $refNumber;
                    
                    
                    foreach($ids as $id) {
                        $data_id = explode('~', $id);
                        $qty     = $data_id[0];
                        $id      = $data_id[1];
                        mysqli_query($con,"UPDATE eb_products SET stocks=stocks-$qty, totalSold = totalSold+$qty WHERE id IN ($id)");
                    }
                } else {
                    $error = true;
                    $message = "Check out details has been saved but the items is not. Please contact support";
                }
                
                
            } else {
                $error = true;
                $message = "Unable to save the check out details";
            }
            
            $json[] = array(
                'error' => $error,
                'message' => $message
            );
            echo json_encode($json);
            
        break;
    
        case "checkout_ref" :
            
            $clientID  = $_SESSION["clientID"];
            
            $sql = "
                SELECT
                    a.refNumber,
                    COUNT(1) AS totalItems,
                    REPLACE(FORMAT(SUM(b.price * b.qty),2),'.00','') AS totalAmount
                FROM
                    eb_checkout a
                INNER JOIN
                    eb_checkout_item b
                ON
                    a.refNumber = b.refNumber
                WHERE
                    a.clientID = $clientID
                GROUP BY
                    a.refNumber
            ";
            return builder($con,$sql);
            
        break;
    
        case "checkout_ref_item" :
            
            $refNumber  = $_POST["refNumber"];
            
            $sql = "
                SELECT
                    b.itemName,
                    REPLACE(FORMAT(b.retailPrice,2),'.00','') AS retailPrice,
                    FORMAT(a.qty,0) AS qty,
                    REPLACE(FORMAT(b.retailPrice * a.qty,2),'.00','') AS total,
                    CONCAT(c.firstName,' ',c.middleName,' ',c.lastName) AS seller,
                    a.`status`,
                    DATE_FORMAT(a.deliveryDate,'%m/%d/%Y') AS deliveryDate,
                    a.id,
                    b.description
                FROM
                    eb_checkout_item a
                INNER JOIN
                    eb_products b
                ON
                    a.itemID = b.id
                INNER JOIN
                    eb_registration c
                ON
                    b.createdBy = c.id
                WHERE
                    a.refNumber = '$refNumber'
            ";
            return builder($con,$sql);
            
        break;
    
        case "checkout_ref_sell" :
            
            $sellerID = $_SESSION["id"];
            
            $sql = "
                SELECT
                    a.refNumber,
                    COUNT(1) AS totalItems,
                    REPLACE(FORMAT(SUM(b.price * b.qty),2),'.00','') AS totalAmount,
                    CONCAT(c.firstName,' ',c.middleName,' ',c.lastName) AS buyer,
                    c.emailAddress,
                    c.mobileNumber,
                    c.currentAddress
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
                WHERE
                    a.refNumber IN (SELECT refNumber FROM eb_checkout_item WHERE itemID IN (SELECT id FROM eb_products WHERE createdBy = $sellerID))
                GROUP BY
                    a.refNumber
            ";
            return builder($con,$sql);
            
        break;
    
        case "checkout_ref_item_sell" :
            
            $refNumber  = $_POST["refNumber"];
            $sellerID = $_SESSION["id"];
            
            $sql = "
                SELECT
                    b.itemName,
                    REPLACE(FORMAT(b.retailPrice,2),'.00','') AS retailPrice,
                    FORMAT(a.qty,0) AS qty,
                    REPLACE(FORMAT(b.retailPrice * a.qty,2),'.00','') AS total,
                    CONCAT(c.firstName,' ',c.middleName,' ',c.lastName) AS seller,
                    a.`status`,
                    DATE_FORMAT(a.deliveryDate,'%m/%d/%Y') AS deliveryDate,
                    a.id,
                    a.deliveryDate AS unfDeliveryDate
                FROM
                    eb_checkout_item a
                INNER JOIN
                    eb_products b
                ON
                    a.itemID = b.id
                INNER JOIN
                    eb_registration c
                ON
                    b.createdBy = c.id
                WHERE
                    a.refNumber = '$refNumber'
                AND
                    a.itemID IN (SELECT id FROM eb_products WHERE createdBy = $sellerID)
            ";
            return builder($con,$sql);
            
        break;
    
        case "update_delivery" :
            
            $id     = $_POST["id"];
            $status = $_POST["status"];
            $date   = $_POST["date"];
            
            $query = "UPDATE eb_checkout_item SET status = ?,deliveryDate = ? WHERE id = ?";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"sss",$status,$date,$id);
                mysqli_stmt_execute($stmt);
                
                
                
                if ($date == "") {
                    $query = "UPDATE eb_checkout_item SET deliveryDate = null WHERE id = ?";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt,"s",$id);
                        mysqli_stmt_execute($stmt);
                        
                        $error = false;
                        $message = "Item status has been updated";
                        $color = "green";
                        
                    } else {
                        $error = true;
                        $message = "Unable to update item";
                        $color = "red";
                    }
                } else {
                    $error = false;
                    $message = "Item status has been updated";
                    $color = "green";
                }
                
            } else {
                $error = true;
                $message = "Unable to update item";
                $color = "red";
            }
            
            $json[] = array(
                'error' => $error,
                'message' => $message,
                'color' => $color
            );
            echo json_encode($json);
            
        break;
    
        case "send_feedback" :
            
            $itemId = $_POST["itemId"];
            $rate = $_POST["rate"];
            $feedBack = $_POST["feedBack"];
            $id = $_SESSION["id"];
            
            $query = "INSERT INTO eb_feedback (itemId,rate,feedBack,createdBy,dateCreated) VALUES (?,?,?,?,?)";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt,"sssss",$itemId,$rate,$feedBack,$id,$global_date);
                mysqli_stmt_execute($stmt);
               
                $error   = false;
                $color   = "green";
                $message = "Feedback has been send"; 
               
            } else {
                $error   = true;
                $color   = "red";
                $message = "Error sending feedback"; 
            }
            
            $json[] = array(
                'error' => $error,
                'color' => $color,
                'message' => $message
            );
            echo json_encode($json);
            
        break;
    
        case "show_review" :
            
            $itemID = $_POST["itemID"];
            
            $sql    = "
                SELECT
                    a.rate,
                    CONCAT(b.lastName,', ',b.firstName,' ',b.middleName) AS fullName,
                    DATE_FORMAT(a.dateCreated,'%m/%d/%Y %r') AS dateCreated,
                    a.feedBack
                FROM
                    eb_feedback a 
                INNER JOIN
                    eb_registration b 
                ON 
                    a.createdBy = b.id
                WHERE
                    a.itemId = $itemID
                ORDER BY
                    a.dateCreated DESC;
            ";
            $result = mysqli_query($con,$sql);
            
            $json = array();
            while ($row  = mysqli_fetch_assoc($result)) {
                $json[] = array(
                    'rate'=> $row["rate"],
                    'fullName'=> $row["fullName"],
                    'dateCreated'=> $row["dateCreated"],
                    'feedBack'=> $row["feedBack"]
                );
            }
            echo json_encode($json);
            
        break;
    }
    
    mysqli_close($con);    
?>