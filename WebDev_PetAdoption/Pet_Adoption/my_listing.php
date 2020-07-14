<?php
session_start();
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
<?php
    
    $email=$_SESSION['email'];
    $db=mysqli_connect("localhost","root","","findahome");
    $sql= "SELECT * FROM  `pet_user` WHERE email='".$email."'";
    $result="";
    $result=mysqli_query($db,$sql);
    $rows=mysqli_num_rows($result);
    if($rows>0)
      {
        echo '<div class="result">';
        while($row=mysqli_fetch_assoc($result))
          {
          echo '<div class="animal">                  
                  <div><img src="pet_images/'.$row['img'].'"></div>
                  <div> Name :'.$row['name'].'</div>
                  <div>Animal:'.$row['animal'].'</div>
                  <div>Breed :'.$row['breed'].'</div>
                  <div>Sex   :'.$row['sex'].'</div>
                  <div>D.O.B:'.$row['dob'].'</div>
                  <div>Owner:'.$row['owner'].'</div>
                  <div>Phone:'.$row['tel'].'</div>
                  <div>Address:'.$row['address'].'</div>
                  <div>Extra notes:'.$row['notes'].'</div> 
                  <div>
                    <form method="post" action="delete.php">
                      <input type="hidden" name="pid" value='.$row['pid'].'/>
                      <input type="hidden" name="img" value='.$row['img'].'/>
                      <button type="submit" name="delete">DELETE</button>  
                    </form>
                  </div>      
                </div>';
          }
        echo '</div>'; 
      }

      else {
          echo "You have no posts";
      }

?>
 <?php include 'footer.php';?>
</body>
</html>