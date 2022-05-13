<?php
    include("database-connect.php");
    $sql = "SELECT b.PassportNo,b.Receipt_ID,b.Flight_ID,b.TicketID,s.Airport_ID AS SourceID, s.Airport_Name AS SourceName, s.Country AS SourceCountry, f.Departure,
    d.Airport_ID AS DestinationID, d.Airport_Name AS DestinationName, d.Country AS DestinationCountry, f.Arrival, b.Ticket_Price, f.Gate
    FROM `booking detail` b
    LEFT JOIN flight f
        ON f.FlightID = b.Flight_ID
    LEFT JOIN airport s
        ON f.SourceID = s.Airport_ID
    LEFT JOIN airport d
        ON f.DestinationID = d.Airport_ID
    WHERE PassportNo IS NULL;";
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://kit.fontawesome.com/79e310ad42.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" crossorigin="anonymous" ></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<html>
    <head>
        <title>Booking</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\form.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" href="styles\bg2.css"> <!-- Apply Bg Image -->
    </head>
    <script> 
        $(function(){
            $("#menu").load("menu.html"); 
        });
    </script> 
    <body class="active">

        <div id="menu"></div>
        
        <div class="div-2">
            <div class="form-group">
                <label>Search</label>
                    <input type="text" name="search" id="search" class="form-control input-sm"/>
            </div> <hr>
            <div id="static">
                <form action="back.booking.passport.php" method="POST">
                    <table id="flight_data" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th width="20%">Source</th>
                                <th width="10%">Departure</th>
                                <th width="20%">Destination</th>
                                <th width="10%">Arrival Time Est.</th>
                                <th width="10%">Ticket Price</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                            <tbody> 
                            <?php 
                                if($result -> num_rows > 0) {
                                    while($row = $result -> fetch_assoc()) { 
                            ?>
                            
                                <tr>
                                    <td><?php echo $row['SourceName']; ?></td>
                                    <td><?php echo $row['Departure']; ?></td>
                                    <td><?php echo $row['DestinationName']; ?></td>
                                    <td><?php echo $row['Arrival']; ?></td>
                                    <td><?php echo $row['Ticket_Price']; ?></td>
                                    <td><?php echo '<button type="submit" name="ticket_id" value="'.$row["TicketID"].'" class="btn btn-warning btn-xs update">Book</button>' ?></td>
                                </tr>
                            <?php   } 
                                }
                                mysqli_data_seek($result, 0);
                            ?>
                            </tbody>
                    </table>
                </form> 
            </div>
            <div id="result">
                <form action="back.booking.passport.php" method="POST">
                </form> 
            </div>
        </div>
        
    </body>
</html>
    
<script type="text/javascript" language="javascript">
   $(document).ready(function() {
        $("#result").css("display","none");
        $("#search").on('keyup change', function() {
            var search = $("#search").val();
            var bool = Boolean(search != "" );
            if(bool) {
                $("#static").css("display","none");
                $("#result").css("display","");
                $.ajax({
                    url:"./func/booking.fetch.php",
                    method: "POST",
                    data: {
                        search: search
                    },
                    success: function(data) {
                        $("#result").html(data);
                    }
                });
            }
            else {
                $("#static").css("display","");
                $("#result").css("display","none");
            }
        });
    });

</script>

