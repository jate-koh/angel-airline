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
        <form action="func/reg.func.php" method="POST">
            <div class="div-2">
                <fieldset class="field0">
                    <fieldset class="field1">
                        <legend class="legend1">Ticket ID</legend>
                        <input class="input1" type=text name="user" <?php echo "value=' ".$_POST['ticketID']." ' "?> readonly>
                    </fieldset>
                    <fieldset class="btnbox"> 
                        <input class="button1" type="submit" name="submit"/>
                    </fieldset>
                </fieldset>
            </div>
        </form>
    </body>
</html>
