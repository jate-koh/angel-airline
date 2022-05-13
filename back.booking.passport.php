<?php
    include("database-connect.php");
    if(isset($_POST['ticket_id'])) {
        $ticket_id = $_POST['ticket_id'];
        $sql = "SELECT b.PassportNo,b.Receipt_ID,b.Flight_ID,b.TicketID,s.Airport_ID AS SourceID, s.Airport_Name AS SourceName, s.Country AS SourceCountry, f.Departure,
        d.Airport_ID AS DestinationID, d.Airport_Name AS DestinationName, d.Country AS DestinationCountry, f.Arrival, b.Ticket_Price, f.Gate, b.SeatNo
        FROM `booking detail` b
        LEFT JOIN flight f
            ON f.FlightID = b.Flight_ID
        LEFT JOIN airport s
            ON f.SourceID = s.Airport_ID
        LEFT JOIN airport d
            ON f.DestinationID = d.Airport_ID
        WHERE TicketID like '%{$ticket_id}%' 
        LIMIT 1;";
        $result = mysqli_query($conn,$sql);
    }
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://kit.fontawesome.com/79e310ad42.js" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous">
</script>
<html>
    <head>
        <title>Booking</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\back\back.menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\back\back.form.css">
    </head>
    <script> 
            $(function(){
                $("#menu").load("back.menu.php"); 
            });
        </script> 
    <body class="active">

    <div id="menu"></div>
        
        <!-- Content -->
        <?php if(isset($_POST['ticket_id'])) { ?>
        <form action="back.booking.payment.php" method="POST">
            <div class="div-2" style=" margin-top: 0.1px;">
            <?php $row = mysqli_fetch_array($result); ?>
                <fieldset class="field0">
                    <fieldset class="field1">
                        <legend class="legend1">Ticket ID</legend>
                        <input class="input1" type=text name="ticket_id" <?php echo "value=' ".$row['TicketID']." ' "?> readonly>
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Flight ID</legend>
                        <input class="input1" type=text name="flight_id" <?php echo "value=' ".$row['Flight_ID']." ' "?> readonly>
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Source</legend>
                        <input class="input1" type=text name="source" <?php echo "value=' ".$row['SourceID'].", ".$row['SourceName'].", ".$row['SourceCountry']." ' "?> readonly>
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Time of Departure</legend>
                        <input class="input1" type=text name="depart" <?php echo "value=' ".$row['Departure']." ' "?> readonly>
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Destination</legend>
                        <input class="input1" type=text name="destination" <?php echo "value=' ".$row['DestinationID'].", ".$row['DestinationName'].", ".$row['DestinationCountry']." ' "?> readonly>
                    </fieldset>
                    <fieldset class="field2">
                        <legend class="legend1">Est. Time of Arrival</legend>
                        <input class="input1" type=text name="arrive" <?php echo "value=' ".$row['Arrival']." ' "?> readonly>
                    </fieldset>
                    <fieldset class="field3">
                        <legend class="legend1">Gate</legend>
                        <input class="input1" type=text name="gate" <?php echo "value=' ".$row['Gate']." ' "?> readonly>
                    </fieldset>
                    <fieldset class="field3">
                        <legend class="legend1">Seat</legend>
                        <input class="input1" type=text name="seat" <?php echo "value=' ".$row['SeatNo']." ' "?> readonly>
                    </fieldset>
                </fieldset>
            </div>
            <div class="div-2" style=" margin-top: 0.1px; padding-top: 1px;">
                <fieldset class="field0">
                    <fieldset class="field0" style=" padding-top: 1px;">
                        <legend class="legend1">Passport Info</legend>
                        <fieldset class="field1">
                            <legend class="legend1">Passport Number</legend>
                            <input class="input1" type="text" id="passportno" name="passportno" placeholder="Enter your Passport Number">
                        </fieldset> <br>
                        <fieldset class="field1">
                            <legend class="legend1">Passport Expiry Date</legend>
                            <input class="input1" type="date" id="passportexp" name="passportexp">
                        </fieldset> <br>
                        <fieldset class="field2">
                            <legend class="legend1">Nationality</legend>
                            <select class="input2" name="nationality" id="nationality">
                                <option value="">-- select one --</option>
                                <option value="afghan">Afghan</option>
                                <option value="albanian">Albanian</option>
                                <option value="algerian">Algerian</option>
                                <option value="american">American</option>
                                <option value="andorran">Andorran</option>
                                <option value="angolan">Angolan</option>
                                <option value="antiguans">Antiguans</option>
                                <option value="argentinean">Argentinean</option>
                                <option value="armenian">Armenian</option>
                                <option value="australian">Australian</option>
                                <option value="austrian">Austrian</option>
                                <option value="azerbaijani">Azerbaijani</option>
                                <option value="bahamian">Bahamian</option>
                                <option value="bahraini">Bahraini</option>
                                <option value="bangladeshi">Bangladeshi</option>
                                <option value="barbadian">Barbadian</option>
                                <option value="barbudans">Barbudans</option>
                                <option value="batswana">Batswana</option>
                                <option value="belarusian">Belarusian</option>
                                <option value="belgian">Belgian</option>
                                <option value="belizean">Belizean</option>
                                <option value="beninese">Beninese</option>
                                <option value="bhutanese">Bhutanese</option>
                                <option value="bolivian">Bolivian</option>
                                <option value="bosnian">Bosnian</option>
                                <option value="brazilian">Brazilian</option>
                                <option value="british">British</option>
                                <option value="bruneian">Bruneian</option>
                                <option value="bulgarian">Bulgarian</option>
                                <option value="burkinabe">Burkinabe</option>
                                <option value="burmese">Burmese</option>
                                <option value="burundian">Burundian</option>
                                <option value="cambodian">Cambodian</option>
                                <option value="cameroonian">Cameroonian</option>
                                <option value="canadian">Canadian</option>
                                <option value="cape verdean">Cape Verdean</option>
                                <option value="central african">Central African</option>
                                <option value="chadian">Chadian</option>
                                <option value="chilean">Chilean</option>
                                <option value="chinese">Chinese</option>
                                <option value="colombian">Colombian</option>
                                <option value="comoran">Comoran</option>
                                <option value="congolese">Congolese</option>
                                <option value="costa rican">Costa Rican</option>
                                <option value="croatian">Croatian</option>
                                <option value="cuban">Cuban</option>
                                <option value="cypriot">Cypriot</option>
                                <option value="czech">Czech</option>
                                <option value="danish">Danish</option>
                                <option value="djibouti">Djibouti</option>
                                <option value="dominican">Dominican</option>
                                <option value="dutch">Dutch</option>
                                <option value="east timorese">East Timorese</option>
                                <option value="ecuadorean">Ecuadorean</option>
                                <option value="egyptian">Egyptian</option>
                                <option value="emirian">Emirian</option>
                                <option value="equatorial guinean">Equatorial Guinean</option>
                                <option value="eritrean">Eritrean</option>
                                <option value="estonian">Estonian</option>
                                <option value="ethiopian">Ethiopian</option>
                                <option value="fijian">Fijian</option>
                                <option value="filipino">Filipino</option>
                                <option value="finnish">Finnish</option>
                                <option value="french">French</option>
                                <option value="gabonese">Gabonese</option>
                                <option value="gambian">Gambian</option>
                                <option value="georgian">Georgian</option>
                                <option value="german">German</option>
                                <option value="ghanaian">Ghanaian</option>
                                <option value="greek">Greek</option>
                                <option value="grenadian">Grenadian</option>
                                <option value="guatemalan">Guatemalan</option>
                                <option value="guinea-bissauan">Guinea-Bissauan</option>
                                <option value="guinean">Guinean</option>
                                <option value="guyanese">Guyanese</option>
                                <option value="haitian">Haitian</option>
                                <option value="herzegovinian">Herzegovinian</option>
                                <option value="honduran">Honduran</option>
                                <option value="hungarian">Hungarian</option>
                                <option value="icelander">Icelander</option>
                                <option value="indian">Indian</option>
                                <option value="indonesian">Indonesian</option>
                                <option value="iranian">Iranian</option>
                                <option value="iraqi">Iraqi</option>
                                <option value="irish">Irish</option>
                                <option value="israeli">Israeli</option>
                                <option value="italian">Italian</option>
                                <option value="ivorian">Ivorian</option>
                                <option value="jamaican">Jamaican</option>
                                <option value="japanese">Japanese</option>
                                <option value="jordanian">Jordanian</option>
                                <option value="kazakhstani">Kazakhstani</option>
                                <option value="kenyan">Kenyan</option>
                                <option value="kittian and nevisian">Kittian and Nevisian</option>
                                <option value="kuwaiti">Kuwaiti</option>
                                <option value="kyrgyz">Kyrgyz</option>
                                <option value="laotian">Laotian</option>
                                <option value="latvian">Latvian</option>
                                <option value="lebanese">Lebanese</option>
                                <option value="liberian">Liberian</option>
                                <option value="libyan">Libyan</option>
                                <option value="liechtensteiner">Liechtensteiner</option>
                                <option value="lithuanian">Lithuanian</option>
                                <option value="luxembourger">Luxembourger</option>
                                <option value="macedonian">Macedonian</option>
                                <option value="malagasy">Malagasy</option>
                                <option value="malawian">Malawian</option>
                                <option value="malaysian">Malaysian</option>
                                <option value="maldivan">Maldivan</option>
                                <option value="malian">Malian</option>
                                <option value="maltese">Maltese</option>
                                <option value="marshallese">Marshallese</option>
                                <option value="mauritanian">Mauritanian</option>
                                <option value="mauritian">Mauritian</option>
                                <option value="mexican">Mexican</option>
                                <option value="micronesian">Micronesian</option>
                                <option value="moldovan">Moldovan</option>
                                <option value="monacan">Monacan</option>
                                <option value="mongolian">Mongolian</option>
                                <option value="moroccan">Moroccan</option>
                                <option value="mosotho">Mosotho</option>
                                <option value="motswana">Motswana</option>
                                <option value="mozambican">Mozambican</option>
                                <option value="namibian">Namibian</option>
                                <option value="nauruan">Nauruan</option>
                                <option value="nepalese">Nepalese</option>
                                <option value="new zealander">New Zealander</option>
                                <option value="ni-vanuatu">Ni-Vanuatu</option>
                                <option value="nicaraguan">Nicaraguan</option>
                                <option value="nigerien">Nigerien</option>
                                <option value="north korean">North Korean</option>
                                <option value="northern irish">Northern Irish</option>
                                <option value="norwegian">Norwegian</option>
                                <option value="omani">Omani</option>
                                <option value="pakistani">Pakistani</option>
                                <option value="palauan">Palauan</option>
                                <option value="panamanian">Panamanian</option>
                                <option value="papua new guinean">Papua New Guinean</option>
                                <option value="paraguayan">Paraguayan</option>
                                <option value="peruvian">Peruvian</option>
                                <option value="polish">Polish</option>
                                <option value="portuguese">Portuguese</option>
                                <option value="qatari">Qatari</option>
                                <option value="romanian">Romanian</option>
                                <option value="russian">Russian</option>
                                <option value="rwandan">Rwandan</option>
                                <option value="saint lucian">Saint Lucian</option>
                                <option value="salvadoran">Salvadoran</option>
                                <option value="samoan">Samoan</option>
                                <option value="san marinese">San Marinese</option>
                                <option value="sao tomean">Sao Tomean</option>
                                <option value="saudi">Saudi</option>
                                <option value="scottish">Scottish</option>
                                <option value="senegalese">Senegalese</option>
                                <option value="serbian">Serbian</option>
                                <option value="seychellois">Seychellois</option>
                                <option value="sierra leonean">Sierra Leonean</option>
                                <option value="singaporean">Singaporean</option>
                                <option value="slovakian">Slovakian</option>
                                <option value="slovenian">Slovenian</option>
                                <option value="solomon islander">Solomon Islander</option>
                                <option value="somali">Somali</option>
                                <option value="south african">South African</option>
                                <option value="south korean">South Korean</option>
                                <option value="spanish">Spanish</option>
                                <option value="sri lankan">Sri Lankan</option>
                                <option value="sudanese">Sudanese</option>
                                <option value="surinamer">Surinamer</option>
                                <option value="swazi">Swazi</option>
                                <option value="swedish">Swedish</option>
                                <option value="swiss">Swiss</option>
                                <option value="syrian">Syrian</option>
                                <option value="taiwanese">Taiwanese</option>
                                <option value="tajik">Tajik</option>
                                <option value="tanzanian">Tanzanian</option>
                                <option value="thai">Thai</option>
                                <option value="togolese">Togolese</option>
                                <option value="tongan">Tongan</option>
                                <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                <option value="tunisian">Tunisian</option>
                                <option value="turkish">Turkish</option>
                                <option value="tuvaluan">Tuvaluan</option>
                                <option value="ugandan">Ugandan</option>
                                <option value="ukrainian">Ukrainian</option>
                                <option value="uruguayan">Uruguayan</option>
                                <option value="uzbekistani">Uzbekistani</option>
                                <option value="venezuelan">Venezuelan</option>
                                <option value="vietnamese">Vietnamese</option>
                                <option value="welsh">Welsh</option>
                                <option value="yemenite">Yemenite</option>
                                <option value="zambian">Zambian</option>
                                <option value="zimbabwean">Zimbabwean</option>
                            </select>
                        </fieldset> <br>
                        <fieldset class="field1">
                            <legend class="legend1">Address</legend>
                            <input class="input1" type="text" id="address" name="address" placeholder="Enter your Passport Number">
                        </fieldset> <br>
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">First Name</legend>
                        <input class="input1" type="text" id="firstname" name="firstname" placeholder="Enter your Name">
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Last name</legend>
                        <input class="input1" type="text" id="lastname" name="lastname" placeholder="Enter your Surname">
                    </fieldset> <br>
                    <fieldset class="field2">
                        <legend class="legend1">Sex</legend>
                        <select class="input2" name="sex" id="sex">
                            <option value="">--select one--</option>
                            <option value="F">Female</option>
                            <option value="M">Male</option>
                            <option value="O">Other</option>
                        </select>
                    </fieldset> <br>
                    <fieldset class="field2">
                        <legend class="legend1">Date of Birth</legend>
                        <input class="input1" type="date" id="date" name="date">
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Phone</legend> <!-- to be converted to tel -->
                        <input class="input1" type="text" id="phone" name="phone" placeholder="Enter your Phone Number">
                    </fieldset> <br>
                    <fieldset class="field1">
                        <legend class="legend1">Email</legend>
                        <input class="input1" type="email" id="email" name="email" placeholder="Enter your Email Address">
                    </fieldset> <br>
                </fieldset>
                <fieldset class="btnbox"> 
                    <input class="button1" type="submit" name="submit" value="Proceed"/>
                </fieldset>
            </div>
        </form>
        <?php }
            else {
                echo " <div class='div-2'> You're not supposed to be here. (Go book ticket!) </div>";
            }
        ?>
    </body>
</html>
