<?php 
    include("database-connect.php");

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once 'func/login.func.php';

    if(emptyInput($username, $password) !== false ) {
        echo "empty"; //header("location:login.php?error=emptyinput");
        exit();
    }
    
    loginUser($conn,$username,$password);

}
else {
    header("location:login.php");
}
?>
