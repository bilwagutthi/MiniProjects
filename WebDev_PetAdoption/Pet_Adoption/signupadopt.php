<!DOCTYPE HTML>
<html>
    <head>
        <link href="stylecss/navbar.css" rel="stylesheet" >
        <link href="stylecss/style.css" rel="stylesheet" >
        <link href="stylecss/footer.css" rel="stylesheet" id="bootstrap-css">


    </head>
    <body>
        <?php include "navbar.php";?>
        <form class= "logcont" action="signupadoptaction.php" method="post">
            <label  style="font-size:20px;padding:1em;text-decoration-line: underline;"> 
                Enter organization deatils
            </label>
            <label for="name"> Organiztion Name </label> 
            <input type="text" name="name" placehoder="Name" requied/>
            <label for="email"> Email </label> 
            <input type="email" name="email" placehoder="E-mail"requied/>
            <label for="pswd"> Password </label> 
            <input type="password" name="pswd" placehoder="Password"requied/>
            <label for="pswd_r"> Repeat Password </label> 
            <input type="password" name="pswd_r" placehoder="Repeat Password"requied/>
            <label for="phone"> Phone number </label> 
            <input type="tel" name="phone" placehoder="Repeat Password" requied/>
            <label for="address"> Address </label> 
            <input type="text" name="Address" placehoder="Repeat Password" requied/>
            <label for="logo"> Organization Logo </label> 
            <input type="file" name="image" placehoder="Upload Logo" requied/>
            
            <button type="submit" name="submit">Sign Up</button>
        </form>

        <?php include "footer.php";?>
    </body>
</html>