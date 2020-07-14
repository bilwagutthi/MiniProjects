
<?php
    session_start();
    $db = mysqli_connect('localhost', 'root', '', 'findahome');
    $email="";
    $password="";
    $errors = array(); 
       print_r($_POST);
       print_r($_SESSION);
    if (isset($_POST['login'])) 
        {
        $email = mysqli_real_escape_string($db, $_POST['user_email']);
        $password = mysqli_real_escape_string($db, $_POST['user_password']);
        
        if (empty($email))
            {
            array_push($errors, "Email is required");
            }
        if (empty($password))
            {
            array_push($errors, "Password is required");
            }
      
        if (count($errors) == 0)
            {
            $password = md5($password);
            $query = "SELECT * FROM adoption WHERE email='".$email."' AND password='".$password."'";
            print($query);
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1)
                {
                    $_SESSION['email']=$email;
                    $_SESSION['status'] = 1;
                    $_SESSION['user']='org';
                header('location: index.php');
                }
            else
                {
                array_push($errors, "Wrong username/password combination");
                }
            }
        }
    print_r($errors);

?>


<!DOCTYPE HTML>
<html>
<head>
<link href="stylecss/navbar.css" rel="stylesheet" >
<link href="stylecss/footer.css" rel="stylesheet" id="bootstrap-css">
<link href="stylecss/style.css" rel="stylesheet" >
</head>
<body>
    <?php
    print_r($_SESSION);
    include 'navbar.php';?>

    <div class="logcont">
        <form method="post" action="">
            <label style="font-size:20px;padding:1em;text-decoration-line: underline;">Adoption Centre Login </label>
            <label for="email"> Email </label>
            <input type="email" name="user_email" placeholder="Enter your email" />
            <label for="password"> Password </label>
            <input type="password" name="user_password" placeholder="Password" />
            <button type="submit" value="login" name="login">Login</button>
        </form>
    </div>
    <?php include 'footer.php'?>
</body>
</html>