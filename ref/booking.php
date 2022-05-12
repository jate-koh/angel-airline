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
        <title>Booking</title>
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