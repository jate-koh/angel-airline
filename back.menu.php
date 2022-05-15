<?php
    session_start();
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://kit.fontawesome.com/79e310ad42.js" crossorigin="anonymous"></script> 
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles\back\back.menubar.css">
    </head>
<html>
   <div> <!-- Wrapper -->
            <div class="wrapper">
                <!-- Side menu bar -->
                <div class="sidebar"> 
                    <ul>
                        <?php 
                         if(isset($_SESSION["useruid"])) {
                            echo '
                                <li><a href="./back.staff-reg.php">
                                    <span class="item">Staff Register</span>
                                </a></li>
                                <li><a href="#">
                                    <span class="item">Inspection Form</span>
                                </a></li>
                                <li><a href="./back.attendance.php">
                                    <span class="item">Clock in/Clock Out</span>
                                </a></li> ';
                         }
                        ?>
                    </ul> <hr>
                    <ul>
                        <?php
                        if(isset($_SESSION["useruid"])) {
                            echo
                                '<li><a href="./back.income.report.php">
                                    <span class="item">Flight Income Report</span>
                                </a></li>
                                <li><a href="./back.pilot.report.php">
                                    <span class="item">Pilot Report</span>
                                </a></li>';
                        }
                        ?>
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
                            <?php
                                if(isset($_SESSION["useruid"])) {
                                    echo "<li><a href='#'><span>Logged in as ".$_SESSION["useruid"]."...</span></a></li>";
                                    echo "<li><a href='./func/logout.func.php'><span>Logout</span></a></li>";
                                }
                            ?>
                            
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
    </div>
</html>