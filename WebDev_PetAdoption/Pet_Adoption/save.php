<?php
  session_start();
  $db=mysqli_connect("localhost","root","","findahome");
  if(isset($_POST['save']))
    {
    $email=$_SESSION['email'];
    $pid=$_POST['pid'];
    $stmt=mysqli_stmt_init($db);
    $sql="INSERT INTO saved values(?,?)";
    if(mysqli_stmt_prepare($stmt,$sql))
        {
        mysqli_stmt_bind_param($stmt,"ss",$email,$pid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "<script>alert('Successfully saved');</script>";
        header("Location:saved.php");
        }
    else
        {
            echo "<script>alert('Unable to Save".mysqli_error($db)."');</script>";
        }
    }


?>