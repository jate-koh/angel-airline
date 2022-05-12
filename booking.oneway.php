<?php
    include("database-connect.php");
    $sql = "SELECT * FROM airport";
    $choice = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://kit.fontawesome.com/79e310ad42.js" crossorigin="anonymous"></script>
<scrip
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous">
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<html>
    <head>
        <title>Booking</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\form.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" href="styles\bg2.css"> <!-- Apply Bg Image -->
    </head>
    <script> 
        $(function(){
            $("#menu").load("menu.html"); 
        });
    </script> 
    <body class="active">

        <div id="menu"></div>
        
        <!-- Content
        <form action="booking-search-result.php" method="get">
            <div class="div-2">
                <fieldset class="field0">
                    <a href="booking.html"><span>Round-Trip</span></a> 
                    <a href="booking-oneway.html"><span>One-Way</span></a> <br>
                    <fieldset class="field1">
                        <legend class="legend1">From</legend>
                        <select class="input2" name="source">
                            <?php while($row = mysqli_fetch_array($choice) ) { ?>
                                <option value="<?php echo $row['Airport_ID']; ?>"> <?php echo $row['Airport_Name']; ?>, <?php echo $row['Country']; ?></option>
                            <?php } mysqli_data_seek($choice, 0); ?>
                        </select>
                    </fieldset>
                    <fieldset class="field1">
                        <legend class="legend1">To</legend>
                        <select class="input2" name="target">
                            <?php while($row = mysqli_fetch_array($choice) ) { ?>
                                <option value="<?php echo $row['Airport_ID']; ?>"> <?php echo $row['Airport_Name']; ?>, <?php echo $row['Country']; ?></option>
                            <?php } mysqli_data_seek($choice, 0); ?>
                        </select>
                    </fieldset> <br>
                    <fieldset class="field2">
                        <legend class="legend1">Depature Date</legend>
                        <input class="input1" type="date" name="depart">
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Return Date</legend>
                        <input class="input1" type="date" name="return">
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Seat Class</legend>
                        <select class="input2" name="class">
                            <option value="economy">Economy Class</option>
                            <option value="business">Business Class</option>
                            <option value="first class">First Classs</option>
                        </select>
                    </fieldset> <br>
                </fieldset>
            </div>
        </form>  -->

        <div class="div-2">
            <table id="flight_data" >
                <thead>
                    <tr>
                        <th width="20%">Source</th>
                        <th width="10%">Departure</th>
                        <th width="20%">Destination</th>
                        <th width="10%">Arrival Time Est.</th>
                        <th width="10%">Book</th>
                    </tr>
                </thead>
            </table>
        </div>
    </body>
</html>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $('#addbutton').click(function() {
            $('#form')[0].reset();
            $('.modal-title').text("Add");
            $('#action').val("Add");
            $('#operation').val("Add");
        });

        var dataTable = $('#flight_data').dataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax": {
                url:"./booking.fetch.php",
                method:"POST"
            },
            "columnDefs":[
                {
                "target":[0,3,4],
                "orderable":false
                }
            ]
        });

    });

</script>