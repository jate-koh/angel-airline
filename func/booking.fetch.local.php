<?php
    include("database-crud.php");
    include("booking.func.php");
    $output = array();
    $query = '';
    $query .= 
    "SELECT b.PassportNo,b.Receipt_ID,b.Flight_ID,b.TicketID,s.Airport_ID AS SourceID, s.Airport_Name AS SourceName, s.Country AS SourceCountry, f.Departure,
    d.Airport_ID AS DestinationID, d.Airport_Name AS DestinationName, d.Country AS DestinationCountry, f.Arrival, b.Ticket_Price
    FROM `booking detail` b
    LEFT JOIN flight f
        ON f.FlightID = b.Flight_ID
    LEFT JOIN airport s
        ON f.SourceID = s.Airport_ID
    LEFT JOIN airport d
        ON f.DestinationID = d.Airport_ID
    WHERE b.PassportNo IS NULL ";

    if(isset($_POST['search']['value'])) {
        $query .= "OR s.Airport_ID like '%".$_POST['search']['value']."%' ";
        $query .= "OR s.Airport_Name like '%".$_POST['search']['value']."%' ";
        $query .= "OR s.Country like '%".$_POST['search']['value']."%' ";
        $query .= "OR d.Airport_ID like '%".$_POST['search']['value']."%' ";
        $query .= "OR d.Airport_Name like '%".$_POST['search']['value']."%' ";
        $query .= "OR d.Country like '%".$_POST['search']['value']."%' ";
    }

    if(isset($_POST['order'])) {
        $query .= 'ORDER BY  '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
    }
    else {
        $query .= "ORDER BY b.Flight_ID DESC ";
    }

    if($_POST["length"] != -1 ) {
       //$query .= 'LIMIT '.$_POST['start'].', '.$_POST['length'].' ';
    }
    $query .= ";";

    $stmt = $connection -> prepare($query);
    $stmt -> execute();
    $result = $stmt -> fetchAll();

    $data = array();
    $filter_row = $stmt -> rowCount();

    foreach($result as $row) {
        $sub_array = array();
        $sub_array[] = $row["SourceName"];
        $sub_array[] = $row["Departure"];
        $sub_array[] = $row["DestinationName"];
        $sub_array[] = $row["Arrival"];
        $sub_array[] = $row["Ticket_Price"];
        $sub_array[] = '<button type="button" name="update" id="'.$row["TicketID"].'" class="btn btn-warning btn-xs update">Book</button>';
        $data[] = $sub_array;
    }

    $output = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $filter_row,
        "recordsFiltered" => get_all_records(),
        "data" => $data
    );

    echo json_encode($output);
?>