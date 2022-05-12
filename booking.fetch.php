<?php
    include("database-crud.php");
    include("./func/booking.func.php");
    $output = array();
    $query = '';
    $query .= "SELECT * FROM flight";

    if(isset($_POST['search']['value'])) {
        $query .= "WHERE SourceID like '%".$_POST['search']['value']."%' ";
        $query .= "OR DestinationID like '%".$_POST['search']['value']."%' ";
    }

    if(isset($_POST['order'])) {
       $query .= "ORDER BY  ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
    }
    else {
        $query .= "ORDER BY FlightID DESC ";
    }

    if($_POST["length"] != -1 ) {
       $query .= 'LIMIT '.$_POST['start'].', '.$_POST['length'].' ';
    }
    $query .= ";";

    $stmt = $connection -> prepare($query);
    $stmt -> execute();
    $result = $stmt -> fetchAll();

    $data = array();
    $filter_row = $stmt -> rowCount();

    foreach($result as $row) {
        $sub_array = array();
        $sub_array = $row['SourceID'];
        $sub_array = $row['Departure'];
        $sub_array = $row['DestinationID'];
        $sub_array = $row['Arrival'];
        $sub_array = '<button name="book" id="'.$row["FlightID"].'">Book</button>';
    }

    $output = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $filter_row,
        "recordsFiltered" => get_all_records(),
        "data" => $data
    );

    echo json_encode($output);
?>