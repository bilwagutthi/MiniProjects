<?php
// $connection=mysqli_connect("localhost","root","","findahome");
  session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Find a Home </title>
  <link href="stylecss/navbar.css" rel="stylesheet" >
  <link href="stylecss/style.css" rel="stylesheet" >
  <link href="stylecss/footer.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <?php include 'navbar.php';?>
  <div class="searchbar">
    <form method="post" action="search.php" >
      <input type="text" placeholder="Search.." name="search-text1">
      <button type="submit" name="search-submit1"><i class="fa fa-search"></i></button>
    </form>
  </div>

  <script>
    var i=0;
    var images=[];
    var time=2000;

    images[0]='images/slide1.jpg';
    images[1]='images/slide2.jpg';
    images[2]='images/slide3.jpg';
    images[3]='images/slide4.jpg';

    function changeImage()
        {
        document.slide.src=images[i];
        if(i<images.length-1)
            {
            i++;
            }
        else{
            i=0;
            }
    
        setTimeout("changeImage()",time);
        }
    window.onload=changeImage;
    
  </script>
  <img name="slide" width="100%" height="auto">
  
  <!--Displaying some pets-->
  <h1 style="color:teal;"> Find your new companion </h1>
  <?php
    $db=mysqli_connect("localhost","root","","findahome");
    $sql="SELECT * FROM `pet_user` LIMIT 9";
    $result=mysqli_query($db,$sql);
    $rows=mysqli_num_rows($result);
    if($rows>0)
      {
        echo '<div class="result">';
        while($row=mysqli_fetch_assoc($result))
          {
          echo '<div class="animal">                  
                  <div><img src="pet_images/'.$row['img'].'"></div>
                  <div> Name : '.$row['name'].'</div>
                  <div>Animal: '.$row['animal'].'</div>
                  <div>Breed : '.$row['breed'].'</div>
                  <div>Sex   : '.$row['sex'].'</div>
                  <div>D.O.B: '.$row['dob'].'</div>
                  <div>Owner: '.$row['owner'].'</div>
                  <div>Phone: '.$row['tel'].'</div>
                  <div>Address: '.$row['address'].'</div>
                  <div>Extra notes: '.$row['notes'].'</div>       
                </div>';
          }
        echo '</div>'; 
      }
  ?>



 <?php include 'footer.php';?>
</body>
</html>