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
$sql = "SELECT * FROM post p, end_user eu WHERE eu.euid=p.euid AND p.post_status=1 ORDER BY post_id DESC";
$query = $conn->query($sql);
$result = $conn->query($sql);
  if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$totallikes=0;
		$sql="SELECT * FROM likes Where post_id=".$row['post_id']." AND status=1";
		$query = $conn->query($sql);
		$totallikes = $query->num_rows;
		echo"<div class='posts-section'>
		<div class='post-bar'>
		<div class='post_topbar'>
		<div class='usy-dt'>
		<img src='../social_boat/".$row['imgpath']."' height='70' width='70' alt=''>
		<div class='usy-name'>
		<a href='./view-profile.php?euid=".$row['euid']."'><h3>".$row['euname']."</h3></a>
		<span><img src='images/clock.png' alt=''>".$row['post_date']."</span>
		</div>
		</div>

		</div>
		<div class='epi-sec'>
		<ul class='descp'>
		<li><img src='images/icon9.png' alt=''><span>".$row['city']."</span></li>
		</ul>
		</div>
		<div class='job_descp'>
		<h3>".$row['post_desc']."</h3>";
		if($row['post_type']=="Photo"){
			echo"<img src='../social_boat/".$row['post_path']."' class='img-responsive'/>";
			}
			else if($row['post_type']=="Video"){
			echo"<video id='video1' width='250' controls>
				<source src='../social_boat/".$row['post_path']."' type='video/mp4'>
				<source src='../social_boat/".$row['post_path']."' type='video/ogg'>
				Your browser does not support HTML video.
			  </video>";
			}
			else if($row['post_type']=="Link"){
			echo"<a href='".$row['post_path']."' target='self'>".$row['post_path']."</a>";
		}
		echo"</div>
		<div class='job-status-bar'>
		<ul class='like-com'>
		<li>
		<a href='#' onclick='like(".$row['post_id'].")'><i class='fas fa-heart'></i> Like (".$totallikes.")</a>

		</li>
		</ul>
		<a href='./view-profile.php?euid=".$row['euid']."'><i class='fas fa-user'></i>View Profile </a>
		</div>
		</div>
		</div>";
	}
  }


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