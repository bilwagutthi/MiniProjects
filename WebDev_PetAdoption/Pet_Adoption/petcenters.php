<?php 
session_start();
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
    <div class="result">
        <?php
        
        $db = mysqli_connect('localhost', 'root', '', 'findahome');
        $sql="SELECT * FROM `adoption` ";
        $result=mysqli_query($db,$sql);
        $rows=mysqli_num_rows($result);
        while($row=mysqli_fetch_assoc($result))
          {
          echo '<div class="animal">
                    
                    <div><img src="logo/'.$row['logo'].'"></div>
                    <div> Name :'.$row['name'].'</div>
                    <div>Phone:'.$row['phone'].'</div>
                    <div>Address :'.$row['address'].'</div>
                </div>';
          }

        ?>
    </div>
<?php include 'footer.php';?>
</body>
</html>