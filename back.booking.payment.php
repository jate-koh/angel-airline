<?php
    include("database-connect.php");
    include("./func/booking.func.php");
    if(isset($_POST['passportno'])) {
        $passportno = $_POST['passportno'];
        if(!passportExist($conn,$passportno)) {
            $insert = 
            "INSERT INTO `passenger` (`PassportNo`, `FirstName`, `SurName`, 
            `DoB`, `Sex`, `Phone`, `Address`, `Email`, `Nationality`, 
            `PassportExp`) 
            VALUES (?,?,?,?,?,?,?,?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$insert);
            mysqli_stmt_bind_param($stmt,"ssssssssss",
            $passportno,$_POST['firstname'],$_POST['lastname'],$_POST['date'],
            $_POST['sex'],$_POST['phone'],$_POST['address'],$_POST['email'],
            $_POST['nationality'],$_POST['passportexp']);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);
            echo "<script> alert('Sucessfully inserted new passport'); </script>";
        }
        else {
            echo "<script> alert('Found existing passport in database'); </script>";
        }
        $query =
        "SELECT * FROM passenger WHERE PassportNo like '%{$passportno}%' ;";
        $result = mysqli_query($conn,$query);
    }
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
        <title>Booking</title>
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
        <?php if(isset($_POST['passportno'])) { ?>
        <form action="./back.booking.payment.php" method="POST">
            <div class="div-2" style=" margin-top: 0.1px;">
            <?php $row = mysqli_fetch_array($result); ?>
                <fieldset class="field0">
                    <fieldset class="field1">
                        <legend class="legend1">Ticket ID</legend>
                        <input class="input1" type=text name="ticket_id" <?php echo "value=' ".$_POST['ticket_id']." ' "?> readonly>
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Flight ID</legend>
                        <input class="input1" type=text name="flight_id" <?php echo "value=' ".$_POST['flight_id']." ' "?> readonly>
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Source</legend>
                        <input class="input1" type=text name="source" <?php echo "value=' ".$_POST['source']." ' "?> readonly>
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Time of Departure</legend>
                        <input class="input1" type=text name="depart" <?php echo "value=' ".$_POST['depart']." ' "?> readonly>
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Destination</legend>
                        <input class="input1" type=text name="destination" <?php echo "value=' ".$_POST['destination']." ' "?> readonly>
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Est. Time of Arrival</legend>
                        <input class="input1" type=text name="arrive" <?php echo "value=' ".$_POST['arrive']." ' "?> readonly>
                    </fieldset>
                    <fieldset class="field3">
                        <legend class="legend1">Gate</legend>
                        <input class="input1" type=text name="gate" <?php echo "value=' ".$_POST['gate']." ' "?> readonly>
                    </fieldset>
                    <fieldset class="field3">
                        <legend class="legend1">Seat</legend>
                        <input class="input1" type=text name="seat" <?php echo "value=' ".$_POST['seat']." ' "?> readonly>
                    </fieldset>
                </fieldset>
            </div>
            <div class="div-2" style=" margin-top: 0.1px; padding-top: 1px;">
                <fieldset class="field0">
                    <fieldset class="field0" style=" padding-top: 1px;">
                        <legend class="legend1">Passport Info</legend>
                        <fieldset class="field1">
                            <legend class="legend1">Passport Number</legend>
                            <input class="input1" type="text" id="passportno" name="passportno" <?php echo "value=' ".$row['PassportNo']." ' "?> readonly>
                        </fieldset> <br>
                        <fieldset class="field1">
                            <legend class="legend1">Passport Expiry Date</legend>
                            <input class="input1" type="text" id="passportexp" name="passportexp" <?php echo "value=' ".$row['PassportExp']." ' "?> readonly>
                        </fieldset> <br>
                        <fieldset class="field2">
                            <legend class="legend1">Nationality</legend>
                            <input class="input1" type="text" name="nationality" id="nationality" <?php echo "value=' ".$row['Nationality']." ' "?> readonly>
                        </fieldset> <br>
                        <fieldset class="field1">
                            <legend class="legend1">First Name</legend>
                            <input class="input1" type="text" id="firstname" name="firstname" <?php echo "value=' ".$row['FirstName']." ' "?> readonly>
                        </fieldset> <br>
                        <fieldset class="field1">
                            <legend class="legend1">Last name</legend>
                            <input class="input1" type="text" id="lastname" name="lastname" <?php echo "value=' ".$row['SurName']." ' "?> readonly>
                        </fieldset> <br>
                    </fieldset> <br>
                <fieldset class="btnbox"> 
                    <input class="button1" type="submit" name="submit" value="Proceed"/>
                </fieldset>
            </div>
        </form>
        <?php }
            else {
                echo " <div class='div-2'> You're not supposed to be here. (Go book some ticket!) </div>";
            }
        ?>
    </body>
</html>
