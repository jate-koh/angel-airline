<?php
    $connection = new mysqli('localhost','root','','a9_Angel_Airline');
    if($connection -> connect_error) {
        die('connection failed. '.$connection -> connect_error);
    }
?>