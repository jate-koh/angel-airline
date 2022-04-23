<?php
    $PassportNo = $_POST['passportno'];
    $FirstName = $_POST['firstname'];
    $SurName = $_POST['lastname'];
    $DOB = $_POST['date'];
    $Sex = $_POST['sex'];
    $Phone = $_POST['phone'];
    $Address = $_POST['address'];
    $Email = $_POST['email'];
    $Nationality = $_POST['nationality'];
    $PassportExp = $_POST['passportexp'];

    //Database Connection
    $conn = new mysqli('localhost','a9_cpe231_a9','jk17jk17','a9_Angel_Airline');
    if($conn -> connect_error) {
        die('Connection Failed : '.$conn -> connect_error);
    }
    else {
        //$statement = $conn -> prepare("insert into passenger(passportno,firstname,lastname,date,sex,phone,address,email,nationality,passportexp)
        //value(?,?,?,?,?,?,?,?,?,?)");
        //$statement -> bind_param("ssssssssss",$PassportNo,$FirstName,$SurName,$DOB,$Sex,$Phone,$Address,$Email,$Nationality,$PassportExp);
        //$statement -> execute();
        echo "success.";
    }
?>