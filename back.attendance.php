<?php
    session_start();
    include("database-connect.php");
    $sql = "SELECT * from `human resources`;";
    $choice = mysqli_query($conn,$sql);
    
    if(isset($_GET["fail"])) {
        if($_GET["fail"] == "in") {
            echo "<script> alert('You're still Clock In, Clock Out first!'); </script>";
        }
    }

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
        <title>Attendance Check</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\back\back.menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\back\back.form.css">
    </head>
    <script> 
            $(function(){
                $("#menu").load("back.menu.php"); 
            });
        </script> 
    <body class="active">

    <div id="menu"></div>
        
        <!-- Content -->
        <form action="./func/attendance.func.php" method="POST">
            <div class="div-2">
                <?php 
                    date_default_timezone_set('Asia/Bangkok');
                ?>
                <fieldset class="field0">
                    <fieldset class="field1" style=" margin-left: 21%;">
                        <legend class="legend1">Current Date</legend>
                        <input class="input1" name="currentdate" <?php echo "value='".date('Y-m-d H:i:s')."'" ?> >
                    </fieldset> 
                    <fieldset class="btnbox">
                        <?php   
                            if(isset($_SESSION["useruid"])) {
                                echo '
                                <input class="button1" style=" margin-left: 20%;" type="submit" name="clockin" value="Clock In"/>
                                <input class="button1" style=" margin-left: 20%;" type="submit" name="clockout" value="Clock Out"/>
                                ';
                            }
                            else { 
                                echo "You're not supposed to be here (Staff Only!)";
                            }
                        ?>
                    </fieldset>
                </fieldset>
            </div>
        </form>
    </body>
</html>
