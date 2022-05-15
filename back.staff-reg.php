<?php
    session_start();
    include("database-connect.php");
    $sql = "SELECT * from `human resources`;";
    $choice = mysqli_query($conn,$sql);
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
        <title>Staff Register</title>
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
        <form action="func/reg.func.php" method="POST">
            <div class="div-2">
                    <fieldset class="field0">
                        <fieldset class="field1">
                            <legend class="legend1">Staff</legend>
                            <select class="input2" name="staff">
                                <?php while($row = mysqli_fetch_array($choice) ) { ?>
                                    <option value="<?php echo $row['StaffID']; ?>"> <?php echo $row['FirstName']; ?>, <?php echo $row['StaffID']; ?></option>
                                <?php } mysqli_data_seek($choice, 0); ?>
                            </select>
                        </fieldset> <br>
                        <fieldset class="field1">
                            <legend class="legend1">Username</legend>
                            <input class="input1" type=text name="user" placeholder="Enter username" required>
                        </fieldset>
                        <fieldset class="field1">
                            <legend class="legend1">Password</legend>
                            <input class="input1" type=password name="pw" placeholder="Enter password" required>
                        </fieldset>
                        <fieldset class="field1">
                            <legend class="legend1">Confirm Password</legend>
                            <input class="input1" type=password name="confirm_pw" placeholder="Repeat your password" required>
                        </fieldset>
                        <fieldset class="btnbox">
                            <?php   
                                if(isset($_SESSION["useruid"])) {
                                    echo '<input class="button1" type="submit" name="submit"/>';
                                }
                                else { 
                                    echo "You're not supposed to be here (Staff Only!)";
                                }
                            ?>
                        </fieldset>
                    </fieldset>
            </div>
        </form>
    </body>
</html>

<?php
    if(isset($_GET["error"])) {
        if($_GET['error'] === 'none') {
            echo "<script> alert('Success.') </script>";
        }
        else if($_GET['error'] === 'dupeuser') {
            echo "<script> alert('Please try different username.') </script>";
        }
        else if($_GET['error'] === 'unmatchpw') {
            echo "<script> alert('Password does not match.') </script>";
        }
        else if($_GET['error'] === 'no') {
            echo "<script> alert('PHP error') </script>";
        }
    } 
?>