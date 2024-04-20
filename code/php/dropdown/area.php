<?php
    include dirname(__FILE__,2) . '/config.php';;
	include $main_location . '/connection/conn.php';

    $userID = $_SESSION['id'];
    
    $sql    = "
        SELECT
            c.id,
            CONCAT(b.clientsName,' - ',c.branchName) AS branchName,
            c.coordinates,
            a.clientID
        FROM
            hris_area_assignment a
        INNER JOIN
            hris_masterfile_client b
        ON
            a.clientID = b.id
        INNER JOIN
            hris_mastefile_client_branches c
        ON
            a.areaID = c.id
        WHERE
            a.userID = $userID
        AND
            a.isActive = 1
        ORDER BY
            b.clientsName ASC,
            c.branchName ASC
    ";
    
    $result = mysqli_query($con,$sql);
    
    while ($row  = mysqli_fetch_row($result)) {
        echo "<option value='".$row[0]."' title='".$row[1]."' data-coordinates='".$row[2]."' data-clientid='".$row[3]."'>".$row[1]."</option>";
    }

    mysqli_free_result($result);
    mysqli_close($con);
?>