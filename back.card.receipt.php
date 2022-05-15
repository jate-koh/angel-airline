<?php 
    include("database-connect.php");
    if(isset( $_GET['id'])) {
    $ticket_id = $_GET['id'];
    $sql = " SELECT b.PassportNo, b.Receipt_ID, b.Flight_ID, pa.FirstName, pa.SurName,
    a.Airport_ID AS SourceAirport, a.Country AS SourceCountry,
    ab.Airport_ID AS DestinationAirport, ab.Country AS DestinationCountry,
    p.Taxes_Fees, p.SubTotal, p.Discount, p.Total_Paid, p.Remain, p.CardNo, p.CardName
    FROM `booking detail` b
        LEFT JOIN `payment info` p 
        on b.Receipt_ID = p.Receipt_ID
        LEFT JOIN `flight` f 
        on b.Flight_ID = f.FlightID
        LEFT JOIN `passenger` pa
        on b.PassportNo = pa.PassportNo
        LEFT JOIN `airport` a
        on f.SourceID = a.Airport_ID
         LEFT JOIN `airport` ab
        on f.DestinationID = ab.Airport_ID
    WHERE b.TicketID = '{$ticket_id}';";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    function getTruncatedNumber($Num){
        return str_replace(range(0,9), "*", substr($Num, 0, -4)) .  substr($Num, -4);
    }
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://kit.fontawesome.com/79e310ad42.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" crossorigin="anonymous" ></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous">
</script>
<html>
    <head>
        <title>Credit Card Receipt</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\back\receipt.card.css">
    </head>
    <body class="active">

    <div class="div-2">
    <table class="body-wrap">
    <tbody><tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td class="content-wrap aligncenter">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody><tr>
                                    <td class="content-block">
                                        <h2>Thanks for using our service</h2> <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <table class="invoice">
                                            <tbody><tr>
                                                <td>
                                                <?php 
                                                    echo "Ticket #".$ticket_id." <br>Receipt #".$row['Receipt_ID']." <br>
                                                    Flight #".$row['Flight_ID']." <br>".$row['SourceAirport'].", ".$row['SourceCountry']." to
                                                    ".$row['DestinationAirport'].", ".$row['DestinationCountry']." <br>
                                                    Pay via Credit Card: ".getTruncatedNumber($row['CardNo'])." <br>
                                                    Card Name: ".$row['SurName'].", ".$row['FirstName']." "
                                                ?>       
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                        <tbody><tr>
                                                            <td>Subtotal (No tax/fees)</td>
                                                            <td class="alignright">฿<?php echo $row['SubTotal']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tax & Fees</td>
                                                            <td class="alignright">฿<?php echo $row['Taxes_Fees']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Discount</td>
                                                            <td class="alignright">฿<?php echo $row['Discount']; ?></td>
                                                        </tr>
                                                        <?php $total = $row['SubTotal'] + $row['Taxes_Fees'] - $row['Discount'] ?>
                                                        <tr class="total">
                                                            <td class="alignright" width="80%">Total</td>
                                                            <td class="alignright">฿<?php echo $total; ?></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td class="alignright" width="80%">Total Paid</td>
                                                            <td class="alignright">฿<?php echo $row['Total_Paid']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="alignright" width="80%">Remain Due</td>
                                                            <td class="alignright">฿<?php echo $row['Remain']; ?></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <h4>Please save this invoice for retrieving flight ticket...</h4>
                                        <a href="#">View in browser</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        Fallen Angel Airline, 126 Pracha Uthit Rd, Bang Mot, Thung Khru, Bangkok 10140
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                </tbody></table>
                <div class="footer">
                    <table width="100%">
                        <tbody><tr>
                            <td class="aligncenter content-block">Questions? Email <a href="mailto:">sudarat.rjubjib@mail.kmutt.ac.th</a></td>
                        </tr>
                    </tbody></table>
                </div></div>
            </td>
        <td></td>
    </tr>
</tbody></table>
            </div>
    <?php
    }
    else {
        echo "You're not supposed to be here! (Book some flight!)";
    }
    ?>
    </body>
</html>
