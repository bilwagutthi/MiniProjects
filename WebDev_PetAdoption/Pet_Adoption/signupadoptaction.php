<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$phone="";
$address="";
$logo="";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'findahome');

// REGISTER USER
if (isset($_POST['submit'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['pswd']);
  $password_2 = mysqli_real_escape_string($db, $_POST['pswd_r']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $username = mysqli_real_escape_string($db, $_POST['name']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM adoption WHERE 'password'='$password_1' OR 'email'='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $row = mysqli_fetch_assoc($result);
  
  if ($row) { // if user exists
    if ($row['password'] === $password_1) {
      array_push($errors, "Password already exists");
    }

    if ($row['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  if(isset($_FILES['image'])){
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
    
    if(in_array($file_ext,$extensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
       $errors[]='File size must be excately 2 MB';
    }
    
    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"logo/".$file_name);
       echo "Success";
       $logo=$file_name;
       
    }else{
       print_r($errors);
    }
 }


  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO adoption (name, email, password,logo,status,phone,address) 
  			  VALUES('$username', '$email', '$password','$logo','$status','$phone','$address')";
  	mysqli_query($db, $query);
    $_SESSION['email'] = $email;
    $_SESSION['status'] = 1;
    $_SESSION['user']='org';
  	header('location: index.php');
  }
}