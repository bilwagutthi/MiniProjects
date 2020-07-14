<?php

if(isset($_POST['delete']))
    {
    $db=mysqli_connect("localhost","root","","findahome");
    $pid=$_POST['pid'];
    $img=$_POST['img'];
    $path="pet_images//dog";
    $sql="DELETE FROM pet_user WHERE pid='$pid'";
    if(mysqli_query($db,$sql))
        {
        echo "<script>alert('DELETETED POST');</script>";
        if(!unlink($path))
            {
            echo "<script>alert('Could not delete main photo');</script>";
            }
        header('Location:my_listing.php');
        }
    else
        {
            echo "<script>alert('Unable to deltele post".mysqli_error($db)."');</script>";
        }
    }

?>