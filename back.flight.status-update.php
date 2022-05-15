<?php
 include("database-connect.php");
    $id=$_POST["FlightID"];
    $sql = "SELECT * FROM `flight` WHERE `FlightID` LIKE '%$id%'";
    $result1=mysqli_query($conn,$sql);
    $row =mysqli_fetch_assoc($result1);

    if(isset($_POST['Update']))
    {
    $status = $_POST['Status'];
    $sql2 = "UPDATE `flight` SET `Status` = '$status' WHERE `FlightID` LIKE '%$id%'"; 
    $result2 = mysqli_query($conn,$sql2);
     if($result2) 
        {
            echo'<script>alert("Status Update successfully.!");</script>';
            echo "<script>setTimeout(\"location.href = 'back.flight-data.php';\",100);</script>";;
        }
    else
        {
            echo'<script>alert("ERROR: could not able to add crew set.!");</script>';
        }
    }

?> 