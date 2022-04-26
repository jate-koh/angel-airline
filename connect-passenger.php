<?php
 //Database Connection
 $conn = new mysqli('localhost','a9_cpe231_a9','','a9_Angel_Airline');
 if($conn -> connect_error) {
    die('connection failed. '.$conn -> connect_error);
 }
 else {
    $PassportNo = mysqli_real_escape_string($conn,$_POST['passportno']);
    $FirstName =  mysqli_real_escape_string($conn,$_POST['firstname']);
    $SurName =  mysqli_real_escape_string($conn,$_POST['lastname']);
    $DOB =  mysqli_real_escape_string($conn,$_POST['date']);
    $Sex =  mysqli_real_escape_string($conn,$_POST['sex']);
    $Phone =  mysqli_real_escape_string($conn,$_POST['phone']);
    $Address =  mysqli_real_escape_string($conn,$_POST['address']);
    $Email =  mysqli_real_escape_string($conn,$_POST['email']);
    $Nationality =  mysqli_real_escape_string($conn,$_POST['nationality']);
    $PassportExp =  mysqli_real_escape_string($conn,$_POST['passportexp']);

    $sql= "INSERT INTO passenger(PassportNo,FirstName,SurName,DoB,Sex,Phone,Address,Email,Nationality,PassportExp)
    VALUES('$PassportNo','$FirstName','$SurName','$DOB','$Sex','$Phone','$Address','$Email','$Nationality','$PassportExp')";
    if(!mysqli_query($conn,$sql)) {
       die('error. '.mysqli_error($conn));
    }
    else {
        echo "success.";
    }
}
/*
        $statement = $conn -> prepare(
            "insert into passenger(passportno,firstname,lastname,date,sex,phone,address,email,nationality,passportexp)
            value(?,?,?,?,?,?,?,?,?,?)"
        );
        $statement -> bind_param("ssssssssss",$PassportNo,$FirstName,$SurName,$DOB,$Sex,$Phone,$Address,$Email,$Nationality,$PassportExp);
        $statement -> execute();
        echo "success.";
*/
?>

