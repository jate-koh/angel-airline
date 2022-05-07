<?php
    include("database-connect.php");
    $sql = "SELECT * FROM flight";
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://kit.fontawesome.com/79e310ad42.js" crossorigin="anonymous"></script>
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
                        <li><a href="flight-status.php">
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
                            <li><a href="flight-status.php"><span>Flight Status</span></a></li>
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
        <form action="flight-status-result.php" method="get">
        <div class="div-2">
            <fieldset class="field0">
                <fieldset class="field1">
                    <legend class="legend1">Source</legend>
                        <input class="input1" type="text" name="source" placeholder="Where you will depart"
                            value="
                            <?php
                                if(isset($_GET['source'])) {
                                    echo $_GET['source'];
                                }
                            ?> 
                        " >
                </fieldset>
                <fieldset class="field1">
                    <legend class="legend1">Destination</legend>
                    <input class="input1" type="text" name="destination" placeholder="Where you will arrive"
                        value= "
                            <?php
                                if(isset($_GET['destination'])) {
                                    echo $_GET['destination'];
                                }
                            ?> 
                        ">
                </fieldset> <br>
                <fieldset class="field2">
                    <legend class="legend1">Arrival Date</legend>
                        <input class="input1" type="date" name="arrive" 
                            value= "
                                <?php
                                    if(isset($_GET['arrive'])) {
                                        echo $_GET['arrive'];
                                    }
                                ?> 
                            ">
                </fieldset>
                <fieldset class="field1">
                        <legend class="legend1">Arrival Time</legend>
                        <input class="input1" type="time" name="arr-time"
                            value= "
                                <?php
                                    if(isset($_GET['arr-time'])) {
                                        echo $_GET['arr-time'];
                                    }
                                ?> 
                            ">
                </fieldset> <br>
                <fieldset class="field2">
                    <legend class="legend1">Departure Date</legend>
                    <input class="input1" type="date" name="depart" 
                        value= "
                            <?php
                                if(isset($_GET['depart'])) {
                                    echo $_GET['depart'];
                                }
                            ?> 
                        ">
                </fieldset>
                <fieldset class="field1">
                        <legend class="legend1">Departure Time</legend>
                        <input class="input1" type="time" name="dep-time"
                            value= "
                            <?php
                                if(isset($_GET['dep-time'])) {
                                    echo $_GET['dep-time'];
                                }
                            ?> 
                        ">
                </fieldset>
                <input class="button1" name="search" type="submit" id="search" value="Search" />
            </fieldset>
        </div>
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
    </body>
</html>