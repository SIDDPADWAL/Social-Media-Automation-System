<?php
include('./conn.php');
include('./lock.php');
$error="";
$show="display:none;";
$alert="";

?>
<!DOCTYPE html>
<html>

<!-- Mirrored from gambolthemes.net/workwise-new/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Mar 2023 05:34:27 GMT -->
<head>
<meta charset="UTF-8">
<title>Social World</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
<script type="text/javascript" src="./sss.js"></script>
</head>
<body>
<div class="wrapper">
<?php
include("./header.php");
?>
<main>
<div class="main-section">
<div class="container">
<div class="main-section-data">
<div class="row">
<div class="col-lg-3 col-md-4 pd-left-none no-pd">
<?php 
include("./side_nav.php");
?>
<div class="col-lg-9 col-md-12 no-pd">
<div class="main-ws-sec">
<?php
if (isset($_GET['euid'])) {	
	$euid=$_GET['euid'];
    $sql1="SELECT * FROM end_user WHERE eustatus=1 AND euid=$euid";
    $result = $conn->query($sql1);
      if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
		$euid = $row['euid'];
		$euname=$row['euname'];
		$eumob=$row['eumob'];
		$eupass=$row['eupass'];
		$email=$row['email'];
		$dob=$row['dob'];
		$gender=$row['gender'];
		$city=$row['city'];
		$imgpath=$row['imgpath'];
		$regdate=$row['regdate'];
		}
	  }
	}
	else{
		header('Location:index.php');
	}
		echo"<div class='posts-section'>
		<div class='post-bar'>
		<div class='post_topbar'>
		<div class='usy-dt'>
		<img src='../social_boat/".$imgpath."' height='70' width='70' alt=''>
		<div class='usy-name'>
		<a href='#'><h3>".$euname."</h3></a>
		<span><img src='images/clock.png' alt=''>".$regdate."</span>
		</div>
		</div>

		</div>
		<div class='epi-sec'>
		<ul class='descp'>
		<li><img src='images/icon9.png' alt=''><span>".$city."</span></li>
		</ul>
		</div>
		<div class='job_descp'>
		<h3> Email Id: ".$email."</h3>
		<h3> Mobile No: ".$eumob."</h3>
		<h3> Birth Date: ".$dob."</h3>
		<h3> Gender: ".$gender."</h3>
		</div>
		<div class='job-status-bar'>
		<ul class='like-com'>
		<li>
		<a href='#'><i class='fas fa-heart'></i> Like</a>

		</li>
		</ul>
		</div>
		</div>
		</div>";


?>

</div>
</div>

</div>
</div>
</div>
</div>
</main>
<?php
include("./footer.php");
?>

</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/scrollbar.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>

<!-- Mirrored from gambolthemes.net/workwise-new/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Mar 2023 05:35:50 GMT -->
</html>