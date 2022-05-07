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
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
<html>
    <head>
        <title>Flight Status</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\form.css">
        <link rel="stylesheet" type="text/css" href="styles\table.css">
        <link rel="stylesheet" href="styles\bg2.css"> <!-- Apply Bg Image -->
    </head>
    <body class="active">
        <!-- Wrapper -->
        <div>
            <div class="wrapper">
                <!-- Side menu bar -->
                <div class="sidebar"> 
                    <ul>
                        <li><a href="index.html">
                            <span class="icon"><i class="fa-solid fa-house"></i></span>
                            <span class="item">Home</span>
                        </a></li>
                        <li><a href="ticket-search.php">
                            <span class="icon"><i class="fa-solid fa-book-bookmark"></i></span>
                            <span class="item">Search Ticket</span>
                        </a></li>
                        <li><a href="flight-status-live.php">
                            <span class="icon"><i class="fa-solid fa-plane"></i></span>
                            <span class="item">Flight Status</span>
                        </a></li>
                        <li><a href="booking.php">
                            <span class="icon"><i class="fa-solid fa-ticket"></i></span>
                            <span class="item">Book Ticket</span>
                        </a></li>
                        <li><a href="#">
                            <span class="icon"><i class="fa-solid fa-address-book"></i></span>
                            <span class="item">Contact Us</span>
                        </a></li>
                    </ul>
                </div>
                <!-- Top menu bar -->
                <div class="topbar">
                    <div class="content">
                        <div class="threebars">
                            <a href="#"><i class="fa-solid fa-bars"></i></a>
                        </div>
                        <div class="logo">
                            <!-- <img src="/img/logo/long-logo-pink.png"> -->
                        </div>
                    </div>
                </div>
                <div class="nav">
                    <div class="content">
                        <ul>
                            <li><a href="#"><span>Flights</span></a></li>
                            <li><a href="ticket-search.php"><span>Search Ticket</span></a></li>
                            <li><a href="flight-status-live.php"><span>Flight Status</span></a></li>
                            <li><a href="booking.php"><span>Book Ticket</span></a></li>
                            <li><a href="#"><span>Login/Sign Up</span></a></li>
                        </ul> 
                    </div>
                </div>
                <!-- Bottom bar  -->
                <div class="bottombar">
                    <h1>Designed by SR., Created by JK., 2022</h1>
                </div>
            </div>
        </div>
        <!-- Bar Script -->
        <script>
            var threebars = document.querySelector(".threebars");
            threebars.addEventListener("click", function() {
                document.querySelector("body").classList.toggle("active"); 
            })
        </script>

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