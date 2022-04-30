<?php
    $conn = new mysqli('localhost','root','','a9_Angel_Airline');
    if($conn -> connect_error) {
        die('connection failed. '.$conn -> connect_error);
    }
?>