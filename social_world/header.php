<?php ob_start(); ?>

 <?php
$login_session="" ;
 $url="";
 $status="";
 include('./lock.php');
?>
<?php ob_end_flush(); ?> 

<?php if($login_session)  
        {   
            $status=$login_session; 
            $url="#";
            $url1="./logout.php";
            $status1="Logout";  
        }
        else
        { 
            $status="Welcome Guest"; 
            $url1="./login.php";
			$url="#";
            $status1="Login"; 
         }
          
?>
<header>
<div class="container">
<div class="header-data">
<div class="logo">
<a href="index.php" title=""><img src="images/logo.png" alt=""></a>
</div>
<div class="search-bar">
<form>
<input type="text" name="search" placeholder="Search...">
<button type="submit"><i class="la la-search"></i></button>
</form>
</div>
<nav>
<ul>
<li>
<a href="index.php" title="">
<span><img src="images/icon1.png" alt=""></span>
Home
</a>
</li>
<li>
<a href="../index.php" title="">
<span><img src="images/icon2.png" alt=""></span>
Back To Website
</a>
</li>

</ul>
</nav>
<div class="menu-btn">
<a href="#" title=""><i class="fa fa-bars"></i></a>
</div>
<div class="user-account">
<div class="user-info">
<a href="<?php echo  $url; ?>" title=""><?php echo $status; ?></a>
<i class="la la-sort-down"> </i>
</div>
<div class="user-account-settingss" id="users">

<h3 class="tc"><a href="<?php echo  $url1; ?>" title=""> <?php echo $status1; ?></a></h3>
</div>
</div>
</div>
</div>
</header>