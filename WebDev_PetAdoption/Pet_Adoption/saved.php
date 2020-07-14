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
<h3>Your saved listings</h3>
<?php
    
    $email=$_SESSION['email'];
    $db=mysqli_connect("localhost","root","","findahome");
    $sql= "SELECT pid FROM  `saved` WHERE email='".$email."'";
    $result="";
    $result=mysqli_query($db,$sql);
    $rows=mysqli_num_rows($result);
    if($rows>0)
      { 
        echo '<div class="result">';
        while($row2=mysqli_fetch_assoc($result))
            {
            
            $pid=$row2['pid'];
            
            $sql2="SELECT * FROM pet_user where pid='".$pid."' ";
            $result2="";
            $result2=mysqli_query($db,$sql2);
            $row=mysqli_fetch_assoc($result2);
           
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
                        <form method="post" action="saveddelete.php">
                            <input type="hidden" name="pid" value='.$row['pid'].'/>
                            <button  type="submit" name="savedelete">DELETE</button>  
                        </form>
                    </div>      
                </div>';
            }
            echo '</div>'; 
      }

      else {
          echo "You have not saved any listings";
      }

?>
 <?php include 'footer.php';?>
</body>
</html>