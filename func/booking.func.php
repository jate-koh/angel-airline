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
    
    function passportExist($conn,$passportno) {
        $sql = 
        "SELECT * FROM passenger 
        WHERE PassportNo = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)) {
            echo "STMT Error";
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

    function cal_Price($conn,$ticket_id) {
        $sql = "SELECT * FROM `booking detail`
        WHERE TicketID like '%{$ticket_id}%' ;";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);

        return $row['Ticket_Price'];
    }

    function generateReceiptID($conn) {
        $sql = 
        "SELECT * FROM `payment info`
        WHERE Receipt_ID = ?;";

        $dupe = true;
        while($dupe == true) {
            $receipt = rand(0,9999999999);
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"s",$receipt);
            mysqli_stmt_execute($stmt);
            $check = mysqli_stmt_get_result($stmt);

            if(mysqli_fetch_assoc($check)) {
                $dupe = true;
            }
            else {
                $dupe = false;
            }
        }
        return $receipt;
        mysqli_stmt_close($stmt);
    }

    function init_creditCard($conn,$reciept_id,$method_id,$discount_id,$subtotal,$tax,$cardno,$cardname,$cardexp,$cvv) {
        $query0 = "INSERT INTO `payment info` (`Receipt_ID`, `Method_Code`, `Promotion_ID`, 
        `Taxes_Fees`, `SubTotal`, `Discount`, `Total_Paid`, `Remain`, `CardNo`, `CardName`, 
        `ExpDate`, `CVV`) 
        VALUES (?,?,?,?,?,?,?,0,?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$query0);

        if($discount_id != "") {
            $query1 = "SELECT * FROM promotion WHERE Promotion_ID like '%{$discount_id}%';";
            $result1 = mysqli_query($conn,$query1);
            $row1 = mysqli_fetch_array($result1);
            $mod = $row1['Modifier'];
            $cal_discount = $subtotal*$mod;
            $total = $subtotal + $tax;
            mysqli_stmt_bind_param($stmt,"sssddddsssi",$reciept_id,$method_id,$discount_id,$tax
            ,$subtotal,$cal_discount,$total,$cardno,$cardname,$cardexp,$cvv);
            mysqli_stmt_execute($stmt);
        }
        else {
            $cal_discount = 0;
            $total = $subtotal + $tax;
            $promotion = null;
            mysqli_stmt_bind_param($stmt,"sssddddsssi",$reciept_id,$method_id,$promotion,$tax,
            $subtotal,$cal_discount,$total,$cardno,$cardname,$cardexp,$cvv);
            mysqli_stmt_execute($stmt);
        }

        echo "<script> alert('Credit Card Payment Successful'); </script>";
        mysqli_stmt_close($stmt);
    }

    function book($conn,$ticket_id,$passportno,$reciept_id) {
        $query0 = "UPDATE `booking detail` 
        SET PassportNo = '$passportno', Receipt_ID = '$reciept_id'  
        WHERE TicketID like '%{$ticket_id}%' ;";
        mysqli_query($conn,$query0);
    }


?>