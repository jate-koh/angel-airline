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
        <title>Booking</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\form.css">
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
        <form action="booking-search-result.php" method="get">
            <div class="div-2">
                <fieldset class="field0">
                    <a href="booking.html"><span>Round-Trip</span></a> 
                    <a href="booking-oneway.html"><span>One-Way</span></a> <br>
                    <fieldset class="field1">
                        <legend class="legend1">From</legend>
                        <select class="input2" name="source" value= "
                            <?php
                                if(isset($_GET['source'])) {
                                    echo $_GET['source'];
                                }
                            ?> 
                        ">
                            <?php while($row = mysqli_fetch_array($choice) ) { ?>
                                <option value="<?php echo $row['Airport_ID']; ?>"> <?php echo $row['Airport_Name']; ?>, <?php echo $row['Country']; ?></option>
                            <?php } mysqli_data_seek($choice, 0); ?>
                        </select>
                    </fieldset>
                    <fieldset class="field1">
                        <legend class="legend1">To</legend>
                        <select class="input2" name="target" value= "
                            <?php
                                if(isset($_GET['target'])) {
                                    echo $_GET['target'];
                                }
                            ?> 
                        ">
                            <?php while($row = mysqli_fetch_array($choice) ) { ?>
                                <option value="<?php echo $row['Airport_ID']; ?>"> <?php echo $row['Airport_Name']; ?>, <?php echo $row['Country']; ?></option>
                            <?php } mysqli_data_seek($choice, 0); ?>
                        </select>
                    </fieldset> <br>
                    <fieldset class="field2">
                        <legend class="legend1">Depature Date</legend>
                        <input class="input1" type="date" name="depart" value= "
                            <?php
                                if(isset($_GET['depart'])) {
                                    echo $_GET['depart'];
                                }
                            ?> 
                        ">
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Return Date</legend>
                        <input class="input1" type="date" name="return" value= "
                            <?php
                                if(isset($_GET['return'])) {
                                    echo $_GET['return'];
                                }
                            ?> 
                        ">
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Seat Class</legend>
                        <select class="input2" name="class" value= "
                            <?php
                                if(isset($_GET['class'])) {
                                    echo $_GET['class'];
                                }
                            ?> 
                        ">
                            <option value="economy">Economy Class</option>
                            <option value="business">Business Class</option>
                            <option value="first class">First Classs</option>
                        </select>
                    </fieldset> <br>
                    <input class="button1" type="submit"/>
                </fieldset>
            </div>
        </form>
    </body>
</html>