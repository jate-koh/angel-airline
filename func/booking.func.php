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
    
    function passportExist($conn,$passportno,) {
        $sql = 
        "SELECT * FROM passenger 
        WHERE PassportNo = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)) {
            header("location:./back.booking.passport.php?error=stmtfailure");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$passportno);
        mysqli_stmt_execute($stmt);
        $check = mysqli_stmt_get_result($stmt);

        if(mysqli_fetch_assoc($check)) {
            $result = true;
            return $result;
        }
        else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    
?>