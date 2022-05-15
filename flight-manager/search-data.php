<?php
include("db-connect.php");

$ID = $_POST["FlightID"];
$sql = "SELECT * FROM `flight` WHERE `FlightID` LIKE '%$ID%'";
$result=mysqli_query($connection,$sql);
$count=mysqli_num_rows($result);
$order=1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style-data.css">
    <title>Flight Information</title>
</head>
<body>
    <div class="container my-5">
        <div class="container header">
        <h2 class="text-center header">Flight Information</h2>
        </div>
         <?php if($count>0){?>
        <form action="search-data.php" method="post"> 
        <label for="">Search Flight</label>
        <input type="text" placeholder="AGxxxx" name="FlightID" class="form-control">
        <input type="submit" value="Search" class="btn btn-info my-2">
        <a href="flight-data.php" class="btn btn-secondary">Home</a>
        <table class="table table-bordered ">
            <thead class="table-primary">
                <tr>
                    <th>FlightID</th>
                    <th>SourceID</th>
                    <th>DestinationID</th>
                    <th>Arrival</th>
                    <th>Departure</th>
                    <th>Status</th>
                    <th>Duration</th>
                    <th>Crew_Set_ID</th>
                    <th>AirplaneCode</th>
                    <th>Gate</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>    
            </thead>
                <tbody>
                    <?php while($row=mysqli_fetch_assoc($result)){?>
                    <tr class="table-light">
                        <th><?php echo $row['FlightID'];?></th>
                        <th><?php echo $row['SourceID'];?></th>
                        <th><?php echo $row['DestinationID'];?></th>
                        <th><?php echo $row['Arrival'];?></th>
                        <th><?php echo $row['Departure'];?></th>
                        <th><?php echo $row['Status'];?></th>
                        <th><?php echo $row['Duration'];?></th>
                        <th><?php echo $row['Crew_Set_ID'];?></th>
                        <th><?php echo $row['AirplaneCode'];?></th>
                        <th><?php echo $row['Gate'];?></th>
                        <th><a href="flight-edit.php?id=<?php echo $row["FlightID"]?>" class="btn btn-primary"> EDIT </a></th>
                        <th><a href="flight-delete.php?fid=<?php echo $row["FlightID"]?>" class="btn btn-danger"
                        onclick="return confirm('Confirm delete??')"> DELETE </a></th>
                    </tr>
                    <?php } ?>
                </tbody>
        </table>
        <?php } else {?>
        <div>
        <?php echo'<script>alert("Flight not found!");</script>';
        echo "<script>setTimeout(\"location.href = 'flight-data.php';\",100);</script>";; ?>
    </div>
    <?php } ?>
    </div>
</body>
</body>
</html>