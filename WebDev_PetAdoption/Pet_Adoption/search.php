<?php
 
 session_start();

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Search Results</title>
<link href="stylecss/navbar.css" rel="stylesheet" >
<link href="stylecss/style.css" rel="stylesheet" >
<link href="stylecss/footer.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>

<?php include 'navbar.php';?>

  <div class="searchbar">
    <form action="search.php" method="post">
      <input type="text"  placeholder="Find your companion" name="search-text2">
      <button type="submit" name="search-submit2"><i class="fa fa-search">Search</i></button>
    </form>
  </div>

<!--PHP to display results-->
<?php
  $db=mysqli_connect("localhost","root","","findahome");
  $results_per_page=2;
  if(isset($_POST['search-submit1']))
   {
    $search=mysqli_real_escape_string($db,$_POST['search-text1']);
    /*
    $sql1="SELECT * FROM `pet_user` WHERE animal LIKE '".$search."'";
    $result1=mysqli_query($db,$sql1);
    $totnumrows=mysqli_num_rows($result1);
    $totalpages=ceil($totnumrows/$results_per_page);
    $this_page_first_result=($page-1)*$results_per_page; */   
    $sql="SELECT * FROM `pet_user` 
          WHERE animal 
          LIKE '".$search."'
          OR breed LIKE '".$search."'
          OR sex LIKE '".$search."'
          OR `address` LIKE '".$search."'
          ";// LIMIT ".$this_page_first_result.",".$results_per_page;
    $result=mysqli_query($db,$sql);
    $rows=mysqli_num_rows($result);
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
      <div>Extra notes:'.$row['notes'].'</div>';
      if(isset($_SESSION['user']))
        {
        echo '
        <div>
          <form method="post" action="save.php">
            <input type="hidden" name="pid" value='.$row['pid'].'/>
            <button type="submit" name="save">Save</button>  
          </form>
        </div>';
        }

      echo        '</div>';
        }
    echo '</div>';
/*
    for($page=1;$page<=$totalpages;$page++)
     {
      echo '<a href="search.php?search-text1='.$search.'?page='.$page.'">'.$page.'</a>';
      
     }
*/     
    }
  else if(isset($_POST['search-submit2']))
    {
    $search=mysqli_real_escape_string($db,$_POST['search-text2']);
    $sql="SELECT * FROM `pet_user` WHERE animal LIKE '".$search."' OR breed LIKE'".$search."'";
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
          <div>Extra notes:'.$row['notes'].'</div>';
          if($_SESSION['user']=='user')
          {
          echo '
          <div>
            <form method="post" action="save.php">
              <input type="hidden" name="pid" value='.$row['pid'].'/>
              <input type="hidden" name="email" value='.$_SESSION['email'].'/>
              <button type="submit" name="save">Save</button>  
            </form>
          </div>';
          }

      echo        '</div>';
          }
        echo '</div>';
      }
    else
      {
      echo "No results";
      }
    }
  else
    {
    echo "No Results";
    }
?>


<?php include 'footer.php';?>
</body>
</html>