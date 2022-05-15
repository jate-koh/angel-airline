<?php
 include("db-connect.php");
    $id=$_GET["fid"];
    $sql = "DELETE FROM `flight` WHERE `FlightID` LIKE '%$id%'";
    $result=mysqli_query($connection,$sql);
    

    if($result) 
        {
            echo'<script>alert("Delete successfully.!");</script>';
            echo "<script>setTimeout(\"location.href = 'flight-data.php';\",100);</script>";;
        }
    else
        {
            echo'<script>alert("ERROR: could not able to add crew set.!");</script>';
        }
?> 