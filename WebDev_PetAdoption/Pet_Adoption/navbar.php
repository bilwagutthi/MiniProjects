<header>
Find  a   Home
</header>

  <div  class=" navbar"  >
    <a  href="index.php">Home</a>
    <a  href="about.php">About</a>
    <a  href="petcenters.php">Pet Adoption Centers</a>
<?php

if(isset($_SESSION['status'])==0){
  
?>
<!--If user is not logged in-->

    <div class="dropdown">
      <button class="dropbtn">Log-in/Sign-up
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="loginuser.php" >Log-in (User)</a>
        <a href="signupuser.php" >Sign Up (User)</a>
        <a href="loginadopt.php" >Log-in (Adoption-Centre)</a>
        <a href="signupadopt.php" >Sign Up (Adoption-Centre)</a>
      </div>
    </div>
  </div>



<?php
}
else{

?>
    <div class="dropdown">
    <button class="dropbtn">Account
      <i class="fa fa-caret-down"></i>
    </button>
      <div class="dropdown-content">
        <a href="saved.php" >Saved</a>
        <a href="post_listing.php" >Post a Listing</a>
        <a href="my_listing.php" >My Listings</a>
        <a href="logout.php" >Logout</a>
      </div>
    </div>
</div>

<?php
}
?>