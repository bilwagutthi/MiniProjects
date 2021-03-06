<?php
session_start();

// initializing variables
$username = "";
$email    = "";
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
  $user_check_query = "SELECT * FROM users WHERE 'password'='$password_1' OR 'email'='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $row = mysqli_fetch_assoc($result);
  
  if ($row) { // if user exists
    if ($row['password'] === $password_1) {
      array_push($errors, "Username already exists");
    }

    if ($row['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (name, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
    $_SESSION['email'] = $email;
    $_SESSION['status'] = 1;
    $_SESSION['user']='user';
  	header('location: index.php');
  }
}

// ... 
