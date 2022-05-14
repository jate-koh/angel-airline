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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" crossorigin="anonymous" ></script>
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
        <form action="./func/booking.receipt.process.php" method="POST">
            <div class="div-2" style=" margin-top: 0.1px;">
            <?php $row = mysqli_fetch_array($result); ?>
                <fieldset class="field0">
                    <fieldset class="field1">
                        <legend class="legend1">Ticket ID</legend>
                        <input class="input1" type=text name="ticket_id" <?php echo "value='".trim($_POST['ticket_id']," ")."'"?> readonly>
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Flight ID</legend>
                        <input class="input1" type=text name="flight_id" <?php echo "value='".trim($_POST['flight_id']," ")."'"?> readonly>
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Source</legend>
                        <input class="input1" type=text name="source" <?php echo "value='".trim($_POST['source']," ")."'"?> readonly>
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Time of Departure</legend>
                        <input class="input1" type=text name="depart" <?php echo "value='".trim($_POST['depart']," ")."'"?> readonly>
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Destination</legend>
                        <input class="input1" type=text name="destination" <?php echo "value='".trim($_POST['destination']," ")."'"?> readonly>
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Est. Time of Arrival</legend>
                        <input class="input1" type=text name="arrive" <?php echo "value='".trim($_POST['arrive']," ")."'"?> readonly>
                    </fieldset>
                    <fieldset class="field3">
                        <legend class="legend1">Gate</legend>
                        <input class="input1" type=text name="gate" <?php echo "value='".trim($_POST['gate']," ")."'"?> readonly>
                    </fieldset>
                    <fieldset class="field3">
                        <legend class="legend1">Seat</legend>
                        <input class="input1" type=text name="seat" <?php echo "value='".trim($_POST['seat']," ")."'"?> readonly>
                    </fieldset>
                </fieldset>
            </div>
            <div class="div-2" style=" margin-top: 0.1px; padding-top: 1px;">
                <fieldset class="field0">
                        <fieldset class="field1">
                            <legend class="legend1">Passport Number</legend>
                            <input class="input1" type="text" id="passportno" name="passportno" <?php echo "value='".$row['PassportNo']."'"?> readonly>
                        </fieldset> <br>
                        <fieldset class="field1">
                            <legend class="legend1">Passport Expiry Date</legend>
                            <input class="input1" type="text" id="passportexp" name="passportexp" <?php echo "value='".$row['PassportExp']."'"?> readonly>
                        </fieldset> <br>
                        <fieldset class="field2">
                            <legend class="legend1">Nationality</legend>
                            <input class="input1" type="text" name="nationality" id="nationality" <?php echo "value='".$row['Nationality']."'"?> readonly>
                        </fieldset> <br>
                        <fieldset class="field1">
                            <legend class="legend1">First Name</legend>
                            <input class="input1" type="text" id="firstname" name="firstname" <?php echo "value='".$row['FirstName']."'"?> readonly>
                        </fieldset> <br>
                        <fieldset class="field1">
                            <legend class="legend1">Last name</legend>
                            <input class="input1" type="text" id="lastname" name="lastname" <?php echo "value='".$row['SurName']."'"?> readonly>
                        </fieldset> <br>
                </fieldset> <br>
            </div>
            <div class="div-2" style=" margin-top: 1px; padding-top: 1px;">
                <fieldset class="field0" style=" margin: 5px;">
                    <?php 
                        $query0 = "SELECT * FROM `payment method`";
                        $result0 = mysqli_query($conn,$query0);
                    ?>
                    <label>Payment Method</label> <br>
                    <select name="pay_method" id="pay_method">
                        <option value="">None</option>
                        <?php while($method = mysqli_fetch_array($result0) ) { ?>
                            <option 
                                <?php 
                                    echo "value='".$method['Method_Code']."'";
                                    echo "id='".$method['Method_Name']."'";
                                ?>
                            >
                            <?php 
                                if($method['Bank'] != "") echo $method['Bank'];
                                else if($method['Service'] != "") echo $method['Service'];
                                else echo "Credit/Debit Card";
                            ?>
                            </option>
                        <?php } mysqli_data_seek($result0, 0);?>
                    </select> <br>
                    <?php 
                        $query1 = "SELECT * FROM promotion";
                        $result1 = mysqli_query($conn,$query1);
                    ?> 
                    <label>Discount</label> <br>
                    <select name="discount" id="discount">
                        <option value="">None</option>
                        <?php while($discount = mysqli_fetch_array($result1) ) { ?>
                            <option <?php echo "value='".$discount['Promotion_ID']."'";?>><?php echo "".$discount['Promotion_Name']." ".$discount['Description']."";?></option>
                        <?php } mysqli_data_seek($result1, 0);?>
                    </select> <br>
                    <?php 
                        $subtotal = cal_Price($conn,trim($_POST['ticket_id']," "));
                        $taxes = 0.07 * $subtotal;
                        $total = $subtotal + $taxes;
                        $receipt = generateReceiptID($conn);
                    ?>
                    <fieldset class="field2" style=" width: 20%; ">
                        <legend class="legend1">Transaction ID</legend>
                        <input class="input1" type="text" id="receipt" name="receipt" <?php echo "value='".$receipt."'"?> readonly>
                    </fieldset> 
                    <fieldset class="field2" style=" width: 20%; ">
                        <legend class="legend1">Sub-Total</legend>
                        <input class="input1" type="text" id="subtotal" name="subtotal" <?php echo "value='".$subtotal."'"?> readonly>
                    </fieldset> 
                    <fieldset class="field2" style=" width: 20%; ">
                        <legend class="legend1">Taxes</legend>
                        <input class="input1" type="text" id="tax" name="tax" <?php echo "value='".$taxes."'"?> readonly>
                    </fieldset> 
                    <fieldset class="field2" style=" width: 20%; ">
                        <legend class="legend1">Total</legend>
                        <input class="input1" type="text" id="total" name="total" <?php echo "value='".$total."'"?> readonly>
                    </fieldset>
                </fieldset>
                <div style=" margin-top: 1px; padding-top: 1px;" id="creditcard">
                    <fieldset class="field0">
                        <fieldset class="field1">
                            <legend class="legend1">Credit Card No.</legend>
                            <input class="input1" type="text" id="cardno" name="cardno" placeholder="Enter your credit card number">
                        </fieldset>
                        <fieldset class="field1">
                            <legend class="legend1">Credit Card Name</legend>
                            <input class="input1" type="text" id="cardname" name="cardname" placeholder="Enter the name on your credit card">
                        </fieldset>
                        <fieldset class="field1">
                            <legend class="legend1">Credit Card Expire Date</legend>
                            <input class="input1" type="date" id="cardexp" name="cardexp">
                        </fieldset>
                        <fieldset class="field1">
                            <legend class="legend1">Credit Card CVV</legend>
                            <input class="input1" type="text" id="cvv" name="cvv" placeholder="Enter security code">
                        </fieldset> <br>
                        <fieldset class="btnbox"> 
                        <input class="button1" type="submit" name="card_submit" value="Proceed"/>
                        </fieldset>
                </fieldset>
                    </fieldset>
                </div>
                <div id="scb">
                    <fieldset class="field0">
                        <fieldset class="btnbox"> 
                            <input class="button1" type="submit" name="scb_submit" value="Proceed"/>
                        </fieldset>
                    </fieldset>
                </div>
                <div id="counter">
                    <fieldset class="field0">
                        <fieldset class="btnbox"> 
                            <input class="button1" type="submit" name="counter_submit" value="Proceed"/>
                        </fieldset>
                    </fieldset>
                </div>
            </div>
        </form>
        <?php }
            else {
                echo " <div class='div-2'> You're not supposed to be here. (Go book some ticket!) </div>";
            }
        ?>
    </body>
</html>

<script type="text/javascript" language="javascript">
   $(document).ready(function() {
        $("#creditcard").css("display","none");
        $("#scb").css("display","none");
        $("#counter").css("display","none");
        $("#pay_method").on('keyup change', function() {
            var method = $("#pay_method").val();
            var bool = Boolean(method != "" );
            if(bool) {
                if(method.match(/CDC/)) {
                    $("#creditcard").css("display","");
                    $("#scb").css("display","none");
                    $("#counter").css("display","none");
                }
                else if(method.match(/AMB/)) {
                    $("#scb").css("display","");
                    $("#creditcard").css("display","none");
                    $("#counter").css("display","none");
                }
                else if(method.match(/OTC/)) {
                    $("#counter").css("display","");
                    $("#creditcard").css("display","none");
                    $("#scb").css("display","none");
                }
            }
            else {
                $("#creditcard").css("display","none");
                $("#scb").css("display","none");
                $("#counter").css("display","none");
            }
        });
    });

</script>