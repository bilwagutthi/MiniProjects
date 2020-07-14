<?php
session_start();
if(isset($_POST['savedelete']))
    {
    $db=mysqli_connect("localhost","root","","findahome");
    $pid=$_POST['pid'];
    $email=$_SESSION['email'];
    $path="pet_images//dog";
    $sql="DELETE FROM saved WHERE pid='$pid' AND email='$email'";
    if(mysqli_query($db,$sql))
        {
        echo "<script>alert('DELETETED POST');</script>";
        header('Location:saved.php');
        }
    else
        {
            echo "<script>alert('Unable to deltele post".mysqli_error($db)."');</script>";
        }
    }