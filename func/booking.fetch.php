<?php
include("database-connect.func.php");

$sql = '';
$sql .= 
"SELECT b.PassportNo,b.Receipt_ID,b.Flight_ID,b.TicketID,s.Airport_ID AS SourceID, s.Airport_Name AS SourceName, s.Country AS SourceCountry, f.Departure,
d.Airport_ID AS DestinationID, d.Airport_Name AS DestinationName, d.Country AS DestinationCountry, f.Arrival, b.Ticket_Price, f.Gate
FROM `booking detail` b
LEFT JOIN flight f
    ON f.FlightID = b.Flight_ID
LEFT JOIN airport s
    ON f.SourceID = s.Airport_ID
LEFT JOIN airport d
    ON f.DestinationID = d.Airport_ID
WHERE PassportNo IS NULL ";


if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql .="AND (s.Airport_Name LIKE '%{$search}%' OR d.Airport_Name LIKE '%{$search}%') ";
}

$sql .= ";";
$result = mysqli_query($conn,$sql);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<head>
    <link rel="stylesheet" type="text/css" href="styles\form.css">
    <link rel="stylesheet" type="text/css" href="styles\table.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
</head>
        <?php
            if($result -> num_rows > 0) {
        ?> 
            <table id="flight_data" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th width="20%">Source</th>
                            <th width="10%">Departure</th>
                            <th width="20%">Destination</th>
                            <th width="10%">Arrival Time Est.</th>
                            <th width="10%">Ticket Price</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                        <tbody> 
                        <?php 
                            if($result -> num_rows > 0) {
                                while($row = $result -> fetch_assoc()) { 
                        ?>
                            <tr>
                                <td><?php echo $row['SourceName']; ?></td>
                                <td><?php echo $row['Departure']; ?></td>
                                <td><?php echo $row['DestinationName']; ?></td>
                                <td><?php echo $row['Arrival']; ?></td>
                                <td><?php echo $row['Ticket_Price']; ?></td>
                                <td><?php echo '<button type="submit" name="ticket_id" value="'.$row["TicketID"].'" class="btn btn-warning btn-xs update">Book</button>' ?></td>
                            </tr>
                        <?php   } 
                            }
                            mysqli_data_seek($result, 0);
                        ?>
                        </tbody>
                </table>
<?php        
    }
    else {
        echo "No data found";
    }
?>
