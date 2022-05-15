<?php
 include("database-connect.php");
 include("back.inspection.insert.php");
    #-----------For Dropdown option---------------
    $select = "SELECT * FROM `plane part stocks`";
    $result = mysqli_query($conn,$select);
    $select2 = "SELECT * FROM `status code`";
    $result2 = mysqli_query($conn,$select2);
    $select3 = "SELECT * FROM `service form`";
    $result3 = mysqli_query($conn,$select3);
    $select4 = "SELECT * FROM `human resources` WHERE `StaffID` LIKE 'EGN%';";
    $result4 = mysqli_query($conn,$select4);
    $select5 = "SELECT * FROM `airplane info`";
    $result5 = mysqli_query($conn,$select5);
    #----------------------------------------------
?> 
<!DOCTYPE html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
    <link rel="stylesheet" type="text/css" href="styles\back\back.menubar.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <title>Inspection Form</title>
    <!--CSS-->
    <!-- <link rel="stylesheet" href="style-Inspection_Form.css"> -->
    <link rel="stylesheet" type="text/css" href="styles/back/back.form2.css">
    <script> 
        $(function(){
            $("#menu").load("back.menu.php"); 
         });
    </script> 
</head>

<body class="active">
    
    <div id="menu"></div>

    <body>
    <div class="container my-5" style="margin-top: 2%; padding: 1%;">
    <h2 class="text-center header">SERVICE FORM</h2> 
    <form action="back.inspection.insert.php" method="post">
        <div class="form-group">
            <label for="ServiceID">Service_FormID</label>
                <input type="text" name="ServiceID" class="form-control" value="<?php echo $SFid;?>" readonly> 
        </div>
        <div class="form-group">
            <label for="Part1">Part#1</label>
                <select name="Part1" class="form-control form-select">
                    <option value="none" >Please select PlanePart</option>
                    <?php foreach ($result as $key => $value) { ?>
                    <option value="<?=$value['Part_ID'];?>"><?=$value['Part_ID'];?></option>
                } 
                <?php } ?>
                </select>
        </div>
        <div class="form-group">
            <label for="Part2">Part#2</label>
                <select name="Part2" class="form-control form-select">
                    <option value="none">Please select PlanePart</option>
                    <?php foreach ($result as $key => $value) { ?>
                    <option value="<?=$value['Part_ID'];?>"><?=$value['Part_ID'];?></option>
                } 
                <?php } ?>
                </select>
        </div>
        <div class="form-group">
            <label for="Part3">Part#3</label>
                <select name="Part3" class="form-control form-select">
                    <option value="none">Please select PlanePart</option>
                    <?php foreach ($result as $key => $value) { ?>
                    <option value="<?=$value['Part_ID'];?>"><?=$value['Part_ID'];?></option>
                } 
                <?php } ?>
                </select>
        </div>
        <div class="form-group">
            <label for="Part4">Part#4</label>
                <select name="Part4" class="form-control form-select">
                    <option value="none">Please select PlanePart</option>
                    <?php foreach ($result as $key => $value) { ?>
                    <option value="<?=$value['Part_ID'];?>"><?=$value['Part_ID'];?></option>
                } 
                <?php } ?>
                </select>
        </div>
        <div class="form-group">
            <label for="Part5">Part#5</label>
                <select name="Part5" class="form-control form-select">
                    <option value="none">Please select PlanePart</option>
                    <?php foreach ($result as $key => $value) { ?>
                    <option value="<?=$value['Part_ID'];?>"><?=$value['Part_ID'];?></option>
                } 
                <?php } ?>
                </select>
        </div>
        <div class="from-group d-grid gap-2 col-6 mx-auto">
        <button type="submit" name="send" class="btn btn-primary my-3 center ">Send Request</button>
        </div>
            </form>
            </div>

    <!-- inspection form -->

    <div class="container my-5" style="margin-top: 2%; padding: 1%;">
    <h2 class="text-center header">INSPECTION FORM</h2> 
    <form action="back.inspection.insert.php" method="post">
         <div class="form-group">
            <label for="InspectionID">Inspection_FormID</label>
                <input type="text" name="InspectionID" class="form-control" value="<?php echo $IPid;?>" readonly> 
        </div>
        <div class="form-group">
            <label for="InspectionDate">InspectionDate</label>
                <input type="datetime-local" name="InspectionDate" class="form-control"> 
        </div>
        <div class="form-group">
            <label for="Engineer_ID">EngineerID</label>
                <select name="Engineer_ID" class="form-control form-select">
                    <option>Please select engineer</option>
                    <?php foreach ($result4 as $key => $value) { ?>
                    <option value="<?=$value['StaffID'];?>"><?=$value['StaffID'];?></option>
                <?php } ?>
                </select>
        </div>
        <div class="form-group">
            <label for="InspectionType">InspectionType</label>
                <select name="InspectionType" class="form-control form-select">
                    <option>Please select type</option>
                    <option>A-Check</option>
                    <option>B-Check</option>
                    <option>C-Check</option>
                    <option>D-Check</option>
                </select>
        </div>
        <div class="form-group">
            <label for="Airplane">AirplaneID</label>
                <select name="AirplaneID" class="form-control form-select">
                    <option>Please select airplane</option>
                    <?php foreach ($result5 as $key => $value) { ?>
                    <option value="<?=$value['AirplaneCode'];?>"><?=$value['AirplaneCode'];?></option>
                } 
                <?php } ?>
                </select>
        </div> 
         <div class="form-group">
            <label for="AirplaneStatus">Status</label>
                <select name="AirplaneStatus" class="form-control form-select">
                    <option>Please select status</option>
                    <?php foreach ($result2 as $key => $value) { ?>
                    <option value="<?=$value['Status_Code'];?>"><?=$value['Status_Code'];?></option>
                } 
                <?php } ?>
                </select>
        </div>
        <div class="form-group">
            <label for="Comment">Comment</label>
                <textarea type="text" name="Comment" class="form-control" cols="30" rows="10"></textarea> 
        </div>
        <div class="form-group">
            <label for="ServiceID2">Service_FormID</label>
                <select name="ServiceID2" class="form-control form-select">
                    <option value="none">Please select Form</option>
                    <?php foreach ($result3 as $key => $value) { ?>
                    <option value="<?=$value['Service_FormID'];?>"><?=$value['Service_FormID'];?></option>
                } 
                <?php } ?>
                </select>
        </div>
        <div class="from-group d-grid gap-2 col-6 mx-auto">
        <button type="submit" name="submit" class="btn btn-primary my-3 center ">Submit</button>
        </div>
    </form>
            </div>
</body>
</html>