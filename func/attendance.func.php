<?php
    include("database-connect.func.php");
    session_start();
    
    if(isset($_POST['clockin'])) {
        $staffid = $_SESSION['staffid'];
        $datetime = $_POST['currentdate'];
        $date = date('Y-m-d',strtotime($datetime));

        $query1 ="SELECT * FROM `time attendance`
        WHERE StaffID = ? 
        AND Time_IN IS NOT NULL
        AND Time_OUT IS NULL;";

        $stmt1 = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt1,$query1);
        mysqli_stmt_bind_param($stmt1,"s",$staffid);
        mysqli_stmt_execute($stmt1);
        $check = mysqli_stmt_get_result($stmt1);

        if(mysqli_fetch_assoc($check)) {
            header("location:../back.attendance.php?fail=1");
            mysqli_stmt_close($stmt1);
            exit();
        }
        else {
            $query2 = "INSERT INTO `time attendance` (`StaffID`, `Date`, `Time_IN`, `Time_OUT`, `Count_Hour`) 
            VALUES (?,?,?, NULL, NULL)";
            $stmt2 = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt2,$query2);
            mysqli_stmt_bind_param($stmt2,"sss",$staffid,$date,$datetime);
            mysqli_stmt_execute($stmt2);
             
            header("location:../back.attendance.php");
            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);
            exit();
        }
    }
    else if(isset($_POST['clockout'])) {
        $staffid = $_SESSION['staffid'];
        $datetime = $_POST['currentdate'];
        $date = date('Y-m-d',strtotime($datetime));
        
        $query1 ="SELECT * FROM `time attendance`
        WHERE StaffID = '{$staffid}'
        AND Time_IN IS NOT NULL
        AND Time_OUT IS NULL;";
        $result1 = mysqli_query($conn,$query1);
        $row1 = mysqli_fetch_array($result1);

        if(!$row1) {
            header("location:../back.attendance.php?fail=2");
            mysqli_stmt_close($stmt1);
            exit();
        }
        else {
            $duration = round((strtotime($datetime) - strtotime($row1['Time_IN']))/3600, 1);
            
            $query2 = "UPDATE `time attendance` 
            SET `Time_OUT` = '{$datetime}', `Count_Hour` = '{$duration}'
            WHERE `StaffID` = '{$staffid}' 
            AND Time_OUT IS NULL;";
            mysqli_query($conn,$query2);


            /* Accumulate Human Resources */
            $query3 ="SELECT * FROM `human resources`
            WHERE StaffID = '{$staffid}';";
            $result3 = mysqli_query($conn,$query3);
            $row3 = mysqli_fetch_array($result3);
            $newsum = $row3['Work_Hour'] + $duration;

            $query4 = "UPDATE `human resources` 
            SET `Work_Hour` = '{$newsum}'
            WHERE `StaffID` = '{$staffid}';";
            mysqli_query($conn,$query4);

            /* Check Bonus */
            $query5 ="SELECT * FROM `human resources`
            WHERE StaffID = '{$staffid}';";
            $result5 = mysqli_query($conn,$query5);
            $row5 = mysqli_fetch_array($result5);

            if($row5['Work_Hour'] > 50*ceil($row5['Work_Hour']/50)) {
                $bonus = $row5['Bonus'] + 0.05;
                $query5 = "UPDATE `human resources` 
                SET `Bonus` = '{$bonus}'
                WHERE `StaffID` = '{$staffid}';";
                mysqli_query($conn,$query5);
            }

            header("location:../back.attendance.php");
            exit();
        }
    }
    else {
        echo "You're not supposed to be here (Staff only!)";
    }

?>