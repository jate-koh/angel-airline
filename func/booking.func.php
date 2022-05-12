<?php
    function get_all_records() {
        include("database-crud.php");
        $query =    
        "SELECT b.PassportNo,b.Receipt_ID,b.Flight_ID,b.TicketID,s.Airport_ID AS SourceID, s.Airport_Name AS SourceName, s.Country AS SourceCountry, f.Departure,
        d.Airport_ID AS DestinationID, d.Airport_Name AS DestinationName, d.Country AS DestinationCountry, f.Arrival, b.Ticket_Price
        FROM `booking detail` b
        LEFT JOIN flight f
            ON f.FlightID = b.Flight_ID
        LEFT JOIN airport s
            ON f.SourceID = s.Airport_ID
        LEFT JOIN airport d
            ON f.DestinationID = d.Airport_ID
        WHERE PassportNo IS NULL;";
        $stmt = $connection -> prepare($query);
        $stmt -> execute();
        return $stmt -> rowCount();
    }
?>