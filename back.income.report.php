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
                $sql = "SELECT f.FlightID,a.Airport_Name AS SourceAirport,a.Country AS SourceCountry,ab.Airport_Name AS DestinationAirport,
                ab.Country AS DestinationCountry, SUM(b.Ticket_Price) AS TotalSale
                FROM `booking detail` b
                LEFT JOIN `flight` f 
                on b.Flight_ID = f.FlightID
                LEFT JOIN `airport` a
                on f.SourceID = a.Airport_ID
                LEFT JOIN `airport` ab
                on f.DestinationID = ab.Airport_ID
                WHERE b.PassportNo IS NOT NULL AND b.Receipt_ID IS NOT NULL
                GROUP BY f.FlightID;";
                $result = mysqli_query($conn,$sql);
            ?>
            <fieldset class="field0">
                <table id="flight_data" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th width="10%">Flight ID</th>
                                <th width="10%">Source</th>
                                <th width="10%">Destination</th>
                                <th width="10%">Total Ticket Sale</th>
                            </tr>
                        </thead>
                            <tbody> 
                            <?php 
                                if($result -> num_rows > 0) {
                                    while($row = $result -> fetch_assoc()) { 
                            ?>
                            <tr>
                                <td><?php echo $row['FlightID']; ?></td>
                                <td><?php echo "".$row['SourceAirport'].", ".$row['SourceCountry'].""; ?></td>
                                <td><?php echo "".$row['DestinationAirport'].", ".$row['DestinationCountry'].""; ?></td>
                                <td><?php echo $row['TotalSale']; ?></td>
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