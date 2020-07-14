<?php
    session_start();

    // Coonect to db
    $db = mysqli_connect('localhost', 'root', '', 'findahome');
    $email="";
    $password="";
    $owner="Unknown";
    $phone="Unavailable";
    $address="Unavailable";


    if (isset($_POST['submit'])) 
        {
        $email = mysqli_real_escape_string($db, $_SESSION['email']);
        $name = mysqli_real_escape_string($db, $_POST['pname']);
        $animal= mysqli_real_escape_string($db, $_POST['ptype']);
        $breed= mysqli_real_escape_string($db, $_POST['breed']);
        $dob= mysqli_real_escape_string($db, $_POST['pdob']);
        $sex= mysqli_real_escape_string($db, $_POST['sex']);
        $img="pet_images/petdefault.jpg";
        $notes= mysqli_real_escape_string($db, $_POST['pnotes']);
        $errors=array();
        
        // Setting contact feild
        if($_SESSION['user']=='user')
            {
            $phone= mysqli_real_escape_string($db, $_POST['phone']);
            $address= mysqli_real_escape_string($db, $_POST['address']);
            $sql="SELECT name from users where email='".$email."'";
            $result=mysqli_query($db,$sql);
            $row=mysqli_fetch_assoc($result);
            $owner=$row['name'];
            }
        else if ($_SESSION['user']=='org')
            {
            $sql="SELECT name,phone,address from adoption where email='".$email."' LIMIT 1";
            $result=mysqli_query($db,$sql);
            $rows=mysqli_num_rows($result);
            if($rows>0)
                {
                while($row=mysqli_fetch_assoc($result))
                    {
                    $owner=$row['name'];
                    $phone=$row['phone'];
                    $address=$row['address'];
                    }
                
                }
            }
        else
            {
            $owner="Unknown";
            $phone="Unavailable";
            $address="Unavailable";
            }

        // Setting image feild
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
                move_uploaded_file($file_tmp,"pet_images/".$file_name);
                echo "Success";
                $img=$file_name;
                $status=1;
                }
            else
                {
                print_r($errors);
                }
            }

        if (empty($phone))
            {
            array_push($errors, "Please enter some cantact information is required");
            }
        if (empty($animal))
            {
            array_push($errors, "Animal Feild is requird is required");
            }
        print_r($_FILES);
        if (count($errors) == 0)
            {
                $stmt=mysqli_stmt_init($db);
                $sql="INSERT INTO `pet_user`(email,name,animal,breed,sex,dob,img,notes,owner,tel,address)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                print($sql);
                if (mysqli_stmt_prepare($stmt,$sql))
                    {
                    // Bind parameters
                    mysqli_stmt_bind_param($stmt,"sssssssssss",$email,$name,$animal,$breed,$sex,$dob,$img,$notes,$owner,$phone,$address);
                
                    // Execute query
                    mysqli_stmt_execute($stmt);
                
                    // Bind result variables
                
                
                    // Fetch value
                    mysqli_stmt_fetch($stmt);
                    print_r($stmt);
                    // print($msg);
                
                    // Close statement
                    mysqli_stmt_close($stmt);
                    echo "<script>alert('Successfully posted');</script>";
                    header("Location:my_listing.php");
                    }
                else
                    {
                    //header("Location:post_listng.php");
                    echo "<script>alert('Unable to post posted');</script>";
                    } 
            }
    }
    
?>

<!DOCTYPE HTML>
<html>
<head>
<link href="stylecss/style.css" rel="stylesheet" >
<link href="stylecss/navbar.css" rel="stylesheet" >
<link href="stylecss/footer.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php include 'navbar.php';?>
    <div class="logcont">
        <form method="POST" action="" enctype="multipart/form-data">
            <h3> Enter animal details </h3>
            <label for="pname" > Pet name </label>
            <input type="text" name="pname" required/>
            <label for="ptype" > Pet Animal </label>
            <input type="text" name="ptype" required/>
            <label for="pdob" > Date of Birth </label>
            <input type="date" name="pdob" required/>
            <label for="image" > Upload Image</label>
            <input type="file" name="image" />
            <label for="breed" > Breed </label>
            <input type="text" name="breed" required/>
            <label for="sex" > Sex </label>
            <input type="radio" name="sex" value="Male" checked> Male
            <input type="radio" name="sex" value="Female"> Female
            <input type="radio" name="sex" value="Unknown"> Other  
            <?php

                if($_SESSION['user']=="user")
                    {
                    echo '
                    <label for="phone" > Phone no</label>
                    <input type="tel" name="phone"  required/>
                    <label for="phone" > Address </label>
                    <input type="textarea"  name="address"  required/>';
                }

            ?>
            <label for="Animal type" > Extra Notes </label>
            </br>
            <input type="textarea" name="pnotes"  />
            </br>

            <button type="submit" class="signupbtn" name="submit">Post</button>
        </form>
    </div>
<?php include 'footer.php';?>
</body>
</html>