<?php
include('../conn.php');
//include('../lock.php');
//include('./getprofile.php');
$error="";
$show="display:none;";
$alert="alert alert-danger";
if (isset($_POST['submitstaff'])){
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $euname = test_input($_POST["euname"]);
	 $eumob = test_input($_POST["eumob"]);
     $sql1="SELECT eumob FROM end_user WHERE eumob='$eumob' and eustatus!=0 ";
     $result = $conn->query($sql1);
      if ($result->num_rows > 0){
        $error="User Mobile Number Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";
		header("Location:../register.php?error=$error&show=$show&alert=$alert");
		exit();
      }
//********************************************************************************************************
if(!isset($_FILES['userfile']))
{
	$msg=adduser();
	$error=$msg;
    $show="display:show;";
    $alert="alert alert-danger";
	header("Location:../register.php?error=$error&show=$show&alert=$alert");
}
else
{
    try {
    $msg= upload();  //this will upload your image
    $error=$msg;
    $show="display:show;";
    $alert="alert alert-info";
	header("Location:../register.php?error=$error&show=$show&alert=$alert");
    }
    catch(Exception $e) {
    echo $e->getMessage();
    //echo 'Sorry, could not upload file';
    $error="Sorry, could not upload file";
    $show="display:show;";
    $alert="alert alert-danger";
	header("Location:../register.php?error=$error&show=$show&alert=$alert");
    }
}
}
}
//***********************************************************************************************************
// insert staff with photo 
function upload() {
	$msg=null;
     $euname = test_input($_POST["euname"]);
     $eumob = test_input($_POST["eumob"]);
	 $eupass = test_input($_POST["eupass"]);
     $email = test_input($_POST["email"]);
     $dob = test_input($_POST["dob"]);
     $gender = test_input($_POST["gender"]);
     $city = test_input($_POST["city"]);
     $status=1;
    //$maxsize = 10000000; //set to approx 10 MB
    $maxsize = 10000000; //set to approx 300 KB
    //check associated error code
    if($_FILES['userfile']['error']==UPLOAD_ERR_OK) {
        //check whether file is uploaded with HTTP POST
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {    
            //checks size of uploaded image on server side
            if( $_FILES['userfile']['size'] < $maxsize) {  
               //checks whether uploaded file is of image type
              //if(strpos(mime_content_type($_FILES['userfile']['tmp_name']),"image")===0) {
                 $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),"image")===0) {    
                    // prepare the image for insertion in database
                    $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
					// coding for save image in directory
					//move_uploaded_file($_FILES['userfile']['tmp_name'],"uploads/".$_FILES['userfile']['name']);
					//include('../lock.php');
					$temp = explode(".", $_FILES["userfile"]["name"]);
					//$newfilename = round(microtime(true)) . '.' . end($temp);
					$newfilename = date("Ymdhis").'.' . end($temp);
					//move_uploaded_file($_FILES["userfile"]["tmp_name"], "../img/imageDirectory/" . $newfilename);
					//$destination_path = getcwd().DIRECTORY_SEPARATOR;
					//$target_path = $destination_path . basename( $_FILES["userfile"]["name"]);
					//move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path);
					move_uploaded_file($_FILES["userfile"]["tmp_name"],"../uploads/profile_photo/".$newfilename);
                    // put the image in the db...
                    // database connection
                    //mysql_connect($host, $user, $pass) OR DIE (mysql_error());
                    // select the db
                    //mysql_select_db ($db) OR DIE ("Unable to select db".mysql_error());
					$imgpath="./uploads/profile_photo/".$newfilename;
                    // our sql query
					$sql = "INSERT INTO end_user (euname, eumob, eupass, email, dob, gender, city, imgpath, regdate, eustatus)VALUES ('$euname', '$eumob', '$eupass', '$email', '$dob', '$gender', '$city', '$imgpath', @now := now(), $status)";
                    echo $sql;
					include('../conn.php');
                    // insert the image
                    if($conn->query($sql)===TRUE){
						$msg='<p>User Account is Created successfully! <a href="./login.php"> Click Here to Login</a></p>';									
                    //mysql_query($sql) or die("Error in Query: " . mysql_error());
                   // $msg='<p>Staff Details Is Updated successfully !</p>';
                    }
                }
                else
                    $msg="<p>Uploaded file is not an image.</p>";
            }
             else {
                // if the file is not less than the maximum allowed, print an error
                $msg='Photo File exceeds the Maximum File limit, Maximum File limit is '.$maxsize.' bytes, File '.$_FILES['userfile']['name'].' is '.$_FILES['userfile']['size'].' bytes';
                }
        }
        else
		{
            $msg="Photo File not uploaded successfully.";
		}
    }
    else {
        $msg= file_upload_error_message($_FILES['userfile']['error']);
		if($msg=="No file was uploaded"){
			$msg=adduser();
		}
    }
    return $msg;
}
function adduser(){
	include('../conn.php');
	 $euname = test_input($_POST["euname"]);
     $eumob = test_input($_POST["eumob"]);
	 $eupass = test_input($_POST["eupass"]);
     $email = test_input($_POST["email"]);
     $dob = test_input($_POST["dob"]);
     $gender = test_input($_POST["gender"]);
     $city = test_input($_POST["city"]);
     $status=1;
	 if($gender=="Male"){
		$imgpath = "./uploads/profile_photo/avatar_male.png";
	 }
	 else{
		$imgpath = "./uploads/profile_photo/avatar_female.png";
	 }
     $status=1;
	  $sql = "INSERT INTO end_user (euname, eumob, eupass, email, dob, gender, city, imgpath, regdate, eustatus)VALUES ('$euname', '$eumob', '$eupass', '$email', '$dob', '$gender', '$city', '$imgpath', @now := now(), $status)";
          if ($conn->query($sql) === TRUE) {			
			$msg='<p>User Account is Created successfully! <a href="./login.php"> Click Here to Login</a></p>';
          }
          else{
          $msg="Something Is Wrong! Please Try Again!";
          }
		  return $msg;
}
//*********************************************************************************************************************
function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>