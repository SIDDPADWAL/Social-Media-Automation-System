<?php
$error="";
$show="display:none;";
include("conn.php");
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if(isset($_SESSION['login_user']))
{
	header("Location:./index.php");
	exit;
}
if(isset($_POST['submitlogin'])){
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$myusername=test_input($_POST['txtuname']); 
		$mypassword=test_input($_POST['inputPassword']); 
		$status=0;
		$sql="SELECT * FROM end_user WHERE eumob='$myusername' AND eupass='$mypassword' AND eustatus!=0";
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				$mob=$row['eumob'];
				$pass=$row['eupass'];
				$status=$row['eustatus'];
			}
			if($mob==$myusername && $pass==$mypassword && $status!=0)
			{
				$_SESSION['login_user']=$mob;
				$_SESSION['login_user_pass']=$pass;
				header("location:./index.php");
				exit();
			}
			else{
				$error="Login Name or Password is invalid";
				$show="display:show;";
			}
		}
		else{
			$error="Login Name or Password is invalid";
			$show="display:show;";
		}
	}
}
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
<!DOCTYPE html>
<html>

<!-- Mirrored from gambolthemes.net/workwise-new/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Mar 2023 05:38:52 GMT -->
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>
<body class="sign-in">
<div class="wrapper">
<div class="sign-in-page">
<div class="signin-popup">
<div class="signin-pop">
<div class="row">
<div class="col-lg-6">
<div class="cmp-info">
<div class="cm-logo">
<img src="images/cm-logo.png" alt="">
<p>Workwise, is a global social media platform and social networking where businesses and independent professionals connect and collaborate remotely</p>
</div>
<img src="images/cm-main-img.png" alt="">
</div>
</div>
<div class="col-lg-6">
<div class="login-sec">
<ul class="sign-control">
<li data-tab="tab-1" class="current"><a href="#" title="">Sign in</a></li>
<!--<li data-tab="tab-2"><a href="#" title="">Sign up</a></li>-->
</ul>
<div class="sign_in_sec current" id="tab-1">
<h3>Sign in</h3>
<div class="alert alert-danger" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
<form method="Post" action="">
<div class="row">
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="text" name="txtuname" placeholder="Username">
<i class="la la-user"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="password" name="inputPassword" placeholder="Password">
<i class="la la-lock"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="checky-sec">
<div class="fgt-sec">
<input type="checkbox" name="cc" id="c1">
<label for="c1">
<span></span>
</label>
<small>Remember me</small>
</div>
<a href="#" title="">Forgot Password?</a>
</div>
</div>
<div class="col-lg-12 no-pdd">
<button type="submit" name="submitlogin" value="submit">Sign in</button>
</div>
</div>
</form>

</div>
<div class="sign_in_sec" id="tab-2">
<div class="signup-tab">
<i class="fa fa-long-arrow-left"></i>
<h2><a href="https://gambolthemes.net/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="7e141116101a111b3e1b061f130e121b501d1113">[email&#160;protected]</a></h2>
<ul>
<li data-tab="tab-3" class="current"><a href="#" title="">User</a></li>
<li data-tab="tab-4"><a href="#" title="">Company</a></li>
</ul>
</div>
<div class="dff-tab current" id="tab-3">
<form>
<div class="row">
<div class="col-lg-12 no-pdd">
<div class="sn-field"> 
<input type="text" name="name" placeholder="Full Name">
<i class="la la-user"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="text" name="country" placeholder="Country">
<i class="la la-globe"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<select>
<option>Category</option>
<option>Category 1</option>
<option>Category 2</option>
<option>Category 3</option>
<option>Category 4</option>
</select>
<i class="la la-dropbox"></i>
<span><i class="fa fa-ellipsis-h"></i></span>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="password" name="password" placeholder="Password">
<i class="la la-lock"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="password" name="repeat-password" placeholder="Repeat Password">
<i class="la la-lock"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="checky-sec st2">
<div class="fgt-sec">
<input type="checkbox" name="cc" id="c2">
<label for="c2">
<span></span>
</label>
<small>Yes, I understand and agree to the workwise Terms & Conditions.</small>
</div>
</div>
</div>
<div class="col-lg-12 no-pdd">
<button type="submit" value="submit">Get Started</button>
</div>
</div>
</form>
</div>
<div class="dff-tab" id="tab-4">
<form>
<div class="row">
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="text" name="company-name" placeholder="Company Name">
<i class="la la-building"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="text" name="country" placeholder="Country">
<i class="la la-globe"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="password" name="password" placeholder="Password">
<i class="la la-lock"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="sn-field">
<input type="password" name="repeat-password" placeholder="Repeat Password">
<i class="la la-lock"></i>
</div>
</div>
<div class="col-lg-12 no-pdd">
<div class="checky-sec st2">
<div class="fgt-sec">
<input type="checkbox" name="cc" id="c3">
<label for="c3">
<span></span>
</label>
<small>Yes, I understand and agree to the workwise Terms & Conditions.</small>
</div>
</div>
</div>
<div class="col-lg-12 no-pdd">
<button type="submit" value="submit">Get Started</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footy-sec">
<div class="container">
<ul>
<li><a href="help-center.html" title="">Help Center</a></li>
<li><a href="about.html" title="">About</a></li>
<li><a href="#" title="">Privacy Policy</a></li>
<li><a href="#" title="">Community Guidelines</a></li>
<li><a href="#" title="">Cookies Policy</a></li>
<li><a href="#" title="">Career</a></li>
<li><a href="forum.html" title="">Forum</a></li>
<li><a href="#" title="">Language</a></li>
<li><a href="#" title="">Copyright Policy</a></li>
</ul>
<p><img src="images/copy-icon.png" alt="">Copyright 2019</p>
</div>
</div>
</div>
</div>
<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>

<!-- Mirrored from gambolthemes.net/workwise-new/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Mar 2023 05:38:57 GMT -->
</html>