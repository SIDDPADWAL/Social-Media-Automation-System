<?php
$error="";
$show="display:none;";
include("conn.php");
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if(isset($_SESSION['login_user']))
{
	header("Location:./dashboard.php");
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
				header("location:./dashboard.php");
				exit();
			}
			else{
				$error="Your Login Name or Password is invalid";
				$show="display:show;";
			}
		}
		else{
			$error="Your Login Name or Password is invalid";
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
<html lang="en">
<head>
  <title> Social Media Automation System |  </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"> Social Media Boat Panel </a>
    </div>
    <div class="collapse navbar-collapse navbar-left" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="./register.php" disabled>Create New Account</a></li>
      </ul>
     <!-- <ul class="nav navbar-nav navbar-right">    
        <li>
          <a href="./signup.php"><span class="glyphicon glyphicon-user"></span> Signup</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>-->
    </div>
  </div>
</nav>
<div class="container" style="margin-top: 70px">
<div class="row">
<div class="col-md-4">
  <!--<img src="./images/diamond.jpg" class="img-responsive"/>-->
</div>
<div class = "col-md-4">
<div class="panel panel-info">
      <div class="panel-heading" align="center">Sign In</div>
      <div class="panel-body">
 <form data-toggle="validator" role="form" method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="form-group">
     <input class="form-control" type="text" id="txtuname" name= "txtuname" placeholder="Mobile Number" required>
    <div class="help-block with-errors"></div>
  </div>
  <div class="form-group">
   <input type="password" data-minlength="6" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
      <div class="help-block"></div>
  </div>
  <div class="form-group" align="center">
    <button type="submit" name="submitlogin" class="btn btn-info">Login</button>
  </div>
</form><hr/>
<h5><u><a href="./register.php" disabled>Create New Account</a></u></h5><hr/>
<p> If You Forgot Password? Or Not Account created?  So Please Contact Your Administrative Person.</p>
<!--<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>-->
<div class="alert alert-danger" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
</div> <!-- Close panel Body -->
</div> <!-- Close Panel -->
</div> <!-- Close Col -->
<div class="col-md-4">
</div>
</div> <!-- Close Row -->
</div> <!-- Close Container -->
<footer class="footer-default" style="position: absolute;  bottom: 0;  width: 100%;  height: 30px;  background-color: #f5f5f5;">
  <div class="container-fluid default">
    <p class="text-muted credit" align="center">Design & Developed By <a href="#"> Project Team</a> Copyrights &copy; 2023</p>
  </div>
</footer>
</body>
</html>