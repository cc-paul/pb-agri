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
        case "displaycategory" :
            
                $sql    = '
                    SELECT
                        id,
                        REPLACE(category,"'."'".'","") AS category,
                        REPLACE(description,"'."'".'","") AS description
                    FROM
                        eb_category
                    WHERE
                        isActive = 1
                    AND
                        IFNULL(description,"") != ""
                    ORDER BY
                        category ASC;
                ';
                $result = mysqli_query($con,$sql);
                
                $json = array();
                while ($row  = mysqli_fetch_row($result)) {
                    $json[] = array(
                        'id' => $row[0],
                        'category' => $row[1],
                        'description' => $row[2]
                    );
                }
                echo json_encode($json);
            
            break;
        
        case "categorysearch" :
            
                $search = str_replace("'","",$_POST["search"]);
            
                $sql    = '
                    SELECT
                        id,
                        REPLACE(category,"'."'".'","") AS category,
                        REPLACE(description,"'."'".'","") AS description
                    FROM
                        eb_category
                    WHERE
                        isActive = 1
                    AND
                        IFNULL(description,"") != ""
                    AND
                        REPLACE(category,"'."'".'","") = "'.$search.'"
                    ORDER BY
                        category ASC;
                ';
                $result = mysqli_query($con,$sql);
                
                $json = array();
                while ($row  = mysqli_fetch_row($result)) {
                    $json[] = array(
                        'id' => $row[0],
                        'category' => $row[1],
                        'description' => $row[2]
                    );
                }
                echo json_encode($json);
            
            break;
        
        case "finditem" :
            
                $categoryID = $_POST["categoryID"];
                $search = str_replace("'","",$_POST["search"]);
            
                $sql    = '
                    SELECT
                        a.id,
                        REPLACE(a.itemName,"'."'".'","") AS itemName,
                        REPLACE(a.howToUse,"'."'".'","") AS howToUse,
                        REPLACE(b.category,"'."'".'","") AS category,
                        REPLACE(a.description,"'."'".'","") AS description
                    FROM
                        eb_products a
                    INNER JOIN
                        eb_category b
                    ON
                        a.categoryID = b.id
                    WHERE
                        a.isActive = 1
                    AND
                        b.id = '.$categoryID.'
                    AND
                        REPLACE(a.itemName,"'."'".'","") = "'.$search.'";
                ';
                
                $result = mysqli_query($con,$sql);
                
                $json = array();
                while ($row  = mysqli_fetch_row($result)) {
                    $json[] = array(
                        'id' => $row[0],
                        'itemName' => $row[1],
                        'howToUse' => $row[2],
                        'category' => $row[3],
                        'description' => $row[4]
                    );
                }
                echo json_encode($json);
            
            break;
        
        case "finditem_like" :
            
                $categoryID = $_POST["categoryID"];
                $search = str_replace("'","",$_POST["search"]);
            
                $sql    = '
                    SELECT
                        a.id,
                        REPLACE(a.itemName,"'."'".'","") AS itemName,
                        REPLACE(a.howToUse,"'."'".'","") AS howToUse,
                        REPLACE(b.category,"'."'".'","") AS category,
                        REPLACE(a.description,"'."'".'","") AS description
                    FROM
                        eb_products a
                    INNER JOIN
                        eb_category b
                    ON
                        a.categoryID = b.id
                    WHERE
                        a.isActive = 1
                    AND
                        b.id = '.$categoryID.'
                    AND
                        REPLACE(a.itemName,"'."'".'","") LIKE "%'.$search.'%";
                ';
                
                $result = mysqli_query($con,$sql);
                
                $json = array();
                while ($row  = mysqli_fetch_row($result)) {
                    $json[] = array(
                        'id' => $row[0],
                        'itemName' => $row[1],
                        'howToUse' => $row[2],
                        'category' => $row[3],
                        'description' => $row[4]
                    );
                }
                echo json_encode($json);
            
            break;
    }
    
    mysqli_close($con);    
?>