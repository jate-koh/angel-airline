<?php
    include("database-crud.php");
    include("booking.func.php");
    if(isset($_POST["ticket_id"])) {
        $output = array();
        $stmt = $connection -> prepare(
            "SELECT b.PassportNo,b.Receipt_ID,b.Flight_ID,b.TicketID,s.Airport_ID AS SourceID, s.Airport_Name AS SourceName, s.Country AS SourceCountry, f.Departure,
            d.Airport_ID AS DestinationID, d.Airport_Name AS DestinationName, d.Country AS DestinationCountry, f.Arrival, b.Ticket_Price
            FROM `booking detail` b
            LEFT JOIN flight f
                ON f.FlightID = b.Flight_ID
            LEFT JOIN airport s
                ON f.SourceID = s.Airport_ID
            LEFT JOIN airport d
                ON f.DestinationID = d.Airport_ID
            WHERE b.PassportNo IS NULL
            AND TicketID = '".$_POST["ticket_id"]."' 
            LIMIT 1;"
        );
        $stmt -> execute();
        $result = $stmt -> fetchAll();

        foreach($result as $row) {
            $output["ticket_id"] = $row["TicketID"];
            $output["flight_id"] = $row["Flight_ID"];
        }
        echo json_encode($output);
    }
    else {
        echo "failed";
    }
?>