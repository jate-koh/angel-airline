<?php
    session_start();
    include("database-connect.php");
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://kit.fontawesome.com/79e310ad42.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" crossorigin="anonymous" ></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous">
</script>
<html>
    <head>
        <title>Income Report</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\back\back.menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\back\back.form.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    </head>
    <script> 
            $(function(){
                $("#menu").load("back.menu.php"); 
            });
        </script> 
    <body class="active">

    <div id="menu"></div>
        
        <!-- Content -->
        
        <div class="div-2">
            <?php 
                $sql = "SELECT `Airplance_Code`As AirplaneCode, a.PlaneModel_No,`Engineer_ID`As EngineerID,h.FirstName As EngineerName,`Inspection_FormID`As InspectionFormID,`Inspection_Date`As InspectionDate,`Status`,
                SUM(p.Pricevalue) As MaintenanceCost
                FROM `inspection form`i
                LEFT JOIN `status code`sc
                ON i.Status_Code = sc.Status_Code
                LEFT JOIN `service form`sf
                ON i.Service_FormID = sf.Service_FormID
                LEFT JOIN `plane part stocks`p
                ON sf.Requested_Part_ID_1 = p.Part_ID OR sf.Requested_Part_ID_2 = p.Part_ID
                OR sf.Requested_Part_ID_3 = p.Part_ID OR sf.Requested_Part_ID_4 = p.Part_ID
                OR sf.Requested_Part_ID_5 = p.Part_ID
                LEFT JOIN `human resources`h
                ON i.Engineer_ID = h.StaffID
                LEFT JOIN `airplane info` a
                ON Airplance_Code = a.AirplaneCode
                GROUP BY i.inspection_formID;";
                $result = mysqli_query($conn,$sql);
            ?>
            <fieldset class="field0">
                <table id="flight_data" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th width="10%">Airplane Code</th>
                                <th width="10%">Plane Model Name</th>
                                <th width="10%">Inspector</th>
                                <th width="10%">Inspection Date</th>
                                <th width="10%">Status</th>
                                <th width="10%">Maintenance Cost</th>
                            </tr>
                        </thead>
                            <tbody> 
                            <?php 
                                if($result -> num_rows > 0) {
                                    while($row = $result -> fetch_assoc()) { 
                            ?>
                            <tr>
                                <td><?php echo $row['AirplaneCode']; ?></td>
                                <td><?php echo $row['PlaneModel_No']; ?></td>
                                <td><?php echo "".$row['EngineerName'].", ".$row['EngineerID'].""; ?></td>
                                <td><?php echo $row['InspectionDate']; ?></td>
                                <td><?php echo $row['Status']; ?></td>
                                <td><?php echo $row['MaintenanceCost']; ?></td>
                            </tr>
                        <?php   } 
                            }
                            mysqli_data_seek($result, 0);
                        ?>
                        </tbody>
                </table>
            </fieldset>
        </div>
    </body>
</html>