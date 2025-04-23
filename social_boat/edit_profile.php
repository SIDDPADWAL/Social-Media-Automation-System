<?php
$error="";
$show="display:none;";
$alert="";
include('./lock.php');
include('./conn.php');
//fetch Company Details
$sql="SELECT * FROM end_user WHERE euid=$euid AND eustatus!=0";
	$result = $conn->query($sql);
  if ($result->num_rows > 0) {
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
 <title>Update My Profile</title>
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
<?php
include('header.php');
?>
<div class="container" style="margin-top:20px">
	<div class="row">
		<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
		<div class="panel panel-info">
		    <div class="panel-heading" style="background-color:#004c91;color:white" align="center"> Update Profile </div>
		    <div class="panel-body">
				<div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
				<form enctype="multipart/form-data" method="POST" action="./php_action/edit_profile.php" onsubmit="return validation()">
					<div class="row">
						<div class="col-md-6">	
						<div class="form-group">
							<label class="control-label">Select Honorifics</label>
								<select class="form-control" name="txthon" required>
									<?php echo"<option selected value='".$hon."'>".$hon."</option>"; ?>
									<option value="Mr.">Mr.</option>
									<option value="Mrs.">Mrs.</option>
									<option value="Miss.">Miss.</option>
									<option value="Prof. Mr.">Prof. Mr.</option>
									<option value="Prof. Mrs.">Prof. Mrs.</option>
									<option value="Prof. Miss.">Prof. Miss.</option>
									<option value="Prof. Dr.">Prof. Dr.</option>
									<option value="Dr. Mr.">Dr. Mr.</option>
									<option value="Dr. Mrs.">Dr. Mrs.</option>
								</select>
						</div>		
						  <div class="form-group">
						  <label class="control-label">Name</label>
							<input class="form-control" type="text" id="txtname" name= "txtname" placeholder="Enter Name (P. V. Kulkarni)" value="<?php echo $name; ?>" required>
							<input class="form-control" type="hidden" id="txtsid" name= "txtsid" placeholder="staff d" value="<?php echo $sid; ?>" required>
						  </div>
						   <div class="form-group">
						   <label class="control-label">Education</label>
							<input class="form-control" type="text" id="txtedu" name= "txtedu" placeholder="Enter Qualification" value="<?php echo $edu; ?>" required>
						  </div>
							 <div class="form-group">
								<label class="control-label">Select Designation</label>
									<select class="form-control" name="txtpost" required>
										<option value="">Select Designation</option>
										<?php echo"<option selected value='".$post."'>".$post."</option>"; ?>
										<option value="Principal">Principal </option>
										<option value="Vice Principal (Arts)">Vice Principal (Arts) </option>
										<option value="Vice	Principal (Commerce)">Vice Principal (Commerce) </option>
										<option value="Vice	Principal (Science)">Vice Principal (Science) </option>
										<option value="Vice Principal (Arts/Commerce)">Vice Principal (Arts/Commerce) </option>
										<option value="Vice Principal (Jr. College)">Vice Principal (Jr. College) </option>
										<option value="Head Of Department">Head Of Department </option>
										<option value="Assi. Prof.">Assi. Prof. </option>
										<option value="Assi. Prof. (HOD)">Assi. Prof. (HOD) </option>
										<option value="Asso. Prof.">Asso. Prof. </option>
										<option value="Asso. Prof. (HOD)">Asso. Prof. (HOD)</option>
										<option value="Nodal Officer">Nodal Officer </option>
										<option value="Teacher">Teacher </option>
										<option value="Librarian">Librarian </option>
										<option value="Library Clerk">Library Clerk </option>
										<option value="Lib.Asst.">Lib.Asst. </option>
										<option value="Lib.Attn.">Lib.Attn. </option>
										<option value="Office Superintendent">Office Superintendent </option>
										<option value="Head Clerk.">Head Clerk. </option>
										<option value="Head Clerk (Accountant)">Head Clerk (Accountant) </option>
										<option value="Cashier (Accountant)">Cashier (Accountant) </option>
										<option value="Sr. Clerk (Jr. College)">Sr. Clerk (Jr. College)</option>
										<option value="Sr. Clerk (Library)">Sr. Clerk (Library)</option>
										<option value="Jr. Clerk">Jr. Clerk </option>
										<option value="Clerk (Scholarship Department)">Clerk (Scholarship Department) </option>
										<option value="Sr. Clerk (Sr. College)">Sr. Clerk (Sr. College) </option>
										<option value="Lab. Asst.">Lab. Asst.</option>
										<option value="Lab. Attn.">Lab. Attn.</option>
										<option value="Syatem Admin. ">Syatem Admin. </option>
										<option value="Office Peon"> Office Peon </option>
										<option value="Peon "> Peon </option>
									</select>
							</div>
							<div class="form-group">
							<label class="control-label">Select Department</label>
								<select class="form-control" name="txtdepartment" required>
									<option value="">Select Department</option>
									<?php echo"<option selected value='".$department."'>".$department."</option>"; ?>
									<option value="Hindi">Hindi Department </option>
									<option value="Marathi">Marathi Department </option>
									<option value="English">English Department </option>
									<option value="Economics">Economics Department </option>
									<option value="PoliticalScience">Political Science Department </option>
									<option value="Geography">Geography Department </option>
									<option value="History">History Department </option>
									<option value="Physics">Physics Department </option>
									<option value="Chemistry">chemistry Department </option>
									<option value="Botany">Botany Department </option>
									<option value="Zoology">Zoology Department </option>
									<option value="Microbiology">Microbiology Department </option>
									<option value="ElectronicsScience">Electronics Science Department </option>
									<option value="Commerce">Commerce Department </option>
									<option value="Mathematics">Mathematics Department </option>
									<option value="BBA(CA)">BBA(CA) Department </option>
									<option value="Bio-Tech">Bio-Tech Department </option>
									<option value="Physical Education">Physical Education Department </option>
									<option value="Library">Library Department </option>
									<option value="Psychology">Psychology Department </option>
									<option value="YCMOU">YCMOU Department </option>
									<option value="JuniorCollege">Junior College </option>
									<option value="Administration">Administration Department </option>
									<option value="NonTeaching">Non Teaching </option>
								</select>
						</div>
						</div> 
						<div class="col-md-6">												
						<div class="form-group">
						<label class="control-label">Experience</label>
						<input class="form-control" type="text" id="txtexp" name= "txtexp" placeholder="Enter Experience" value="<?php echo $exp; ?>" required>
						</div>
						<div class="form-group">
						<label class="control-label">Mobile</label>
						<input class="form-control" type="number" id="txtmob" name= "txtmob" placeholder="Enter Mobile Number" value="<?php echo $mob; ?>" required>
						</div>
					   <div class="form-group">
					   <label class="control-label">Email</label>
						<input class="form-control" type="text" id="txtemail" name= "txtemail" placeholder="Enter Email Id" value="<?php echo $email; ?>" required>
						</div>
						<div class="form-group">
						<label class="control-label">Serial No</label>
						<input class="form-control" type="number" id="txtsrno" name= "txtsrno" min="1" max="99" value="<?php echo $srno; ?>" placeholder="Enter Serial Number" readonly>
						</div>
						  <div class="form-group">
						  <label class="control-label">Photo Size Limit Max 300 kb (widht=160 Px & Height=210 px)</label>
						  <input class="form-control" name="userfile" type="file" />
						 </div>						
						</div>			
					</div>	
				  <div class="form-group" align="center">
					<button type="submit" class="btn btn-info" name="submitstaff">Update Staff</button>
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