<?php
include("database-connect.php");
if(isset($_POST['destination'])) {
    $destination = $_POST['destination'];
}
if(isset($_POST['source'])) {
    $source = $_POST['source'];
}
if(isset($_POST['date_arr'])) {
    $date_arr = $_POST['date_arr'];
}
if(isset($_POST['date_dep'])) {
    $date_dep = $_POST['date_dep'];
}
$sql =" SELECT * FROM flight 
    WHERE (SourceID LIKE '{$source}%')
    AND (DestinationID LIKE '{$destination}%')
    AND (Arrival LIKE '{$date_arr}%')
    AND (Departure LIKE '{$date_dep}%')";
$result = mysqli_query($conn,$sql);
?>

<head>
    <link rel="stylesheet" type="text/css" href="styles\form.css">
    <link rel="stylesheet" type="text/css" href="styles\table.css">
</head>
        <fieldset class="field0">
        <?php
            if($result -> num_rows > 0) {
        ?> 
            <table class="result">
                <thead>
                    <tr>
                        <th>Flight ID</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Departure Date</th>
                        <th>Departure Time</th>
                        <th>Arrival Date</th>
                        <th>Arrival Time</th>
                        <th>Status</th>
                    </tr>
                <thead>
                <tbody>
                    <?php 
                        while($row = $result -> fetch_assoc()) { 
                            $arrive = new DateTime($row['Arrival']);
                            $depart = new DateTime($row['Departure']);
                            $arrdate = $arrive -> format('Y-m-d');
                            $arrtime = $arrive -> format('H:i:s');
                            $depdate = $depart -> format('Y-m-d');
                            $deptime = $depart -> format('H:i:s');
                    ?>
                    <tr>
                        <td><?php echo $row["FlightID"] ?></td>
                        <td><?php echo $row["SourceID"] ?></td>
                        <td><?php echo $row["DestinationID"] ?></td>
                        <td><?php echo $depdate ?></td>
                        <td><?php echo $deptime ?></td>
                        <td><?php echo $arrdate ?></td>
                        <td><?php echo $arrtime ?></td>
                        <td><?php echo $row["Status"] ?></td>
                    </tr>
                    <?php 
                        } 
                    ?>
                </tbody>
            </table>
<?php        
    }
    else {
        echo "No data found";
    }
?>
        </fieldset>