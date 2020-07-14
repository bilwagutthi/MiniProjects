<!DOCTYPE HTML>
<html>
    <head>
        <link href="stylecss/navbar.css" rel="stylesheet" >
        <link href="stylecss/style.css" rel="stylesheet" >
        <link href="stylecss/footer.css" rel="stylesheet" id="bootstrap-css">


    </head>
    <body>
        <?php include "navbar.php";?>
        <div class="logcont">
            <form  action="signupuseraction.php" method="post">
                <label style="font-size:20px;padding:1em;text-decoration-line: underline;">
                    User Sign Up
                </label>
                <label for="name"> Name </label>
                <input type="text" name="name" placehoder="Name" requied>
                <label for="email"> Email </label>
                <input type="email" name="email" placehoder="E-mail" required>
                <label for="pswd"> Password </label>
                <input type="password" name="pswd" placehoder="Password" required>
                <label for="pswd_r"> Repeat Password </label>
                <input type="password" name="pswd_r" placehoder="Repeat Password" required>
                <button type="submit" name="submit">Sign Up</button>
            </form>
        </div>    
        <?php include "footer.php";?>
    </body>
</html>