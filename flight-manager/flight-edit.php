<?php
 include("db-connect.php");
    $id=$_GET["id"];
    $sql = "SELECT * FROM `flight` WHERE `FlightID` LIKE '%$id%'";
    $result1=mysqli_query($connection,$sql);
    $row =mysqli_fetch_assoc($result1);
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
    <link rel="stylesheet" type="text/css" href="style-form.css">
    <title>Flight Management</title>
</head>
<body>
    <div class="container my-5">
    <h2 class="text-center header">Flight Status Form</h2> 
    <form action="Status-update.php" method="post">
        <div class="form-group">
            <label for="">FlightID</label>
            <input type="text" name="FlightID" id="" class="form-control" value="<?php echo $row["FlightID"];?>" readonly>
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <select name="Status" class="form-control form-select" value="<?php echo $row["Status"];?>>
                <option value="">Please select status</option>
                <option value="CMS">CMS</option>
                <option value="Dalayed">Dalayed</option>
                <option value="Scheduled">Scheduled</option>
            </select>
        </div>
        <div class="from-group d-grid gap-2 col-6 mx-auto">
        <button type="submit" name="Update" class="btn btn-primary my-3 center ">Update</button>
        </div>
    </form>
            </div>
</body>
</html>