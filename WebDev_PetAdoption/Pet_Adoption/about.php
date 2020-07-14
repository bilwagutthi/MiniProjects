<?php
 $connection=mysqli_connect("localhost","root","","findahome");

 session_start();

?>
<!DOCTYPE HTML>
<html>
<head>
<link href="stylecss/navbar.css" rel="stylesheet" >
<link href="stylecss/index.css" rel="stylesheet" >
<link href="stylecss/footer.css" rel="stylesheet" id="bootstrap-css">

</head>
<body>
<?php include 'navbar.php';?>


<h3> About Us </h3>
<p>
This website is developed to make it easier to find information about pets that are up for adoption.
<br>

With this website we hope that pet loves find new companiens 
and family members and beautiful animals find caring homes filled with love.
This website is in its initial version!
We would love to hear from you..
</p>
<?php include 'footer.php';?>
</body>
</html>