<?php
    include dirname(__FILE__,2) . '/config.php';;
	include $main_location . '/connection/conn.php';

    $userID = $_SESSION['id'];
    
    $sql    = "
        SELECT
            a.id,
            a.category
        FROM
            eb_category a
        WHERE
            a.isActive = 1
        AND
            a.isSub = 1
        ORDER BY
            a.category ASC;
    ";
    
    $result = mysqli_query($con,$sql);
    
    while ($row  = mysqli_fetch_row($result)) {
        echo "<option value='".$row[0]."'>".$row[1]."</option>";
    }

    mysqli_free_result($result);
    mysqli_close($con);
?>