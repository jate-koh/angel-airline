<?php
    function get_all_records() {
        include("database-crud.php");
        $stmt = $connection -> prepare("SELECT * FROM flight");
        $stmt -> execute();
        return $stmt -> rowCount();
    }
?>