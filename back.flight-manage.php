<?php
 include("database-connect.php");
    #-----------For Dropdown option---------------
    $select = "SELECT * FROM `airport`";
    $result = mysqli_query($conn,$select);
    $select2 = "SELECT * FROM `airplane info`";
    $result2 = mysqli_query($conn,$select2);
    $select3 = "SELECT * FROM `human resources` WHERE `StaffID` LIKE 'FCF%';";
    $result3 = mysqli_query($conn,$select3);
    $select4 = "SELECT * FROM `human resources` WHERE `StaffID` LIKE 'FCP%';";
    $result4 = mysqli_query($conn,$select4);
    $select5 = "SELECT * FROM `crew set`";
    $result5 = mysqli_query($conn,$select5);
    #----------------------------------------------
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
    <link rel="stylesheet" type="text/css" href="./styles/back/back.form2.css">
    <title>Flight Management</title>
</head>
<body>
    <div class="container my-5">
    <a href="back.flight-data.php" class="btn btn-secondary" style="margin-top: 2%;">Back To Editing</a>
    <a href="back.staff-reg.php" class="btn btn-secondary" style="margin-top: 2%;">Return To Main Menu</a>
    <h2 class="text-center header">Flight Attendant Form</h2> 
    <form action="back.flight-insert.php" method="post">
        <div class="form-group">
            <label for="">CrewSetID</label>
            <input type="text" name="Crew_Set_ID" id="" class="form-control" placeholder="Axxx">
        </div>
            <div class="row g-2">
                <label for="CrewMemberHead">Crew Member</label>
                  <div class="col-md">
                    <div class="form-floating">
                    <select name="Pilot1" class="form-control form-select">
                    <option>Please select pilot</option>
                    <?php foreach ($result4 as $key => $value) { ?>
                    <option value="<?=$value['StaffID'];?>"><?=$value['StaffID'];?></option>
                } 
                <?php } ?>
            </select>
                    <label for="floatingInputGrid">Pilot1:</label>
                    </div>
                  </div>
                <div class="col-md">
                <div class="form-floating">
                 <select name="Pilot2" class="form-control form-select">
                    <option>Please select pilot</option>
                    <?php foreach ($result4 as $key => $value) { ?>
                    <option value="<?=$value['StaffID'];?>"><?=$value['StaffID'];?></option>
                } 
                <?php } ?>
                </select>
                <label for="floatingSelectGrid">Pilot2:</label>
                </div>
                </div>
            </div>
            <div class="row g-2">
                  <div class="col-md">
                    <div class="form-floating mt-2">
                    <select name="staff1" class="form-control form-select">
                    <option>Please select staff</option>
                    <?php foreach ($result3 as $key => $value) { ?>
                    <option value="<?=$value['StaffID'];?>"><?=$value['StaffID'];?></option>
                } 
                <?php } ?>
            </select>
                    <label for="floatingInputGrid">staff1:</label>
                    </div>
                  </div>
                <div class="col-md">
                <div class="form-floating mt-2">
                 <select name="staff2" class="form-control form-select">
                    <option>Please select staff</option>
                    <?php foreach ($result3 as $key => $value) { ?>
                    <option value="<?=$value['StaffID'];?>"><?=$value['StaffID'];?></option>
                } 
                <?php } ?>
                </select>
                <label for="floatingSelectGrid">staff2:</label>
                </div>
                </div>
            </div>
            <div class="row g-2">
                  <div class="col-md">
                    <div class="form-floating mt-2">
                    <select name="staff3" class="form-control form-select">
                    <option>Please select staff</option>
                    <?php foreach ($result3 as $key => $value) { ?>
                    <option value="<?=$value['StaffID'];?>"><?=$value['StaffID'];?></option>
                } 
                <?php } ?>
            </select>
                    <label for="floatingInputGrid">staff3:</label>
                    </div>
                  </div>
                <div class="col-md">
                <div class="form-floating mt-2">
                 <select name="staff4" class="form-control form-select">
                    <option>Please select staff</option>
                    <?php foreach ($result3 as $key => $value) { ?>
                    <option value="<?=$value['StaffID'];?>"><?=$value['StaffID'];?></option>
                } 
                <?php } ?>
                </select>
                <label for="floatingSelectGrid">staff4:</label>
                </div>
                </div>
            </div>
            <div class="row g-2">
                  <div class="col-md">
                    <div class="form-floating mt-2">
                    <select name="staff5" class="form-control form-select">
                    <option>Please select staff</option>
                    <?php foreach ($result3 as $key => $value) { ?>
                    <option value="<?=$value['StaffID'];?>"><?=$value['StaffID'];?></option>
                } 
                <?php } ?>
            </select>
                    <label for="floatingInputGrid">staff5:</label>
                    </div>
                  </div>
                <div class="col-md">
                <div class="form-floating mt-2">
                 <select name="staff6" class="form-control form-select">
                    <option>Please select staff</option>
                    <?php foreach ($result3 as $key => $value) { ?>
                    <option value="<?=$value['StaffID'];?>"><?=$value['StaffID'];?></option>
                } 
                <?php } ?>
                </select>
                <label for="floatingSelectGrid">staff6:</label>
                </div>
                </div>
            </div>
             <div class="row g-2">
                  <div class="col-md">
                    <div class="form-floating mt-2">
                    <select name="staff7" class="form-control form-select">
                    <option>Please select staff</option>
                    <?php foreach ($result3 as $key => $value) { ?>
                    <option value="<?=$value['StaffID'];?>"><?=$value['StaffID'];?></option>
                } 
                <?php } ?>
            </select>
                    <label for="floatingInputGrid">staff7:</label>
                    </div>
                  </div>
                <div class="col-md">
                <div class="form-floating mt-2">
                 <select name="staff8" class="form-control form-select">
                    <option>Please select staff</option>
                    <?php foreach ($result3 as $key => $value) { ?>
                    <option value="<?=$value['StaffID'];?>"><?=$value['StaffID'];?></option>
                } 
                <?php } ?>
                </select>
                <label for="floatingSelectGrid">staff8:</label>
                </div>
                </div>
            </div>
        <div class="from-group d-grid gap-2 col-6 mx-auto">
        <button type="submit" name="add" class="btn btn-primary my-3 center ">Add Crew Set</button>
        </div>
    </form>
            </div>
            
            <!------------------------- form2 ------------------------------->
         <div class="container my-5">
    <h2 class="text-center header">Flight Management Form</h2> 
    <form action="back.flight-insert.php" method="post">
        <div class="form-group">
            <label for="">FlightID</label>
            <input type="text" name="FlightID" id="" class="form-control" placeholder="AGxxxx">
        </div>
        <div class="form-group">
            <label for="">SourceID</label>
            <select name="SourceID" class="form-control form-select">
                <option>Please select SourceID</option>
                <?php foreach ($result as $key => $value) { ?>
                    <option value="<?=$value['Airport_ID'];?>"><?=$value['Airport_ID'];?>, <?=$value['Airport_Name'];?>, <?=$value['Country'];?></option>
                } 
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">DestinationID</label>
            <select name="DestinationID" class="form-control form-select">
                <option>Please select DestinationID</option>
                <?php foreach ($result as $key => $value) { ?>
                    <option value="<?=$value['Airport_ID'];?>"><?=$value['Airport_ID'];?>, <?=$value['Airport_Name'];?>, <?=$value['Country'];?></option>
                } 
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Arrival</label>
            <input type="datetime-local" name="Arrival" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Departure</label>
            <input type="datetime-local" name="Departure" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <select name="Status" class="form-control form-select">
                <option value="">Please select status</option>
                <option value="CMS">CMS</option>
                <option value="Dalayed">Dalayed</option>
                <option value="Scheduled">Scheduled</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">CrewSetID</label>
            <select name="Crew_Set_ID2" class="form-control form-select">
                <option>Please select crew set</option>
                <?php foreach ($result5 as $key => $value) { ?>
                    <option value="<?=$value['Crew_Set_ID'];?>"><?=$value['Crew_Set_ID'];?></option>
                } 
                <?php } ?>
            </select>
        </div>
         <div class="form-group">
            <label for="">AirplaneCode</label>
             <select name="AirplaneCode" class="form-control form-select">
                <option>Please select AirplaneCode</option>
                <?php foreach ($result2 as $key => $value) { ?>
                    <option value="<?=$value['AirplaneCode'];?>"><?=$value['AirplaneCode'];?></option>
                } 
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Gate</label>
            <input type="text" name="Gate" id="" class="form-control" placeholder="Axx">
        </div>
        <div class="from-group d-grid gap-2 col-6 mx-auto">
        <button type="submit" name="submit" class="btn btn-primary my-3 center ">submit</button>
        </div>
    </form>
            </div>
</body>
</html>