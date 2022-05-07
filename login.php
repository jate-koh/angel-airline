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
        <title>Staff Login</title>
        <link rel="icon" type="image/x-icon" href="img\wingicon.ico" />
        <link rel="stylesheet" type="text/css" href="styles\menubar.css">
        <link rel="stylesheet" type="text/css" href="styles\form.css">
        <link rel="stylesheet" href="styles\bg2-1.css"> <!-- Apply Bg Image -->
        <script> 
            $(function(){
                $("#menu").load("menu.html"); 
            });
        </script> 
    </head>
    <body class="active">

        <div id="menu"></div>
    
        <!-- Content -->
        <div class="div-1">
            <div>
                <h1>Log In</h1>
            </div> <br>
            <form action="login-process.php" method="POST">
                <div class="form_group field">
                    <input type="input" class="form__field" placeholder="Username" name="username" id='username' required />
                    <label for="name" class="form__label">Username</label> 
                </div> <br>
                <div class="form_group field">
                    <input type="password" class="form__field" placeholder="Password" name="password" id='password' required />
                    <label for="name" class="form__label">Password</label>
                </div> <br>
                <div>
                    <fieldset class="btnbox">
                        <input class="button1" type="submit" name="submit" value="Login"/>
                    </fieldset>
                </div>
            </form>
        </div>
    </body>
</html>