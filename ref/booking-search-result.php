<?php
    include("database-connect.php");
    $sql1 = "SELECT * FROM airport";
    $sql2 = "SELECT * FROM flight";
    $choice = mysqli_query($conn,$sql1);
    $result = mysqli_query($conn,$sql2);
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
        <form action="booking-search-result.php" method="post">
            <div class="div-2">
                <fieldset class="field0">
                    <a href="booking.html"><span>Round-Trip</span></a> 
                    <a href="booking-oneway.html"><span>One-Way</span></a> <br>
                    <fieldset class="field1">
                        <legend class="legend1">From</legend>
                        <select class="input2" name="source" id="source">
                            <?php while($row = mysqli_fetch_array($choice) ) { ?>
                                <option value="<?php echo $row['Airport_ID']; ?>"> <?php echo $row['Airport_Name']; ?>, <?php echo $row['Country']; ?></option>
                            <?php } mysqli_data_seek($choice, 0); ?>
                        </select>
                    </fieldset>
                    <fieldset class="field1">
                        <legend class="legend1">To</legend>
                        <select class="input2" name="target" id="target">
                            <?php while($row = mysqli_fetch_array($choice) ) { ?>
                                <option value="<?php echo $row['Airport_ID']; ?>"> <?php echo $row['Airport_Name']; ?>, <?php echo $row['Country']; ?></option>
                            <?php } mysqli_data_seek($choice, 0); ?>
                        </select>
                    </fieldset> <br>
                    <fieldset class="field2">
                        <legend class="legend1">Depature Date</legend>
                        <input class="input1" type="date" id="depart" name="depart">
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Return Date</legend>
                        <input class="input1" type="date" id="return" name="return">
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Seat Class</legend>
                        <select class="input2" name="class" id="class">
                            <option value="economy">Economy Class</option>
                            <option value="business">Business Class</option>
                            <option value="first class">First Classs</option>
                        </select>
                    </fieldset> <br>
                    <input class="button1" name="search" type="submit" id="search" value="Search" />
                </fieldset>
            </div>
        </form>
    </body>
</html>

<!-- Vue Script 
    <script>
        let app = Vue.createApp( {
            data: function() {
                return {
                    
                }
            },
            methods: { 
                print(input) {
                    console.log(input)
                }
            }
        } )
        
        app.component('login-form', { 
            template: 
            `   
            `,
            data() { 
                return {
                    
                }
            },
            methods: {

            }
        })
        app.mount('#app')
    </script> -->
