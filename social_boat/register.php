<?php
$error="";
  $show="display:none;";
  $alert="";
include("conn.php");
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if(isset($_SESSION['login_teacher']))
{
	header("Location:./dashboard.php");
	exit;
}
	if (isset($_GET['delalert'])) {
	  $errorv="Staff Member	 No ".$_GET['delalert']." Is Deleted successfully!";
			$showv="display:show;";
			$alertv="alert alert-success";
	  }
	  if (isset($_GET['delfail'])) {
		$errorc="Password Invalid ! Transaction Is Not Deleted Try Again !";
		//$errorc='<b>'.$cname.'</b>'." "."Customer Name Is Not Exist!";
		$showc="display:show;";
		$alertc="alert alert-danger";
	  }
	// define variables and set to empty values
		  $error="";
		  $show="display:none;";
		  $alert="";
		if (isset($_GET['error'])) {
		  $error=$_GET['error'];
		  $show=$_GET['show'];
		  $alert=$_GET['alert'];
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
 <title>Create New Account</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      function validation(){
      var counter=0;
      var f1 = document.getElementById("ac_no").value;
      var f2 = document.getElementById("conf_ac_no").value;
      //var r= parseFloat(f1)*parseFloat(f2);
      if(f1==f2)
      {
          document.getElementById("msg").innerHTML="Password Is Match";
          document.getElementById("ac_no").style.borderColor = "#008000";
          document.getElementById("conf_ac_no").style.borderColor = "#008000";
		  return true;
      }
      else
      {
        document.getElementById("msg").innerHTML="Password Is Not Match";
        document.getElementById("ac_no").style.borderColor = "#E34234";
        document.getElementById("conf_ac_no").style.borderColor = "#E34234";
		return false;
      }
   }
  </script>
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
        <li class="active"><a href="./login.php">Login</a></li>
      </ul>
     <!-- <ul class="nav navbar-nav navbar-right">    
        <li>
          <a href="./signup.php"><span class="glyphicon glyphicon-user"></span> Signup</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>-->
    </div>
  </div>
</nav>
<div class="container" style="margin-top:20px">
	<div class="row">
		<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
		<div class="panel panel-info">
		    <div class="panel-heading" style="background-color:#004c91;color:white" align="center"> Create New Account</div>
		    <div class="panel-body">
				<div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
				<form enctype="multipart/form-data" method="POST" action="./php_action/register.php" onsubmit="return validation()">
					<div class="row">
						<div class="col-md-6">			
						  <div class="form-group">
						  <label class="control-label">Enter Your Name</label>
							<input class="form-control" type="text" id="euname" name= "euname" placeholder="Enter Name" required>							
						  </div>
						  <div class="form-group">
						<label class="control-label">Mobile</label>
						<input class="form-control" type="number" id="eumob" name= "eumob" placeholder="Enter Mobile Number" required>
						</div>
						<div class="form-group">
						<label class="control-label">Password</label>
						<input class="form-control" type="password" id="eupass" name= "eupass" placeholder="Enter Password" required>
						</div>
					   <div class="form-group">
					   <label class="control-label">Email</label>
						<input class="form-control" type="text" id="email" name= "email" placeholder="Enter Email Id" required>
						</div>
						   
						</div> 
						<div class="col-md-6">												
						<div class="form-group">
						   <label class="control-label">Enter Date Of Birth</label>
							<input class="form-control" type="date" id="dob" name= "dob" placeholder="Date Of Birth" required>
						  </div>
							 <div class="form-group">
								<label class="control-label">Select Gender</label>
									<select class="form-control" name="gender" required>
										<option value="">Select Gender</option>
										<option value="Male">Male </option>
										<option value="Female">Female </option>
									</select>
							</div>
						<div class="form-group">
							<label class="control-label">Enter City</label>
							<input class="form-control" type="text" id="city" name= "city" placeholder="Enter City" required>
						</div>
						  <div class="form-group">
						  <label class="control-label">Profile Picture Photo</label>
						  <input class="form-control" name="userfile" type="file" />
						 </div>						
						</div>			
					</div>	
				  <div class="form-group" align="center">
					<button type="submit" class="btn btn-info" name="submitstaff">Create Account</button>
				  </div>
				</form>
			</div> <!-- Close panel Body -->
		</div> <!-- Close Panel -->
	</div> <!-- Close Row -->
</div> <!-- Close Container -->
<?php
include('footer.php');
?>
</body>
</html>