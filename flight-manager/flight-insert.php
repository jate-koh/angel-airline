<?php    
 include("db-connect.php");
    
    if(isset($_POST['add']))
    {
        $Crew_Set_ID = $_POST['Crew_Set_ID'];
        $Pilot1_ID = $_POST['Pilot1'];
        $Pilot2_ID = $_POST['Pilot2'];
        $Crew1_ID = $_POST['staff1'];
        $Crew2_ID = $_POST['staff2'];
        $Crew3_ID = $_POST['staff3'];
        $Crew4_ID = $_POST['staff4'];
        $Crew5_ID = $_POST['staff5'];
        $Crew6_ID = $_POST['staff6'];
        $Crew7_ID = $_POST['staff7'];
        $Crew8_ID = $_POST['staff8'];

        $select6 = "SELECT * FROM `crew set` WHERE Crew_Set_ID = '$Crew_Set_ID'";
        $result6 = mysqli_query($connection,$select6);
        $check = mysqli_num_rows($result6);
        if($check>0)
        {
            echo'<script>alert("This crew set has already exist.!");</script>';
            echo "<script>setTimeout(\"location.href = 'flight-manage.php';\",100);</script>";;
        } 
        else
        {
        //insert data to db
        $insert = "INSERT INTO `crew set`(Crew_Set_ID,Pilot1_ID,Pilot2_ID,Crew1_ID,Crew2_ID,Crew3_ID,Crew4_ID,Crew5_ID,Crew6_ID,Crew7_ID,Crew8_ID)
        VALUES ('$Crew_Set_ID','$Pilot1_ID','$Pilot2_ID','$Crew1_ID','$Crew2_ID','$Crew3_ID','$Crew4_ID','$Crew5_ID','$Crew6_ID','$Crew7_ID','$Crew8_ID')";
            if(mysqli_query($connection,$insert)) 
            {
                echo'<script>alert("Crew set added successfully.!");</script>';
                echo "<script>setTimeout(\"location.href = 'flight-manage.php';\",100);</script>";;
            }
            else
            {
                echo'<script>alert("ERROR: could not able to add crew set.!");</script>';
            }
        }
        //close connection 
        mysqli_close($connection);
    }

    if(isset($_POST['submit']))
    {
        $FlightID = $_POST['FlightID'];
        $SourceID = $_POST['SourceID'];
        $DestinationID = $_POST['DestinationID'];
        $Arrival = $_POST['Arrival'];
        $Departure = $_POST['Departure'];
        $Status = $_POST['Status'];
        $hours = date_create($Departure)->diff(date_create($Arrival));
        $Duration = $hours->h + ($hours->days * 24); 
        $Crew_Set_ID = $_POST['Crew_Set_ID2'];
        $AirplaneCode = $_POST['AirplaneCode'];
        $Gate = $_POST['Gate'];

        $select7 = "SELECT * FROM `flight` WHERE FlightID = '$FlightID'";
        $result7 = mysqli_query($connection,$select7);
        $check2 = mysqli_num_rows($result7);
        if($check2>0)
        {
            echo'<script>alert("This FlightID  has already exist.!");</script>';
            echo "<script>setTimeout(\"location.href = 'flight-manage.php';\",100);</script>";;
        } 
        else
        {
        //insert data to db
        $insert2 = "INSERT INTO `flight`(FlightID,SourceID,DestinationID,Arrival,Departure,Status,Duration,Crew_Set_ID,AirplaneCode,Gate)
        VALUES ('$FlightID','$SourceID','$DestinationID','$Arrival','$Departure','$Status','$Duration','$Crew_Set_ID','$AirplaneCode','$Gate')";
        if(mysqli_query($connection,$insert2)) 
        {
            echo'<script>alert("Flight added successfully.!");</script>';
            echo "<script>setTimeout(\"location.href = 'flight-manage.php';\",100);</script>";;
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