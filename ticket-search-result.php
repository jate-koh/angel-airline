<?php
    include("database-connect.php");
    $sql = "SELECT * FROM airport";
    $choice = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://kit.fontawesome.com/79e310ad42.js" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous">
</script>
<html>
    <head>
        <title>Ticket Search</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\form.css">
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