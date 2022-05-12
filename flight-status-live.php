<?php
    include("database-connect.php");
    $sql = "SELECT * FROM flight";
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://kit.fontawesome.com/79e310ad42.js" crossorigin="anonymous"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous">
</script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
<html>
    <head>
        <title>Flight Status</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\form.css">
        <link rel="stylesheet" type="text/css" href="styles\datepicker.css">
        <link rel="stylesheet" type="text/css" href="styles\table.css">
        <link rel="stylesheet" href="styles\bg2.css"> <!-- Apply Bg Image -->
        <script> 
            $(function(){
                $("#menu").load("menu.html"); 
            });
        </script> 
    </head>
    <body class="active">

        <div id="menu"></div>

        <!-- Content -->
        <div id="static" class="div-2">
            <fieldset class="field0">
                <table>
                    <tr>
                        <th>Flight ID</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Departure Date</th>
                        <th>Departure Time</th>
                        <th>Arrival Date</th>
                        <th>Arrival Time</th>
                        <th>Status</th>
                    </tr>
                    <?php
                        if($result -> num_rows > 0) {
                            while($row = $result -> fetch_assoc()) { 
                                $arrive = new DateTime($row['Arrival']);
                                $depart = new DateTime($row['Departure']);
                                $arrdate = $arrive -> format('Y-m-d');
                                $arrtime = $arrive -> format('H:i:s');
                                $depdate = $depart -> format('Y-m-d');
                                $deptime = $depart -> format('H:i:s');
                    ?> 
                            <tr>
                                <td><?php echo $row["FlightID"] ?></td>
                                <td><?php echo $row["SourceID"] ?></td>
                                <td><?php echo $row["DestinationID"] ?></td>
                                <td><?php echo $depdate ?></td>
                                <td><?php echo $deptime ?></td>
                                <td><?php echo $arrdate ?></td>
                                <td><?php echo $arrtime ?></td>
                                <td><?php echo $row["Status"] ?></td>
                            </tr>
                    <?php        
                            }
                        }
                        mysqli_data_seek($result, 0);
                    ?>
                </table>
            </fieldset>
        </div>
        
        <div id="searchresult" class="div-2"></div>
        
        <div class="div-2">
            <fieldset class="field0">
                <fieldset class="field1">
                    <legend class="legend1">Source</legend>
                    <input class="input1" type="text" id="source" placeholder="Where you will depart?">
                </fieldset>
                <fieldset class="field1">
                    <legend class="legend1">Destination</legend>
                    <input class="input1" type="text" id="destination" placeholder="Where are you going?">
                </fieldset> <br>
                <fieldset class="field1">
                    <legend class="legend1">Departure</legend>
                    <input class="input1" type="text" id="depart" placeholder="When do you wish to depart?">
                </fieldset> <br>
                <fieldset class="field1">
                    <legend class="legend1">Arrive</legend>
                    <input class="input1" type="text" id="arrive" placeholder="When do you wish to reach your destination?">
                </fieldset>
            </fieldset>
        </div>
        
        <!-- Ajax -->
        <script type="text/javascript">
        $(document).ready(function() {
            $("#searchresult").css("display","none");
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
            });
            $(function() {
                $("#arrive").datepicker();
                $("#depart").datepicker();
            });
            $('#source,#destination,#arrive,#depart').on('keyup change', function() {
                var source = $("#source").val();
                var destination = $("#destination").val();
                var date_arr = $("#arrive").val();
                var date_dep = $("#depart").val();
                var bool = Boolean(
                    destination != "" || source != "" || date_arr != "" || date_dep != "" 
                    );
                if(bool) {
                    $("#static").css("display","none");
                    $("#searchresult").css("display","");
                    $.ajax({
                        url:"flight-status-live-result.php",
                        method:"POST",
                        data:{
                            destination:destination,
                            source:source,
                            date_arr:date_arr,
                            date_dep:date_dep,
                        },
                        success:function(data) {
                            $("#searchresult").html(data);
                        }
                    });
                }
                else {
                    $("#searchresult").css("display","none");
                    $("#static").css("display","");
                }
            });
        });
        </script>
    </body>
</html>

<!--
        <div class="div-2">
            <fieldset class="field0">
                <table>
                    <tr>
                        <th>Flight ID</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Arrival Date</th>
                        <th>Arrival Time</th>
                        <th>Departure Date</th>
                        <th>Departure Time</th>
                        <th>Status</th>
                    </tr>
                    <?php
                        if($result -> num_rows > 0) {
                            while($row = $result -> fetch_assoc()) { 
                                $arrive = new DateTime($row['Arrival']);
                                $depart = new DateTime($row['Departure']);
                                $arrdate = $arrive -> format('Y-m-d');
                                $arrtime = $arrive -> format('H:i:s');
                                $depdate = $depart -> format('Y-m-d');
                                $deptime = $depart -> format('H:i:s');
                    ?> 
                            <tr>
                                <td><?php echo $row["FlightID"] ?></td>
                                <td><?php echo $row["SourceID"] ?></td>
                                <td><?php echo $row["DestinationID"] ?></td>
                                <td><?php echo $arrdate ?></td>
                                <td><?php echo $arrtime ?></td>
                                <td><?php echo $depdate ?></td>
                                <td><?php echo $deptime ?></td>
                                <td><?php echo $row["Status"] ?></td>
                            </tr>
                    <?php        
                            }
                        }
                        mysqli_data_seek($result, 0);
                    ?>
                </table>
            </fieldset>
        </div>
-->