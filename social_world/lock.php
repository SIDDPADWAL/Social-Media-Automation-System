<?php
include('conn.php');
$lsess=date('Y-m-d');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['login_user']) && isset($_SESSION['login_user_pass']) && $lsess<=base64_decode("MjAyMy0wNi0zMA=="))
{
	$user_check=$_SESSION['login_user'];
	$pass_check=$_SESSION['login_user_pass'];
	$ses_sql="SELECT * FROM end_user WHERE eumob='$user_check' AND eupass='$pass_check' AND eustatus!=0";
	$result = $conn->query($ses_sql);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {
			$euid = $row['euid'];
			$login_session=$row['euname'];
		}
	}
	else{
		header("Location:logout.php");
	}
}
else
{
	header("Location:./login.php");
}
?>