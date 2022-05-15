<?php 
    include("database-connect.php");
    //if(isset( $_GET['id'])) {
    $ticket_id = $_GET['id'];
    $sql = "SELECT b.PassportNo, b.Receipt_ID, b.Flight_ID, pa.FirstName, pa.SurName,
        a.Airport_ID AS SourceAirport, a.Country AS SourceCountry,
        ab.Airport_ID AS DestinationAirport, ab.Country AS DestinationCountry,
        pm.Method_Name, pm.Bank, pm.Service, p.Taxes_Fees, p.SubTotal, di.Promotion_Name, di.Description, p.Discount, p.Total_Paid, p.Remain
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
            LEFT JOIN `payment method` pm
            on p.Method_Code = pm.Method_Code
            LEFT JOIN `promotion` di 
            on p.Promotion_ID = di.Promotion_ID
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bwip-js/3.0.4/bwip-js.min.js"></script>

<html>
    <head>
        <title>Receipt Form</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
    </head>
    <body class="active">
    <div class="container mt-5 mb-3">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="d-flex flex-row p-2">
                    <div class="d-flex flex-column"> 
                        <span class="fw-bold">Payment Form</span> 
                        <small><?php echo "INV #".$row['Receipt_ID']."<br>Method: ".$row['Method_Name'].""; ?></small> 
                    </div>
                </div>
                <hr>
                <div class="table-responsive p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="fw-bold">
                                <td>Client Info</td>
                                <td class="text-center">Item Info</td>
                            </tr>
                            <tr class="content">
                                <td> 
                                <?php 
                                    echo "Passport #".getTruncatedNumber($row['PassportNo'])." <br>
                                    ".$row['FirstName'].", ".$row['SurName'].""
                                ?>      
                                </td>
                                <td class="text-center">
                                <?php 
                                    echo "Ticket #".$ticket_id." <br>
                                    Flight #".$row['Flight_ID']." <br>".$row['SourceAirport'].", ".$row['SourceCountry']." to
                                    ".$row['DestinationAirport'].", ".$row['DestinationCountry']." <br>";
                                ?> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                 <div class="products p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="fw-bold add">
                                <td>Description</td>
                                <td class="text-start">Price</td>
                            </tr>
                            <tr class="content">
                                <td>Subtotal (Tax not included)</td>
                                <td class="text-start">฿<?php echo $row['SubTotal'];?></td>
                            </tr>
                            <tr class="content">
                                <td>Tax & Fees</td>
                                <td class="text-start">฿<?php echo $row['Taxes_Fees'];?></td>
                            </tr>
                            <tr class="content">
                                <td>Discount
                                    <?php 
                                        if($row['Promotion_Name'] != "") {
                                            echo "<br>".$row['Promotion_Name']."<br>".$row['Description']."";
                                        }
                                    ?>
                                </td>
                                <td class="text-start">฿<?php echo $row['Discount'];?></td>
                            </tr>
                            <?php $total = $row['SubTotal'] + $row['Taxes_Fees'] - $row['Discount']?>
                            <tr class="content">
                                <td class="fw-bold">Total Due</td>
                                <td class="fw-bold text-start">฿<?php echo $total;?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                 <!-- <hr> 
                <div class="products p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="fw-bold add">
                                <td></td>
                                <td>Subtotal</td>
                                <td class="text-center">Tax & Fees</td>
                                <td class="text-center">Total</td>
                            </tr>
                            <tr class="content">
                                <td></td>
                                <td>$40,000</td>
                                <td class="text-center">2,500</td>
                                <td class="text-center">$42,500</td>
                            </tr>
                        </tbody>
                    </table>
                </div>  -->
                <hr>
                <div class="address p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="fw-bold add">
                                <?php if($row['Bank']!="") { ?>
                                <td>Bank Details</td>
                                <?php } 
                                    else if($row['Service']!="") { ?>
                                <td>Service Details</td>
                                <?php } ?>
                            </tr>
                            <tr class="content">
                                <td> 
                                <?php 
                                    if($row['Bank']!="") {
                                        echo "Bank Name: ".$row['Bank']."<br>";
                                    }
                                    else if($row['Service']!="") {
                                        echo "Service Name: ".$row['Service']."<br>";
                                    }
                                ?>
                                Ref Code1 #<?php echo rand(0,99999);?><br>
                                Ref Code2 #<?php echo "FAA".rand(0,99999999)."";?><br>
                                Account Holder : Fallen Angel Airline Co., Ltd.<br>
                                Account Number : 5454542WQR<br> 
                                <img src="img\qr_code.png" class="position-absolute bottom-0 end-0" width="20%" >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <canvas id="qrcodeCanvas" class="mt-0"></canvas>
                        <script>
                        try {
                            // The return value is the canvas element
                            let canvas = bwipjs.toCanvas('qrcodeCanvas', {
                                bcid:'code128',
                                text:'{{rand(0,99999999999999)}}', 
                                scale: 2,
                                height: 10
                            });
                        } catch (e) {
                            // `e` may be a string or Error object
                        }
                        </script>
                </div>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>


