<?php
    include("database-connect.php");
    $sql = "SELECT * FROM airport";
    $choice = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://kit.fontawesome.com/79e310ad42.js" crossorigin="anonymous"></script>
<html>
    <head>
        <title>Ticket Search</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\form.css">
        <link rel="stylesheet" href="styles\bg2.css"> <!-- Apply Bg Image -->
    </head>
    <body class="active">
        <!-- Wrapper -->
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
        <form action="ticket-search-result.php" method="get">
            <div class="div-2">
                <fieldset class="field0">
                    <fieldset class="field2">
                        <legend class="legend1">Ticket ID</legend>
                        <input class="input1" type="text" name="ticket" placeholder="Enter your ticket ID" value= "
                            <?php
                                if(isset($_GET['ticket'])) {
                                    echo $_GET['ticket'];
                                }
                            ?> 
                        ">
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Passport No.</legend>
                        <input class="input1" type="text" name="passport" placeholder="Enter your Passport Number" value= "
                            <?php
                                if(isset($_GET['passport'])) {
                                    echo $_GET['passport'];
                                }
                            ?> 
                        ">
                    </fieldset>
                    <input class="button1" name="search" type="submit" id="search" value="Search" />
                </fieldset>
            </div>
        </form>
    </body>
</html>