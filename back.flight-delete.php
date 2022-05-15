<?php
 include("database-connect.php");
    $id=$_GET["fid"];
    $sql = "DELETE FROM `flight` WHERE `FlightID` LIKE '%$id%'";
    $result=mysqli_query($conn,$sql);
    

    if($result) 
        {
            echo'<script>alert("Delete successfully.!");</script>';
            echo "<script>setTimeout(\"location.href = 'back.flight-data.php';\",100);</script>";;
        }
    else
        {
            echo'<script>alert("ERROR: could not able to add crew set.!");</script>';
        }
?> 