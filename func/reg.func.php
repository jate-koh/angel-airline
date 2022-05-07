<?php
    include("database-connect.func.php");
    
    if(isset($_POST["submit"])) {
        $staff = $_POST['staff'];
        $username = $_POST["user"];
        $password = $_POST["pw"];
        $confirm_pass = $_POST["confirm_pw"];

        if($password !== $confirm_pass) {
            header("location:../back.staff-reg.php?error=unmatchpw");
            exit();
        }

        require_once("../func/login.func.php");
        if(userExist($conn,$username) !== false) {
            header("location:../back.staff-reg.php?error=dupeuser");
            exit();
        }

        $hashPwd = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO login
        VALUES (NULL, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"sss",$staff,$username,$hashPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location:../back.staff-reg.php?error=none");
        exit();
    
    }
    else {
        header("location:../back.staff-reg.php?error=no");
        exit();
    }

?>