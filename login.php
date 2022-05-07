<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://kit.fontawesome.com/79e310ad42.js" crossorigin="anonymous"></script>
<html>
    <head>
        <title>Home</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\form.css">
        <link rel="stylesheet" href="styles\bg2-1.css"> <!-- Apply Bg Image -->
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
        <div class="div-1">
            <div>
                <h1>Log In</h1>
            </div> <br>
            <form action="login-process.php" method="POST">
                <div class="form_group field">
                    <input type="input" class="form__field" placeholder="Username" name="username" id='username' required />
                    <label for="name" class="form__label">Username</label> 
                </div> <br>
                <div class="form_group field">
                    <input type="password" class="form__field" placeholder="Password" name="password" id='password' required />
                    <label for="name" class="form__label">Password</label>
                </div> <br>
                <div>
                    <fieldset class="btnbox">
                        <input class="button1" type="submit" name="submit" value="Login"/>
                    </fieldset>
                </div>
            </form>
        </div>
    </body>
</html>