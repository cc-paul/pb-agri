<?php
    include dirname(__FILE__,2) . '/config.php';;
	include $main_location . '/connection/conn.php';

    $userID = $_SESSION['id'];
    
    $sql    = "
        SELECT
            a.id,
            a.packtype
        FROM
            eb_packtype a
        WHERE
            a.isActive = 1
        ORDER BY
            a.packtype ASC;
    ";
    
    $result = mysqli_query($con,$sql);
    
    while ($row  = mysqli_fetch_row($result)) {
        echo "<option value='".$row[0]."' title='".$row[1]."' data-coordinates='".$row[2]."' data-clientid='".$row[3]."'>".$row[1]."</option>";
    }

    mysqli_free_result($result);
    mysqli_close($con);
?>