<?php
include("db-connect.php");

$select8 = "SELECT * FROM `service form` ORDER BY Service_FormID DESC";
$result8 = mysqli_query($connection,$select8);
$row = mysqli_fetch_array($result8);
$lastid = $row['Service_FormID'];
if($lastid == "")
{
    $SFid = "SER0000001";
}
else
{
    $idd = str_replace("SER","","$lastid");
    $id = str_pad($idd+1,7,0,STR_PAD_LEFT);
    $SFid = "SER" . $id;
}

if(isset($_POST['send']))
    {
        $Service_FormID = $_POST['ServiceID'];
        $Part1 = $_POST['Part1'];
        $Part2 = $_POST['Part2'];
        $Part3 = $_POST['Part3'];
        $Part4 = $_POST['Part4'];
        $Part5 = $_POST['Part5'];

        //insert data to db
        if($Part2 == 'none')
        {
        $insert = "INSERT INTO `service form`(Service_FormID,Requested_Part_ID_1,Requested_Part_ID_2,Requested_Part_ID_3,Requested_Part_ID_4,Requested_Part_ID_5)
        VALUES ('$Service_FormID','$Part1',NULL,NULL,NULL,NULL)";
        }
        else if($Part3 == 'none')
        {
        $insert = "INSERT INTO `service form`(Service_FormID,Requested_Part_ID_1,Requested_Part_ID_2,Requested_Part_ID_3,Requested_Part_ID_4,Requested_Part_ID_5)
        VALUES ('$Service_FormID','$Part1','$Part2',NULL,NULL,NULL)";
        }
         else if($Part4 == 'none')
        {
        $insert = "INSERT INTO `service form`(Service_FormID,Requested_Part_ID_1,Requested_Part_ID_2,Requested_Part_ID_3,Requested_Part_ID_4,Requested_Part_ID_5)
        VALUES ('$Service_FormID','$Part1','$Part2','$Part3',NULL,NULL)";
        }
         else if($Part5 == 'none')
        {
        $insert = "INSERT INTO `service form`(Service_FormID,Requested_Part_ID_1,Requested_Part_ID_2,Requested_Part_ID_3,Requested_Part_ID_4,Requested_Part_ID_5)
        VALUES ('$Service_FormID','$Part1','$Part2','$Part3','$Part4',NULL)";
        }
        else
        {
        $insert = "INSERT INTO `service form`(Service_FormID,Requested_Part_ID_1,Requested_Part_ID_2,Requested_Part_ID_3,Requested_Part_ID_4,Requested_Part_ID_5)
        VALUES ('$Service_FormID','$Part1','$Part2','$Part3','$Part4','$Part5')";
        }
        #VALUES ('$Service_FormID','$Part1','$Part2','$Part3','$Part4','$Part5')";

            if(mysqli_query($connection,$insert)) 
            {
                $select8 = "SELECT * FROM `service form` ORDER BY Service_FormID DESC";
                $result8 = mysqli_query($connection,$select8);
                $row = mysqli_fetch_array($result8);
                $lastid = $row['Service_FormID'];
                if($lastid == "")
                    {
                        $SFid = "SER0000001";
                    }
                else
                    {
                        $idd = str_replace("SER","","$lastid");
                        $id = str_pad($idd+1,7,0,STR_PAD_LEFT);
                        $SFid = "SER" . $id;
                    }
                echo'<script>alert("Sent request successfully.!");</script>';
                echo "<script>setTimeout(\"location.href = 'Inspection_Form.php';\",100);</script>";;
            }
            else
            {
                echo'<script>alert("ERROR: could not able to add crew set.!");</script>';
            }
        //close connection 
        mysqli_close($connection);
    }

$select9 = "SELECT * FROM `inspection form` ORDER BY Inspection_FormID DESC";
$result9 = mysqli_query($connection,$select9);
$row2 = mysqli_fetch_array($result9);
$lastid2 = $row2['Inspection_FormID'];
if($lastid2 == "")
{
    $IPid = "INS0000001";
}
else
{
    $idd2 = str_replace("INS","","$lastid2");
    $id2 = str_pad($idd2+1,7,0,STR_PAD_LEFT);
    $IPid = "INS" . $id2;
}

    if(isset($_POST['submit']))
    {
        $InspectionID = $_POST['InspectionID'];
        $InspectionDate = $_POST['InspectionDate'];
        $InspectionType = $_POST['InspectionType'];
        $Engineer_ID = $_POST['Engineer_ID'];
        $AirplaneID = $_POST['AirplaneID'];
        $Comment = $_POST['Comment'];
        $ServiceID2 = $_POST['ServiceID2'];
        $AirplaneStatus = $_POST['AirplaneStatus'];
        //insert data to db
        if($AirplaneStatus == 'BRK'&& $ServiceID2 == 'none' )
        {
            echo'<script>alert("Please input service form first.!");</script>';
            echo "<script>setTimeout(\"location.href = 'Inspection_Form.php';\",100);</script>";;
        }
        else if($AirplaneStatus == 'BRK'&& $ServiceID2 != 'none') 
        {
        $insert2 = "INSERT INTO `inspection form`(Inspection_FormID,Inspection_Date,Inspection_Type,Engineer_ID,Airplance_Code,Comment,Service_FormID,Status_Code)
        VALUES ('$InspectionID','$InspectionDate','$InspectionType','$Engineer_ID','$AirplaneID','$Comment',$ServiceID2,'$AirplaneStatus')";
        
        if(mysqli_query($connection,$insert2)) 
            {
                $select9 = "SELECT * FROM `inspection form` ORDER BY Inspection_FormID DESC";
                $result9 = mysqli_query($connection,$select9);
                $row2 = mysqli_fetch_array($result9);
                $lastid2 = $row2['Inspection_FormID'];
                if($lastid2 == "")
                {
                    $IPid = "INS0000001";
                }
                else
                {
                    $idd2 = str_replace("INS","","$lastid2");
                    $id2  = str_pad($idd2+1,7,0,STR_PAD_LEFT);
                    $IPid = "INS" . $id2;
                }
                echo'<script>alert("Submit successfully.!");</script>';
                echo "<script>setTimeout(\"location.href = 'Inspection_Form.php';\",100);</script>";;
            }
            else
            {
                echo'<script>alert("ERROR: could not able to add crew set.!");</script>';
            }
        }
        else
        {
        $insert2 = "INSERT INTO `inspection form`(Inspection_FormID,Inspection_Date,Inspection_Type,Engineer_ID,Airplance_Code,Comment,Service_FormID,Status_Code)
        VALUES ('$InspectionID','$InspectionDate','$InspectionType','$Engineer_ID','$AirplaneID','$Comment',NULL,'$AirplaneStatus')";

        if(mysqli_query($connection,$insert2)) 
            {
                $select9 = "SELECT * FROM `inspection form` ORDER BY Inspection_FormID DESC";
                $result9 = mysqli_query($connection,$select9);
                $row2 = mysqli_fetch_array($result9);
                $lastid2 = $row2['Inspection_FormID'];
                if($lastid2 == "")
                {
                    $IPid = "INS0000001";
                }
                else
                {
                    $idd2 = str_replace("INS","","$lastid2");
                    $id2 = str_pad($idd2+1,7,0,STR_PAD_LEFT);
                    $IPid = "INS" . $id2;
                }
                echo'<script>alert("Submit successfully.!");</script>';
                echo "<script>setTimeout(\"location.href = 'Inspection_Form.php';\",100);</script>";;
            }
            else
            {
                echo'<script>alert("ERROR: could not able to add crew set.!");</script>';
            }
        }
        //close connection 
        mysqli_close($connection);
    }
?>