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
        <title>Pilot Report</title>
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
                $sql1 = "SELECT  c.Pilot1_ID, h.FirstName, h.Surname, SUM(f.Duration) AS TotalHour FROM `flight` f
                LEFT JOIN `crew set` c
                on f.Crew_Set_ID = c.Crew_Set_ID
                LEFT JOIN `human resources` h
                on c.Pilot1_ID = h.StaffID
                GROUP BY c.Pilot1_ID;";
                $result1 = mysqli_query($conn,$sql1);
            ?>
            <fieldset class="field0">
                <table id="flight_data" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="10%">Pilot's Lastname</th>
                                <th width="10%">Pilot's Name</th>
                                <th width="10%">Total Flight Hours</th>
                            </tr>
                        </thead>
                            <tbody> 
                            <?php 
                                if($result1 -> num_rows > 0) {
                                    while($row1 = $result1 -> fetch_assoc()) { 
                            ?>
                            <tr>
                                <td><?php echo $row1['Pilot1_ID']; ?></td>
                                <td><?php echo $row1['Surname'];; ?></td>
                                <td><?php echo $row1['FirstName'];; ?></td>
                                <td><?php echo $row1['TotalHour']; ?></td>
                            </tr>
                        <?php   } 
                            }
                            mysqli_data_seek($result1, 0);
                        ?>
                        </tbody>
                </table>
                <?php 
                    $sql2 = "SELECT  c.Pilot2_ID, h.FirstName, h.Surname, SUM(f.Duration) AS TotalHour FROM `flight` f
                    LEFT JOIN `crew set` c
                    on f.Crew_Set_ID = c.Crew_Set_ID
                    LEFT JOIN `human resources` h
                    on c.Pilot2_ID = h.StaffID
                    GROUP BY c.Pilot2_ID;";
                    $result2 = mysqli_query($conn,$sql2);
                ?>
                <table id="flight_data" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="10%">Pilot's Lastname</th>
                                <th width="10%">Pilot's Name</th>
                                <th width="10%">Total Flight Hours</th>
                            </tr>
                        </thead>
                            <tbody> 
                            <?php 
                                if($result2 -> num_rows > 0) {
                                    while($row2 = $result2 -> fetch_assoc()) { 
                            ?>
                            <tr>
                                <td><?php echo $row2['Pilot2_ID']; ?></td>
                                <td><?php echo $row2['Surname'];; ?></td>
                                <td><?php echo $row2['FirstName'];; ?></td>
                                <td><?php echo $row2['TotalHour']; ?></td>
                            </tr>
                        <?php   } 
                            }
                            mysqli_data_seek($result2, 0);
                        ?>
                        </tbody>
                </table> 
            </fieldset>
        </div>
    </body>
</html>