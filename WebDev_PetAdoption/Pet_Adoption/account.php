<?php
session_start();
if(isset($_POST['submit']))
    {
    $email=$_SESSION['email'];
    $db=mysqli_connect("localhost","root","","findahome");
    $path="logo//";
    $newlogo=""
    if(isset($_FILES['image']))
            {
            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
            print_r($_FILES);
            $tmp=(explode('.',$file_name));
            $tmp=end($tmp);
            $file_ext=strtolower($tmp);
            $extensions= array("jpeg","jpg","png");
            
            if(in_array($file_ext,$extensions)=== false)
                {
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }
            
            if($file_size > 2097152)
                {
                $errors[]='File size must be excately 2 MB';
                }
            
            if(empty($errors)==true)
                {
                move_uploaded_file($file_tmp,"logo/".$file_name);
                echo "Success";
                $newlogo=$file_name;
                }
            else
                {
                print_r($errors);
                }
            

    $sql="UPDATE adoption SET logo='$newlogo' WHERE email='$email'";
    if(mysqli_query($db,$sql))
        {
        echo "<script>alert('Updated logo');</script>";
        header('Location:my_listing.php');
        }
    else
        {
            echo "<script>alert('Unable to deltele post".mysqli_error($db)."');</script>";
        }
    }}
?>
<!DOCTYPE HTML>
<html>
<head>
  <link href="stylecss/navbar.css" rel="stylesheet" >
  <link href="stylecss/style.css" rel="stylesheet" >
  <link href="stylecss/footer.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
<?php include 'navbar.php';?>
Update logo:
<form method="post" action="">
    <input type="file" name="image" />
    <button type="submit" name="submit">Update</button>  
</form>

 <?php include 'footer.php';?>
</body>
</html>