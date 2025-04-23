<?php
include('../conn.php');
include('../lock.php');
//include('./getprofile.php');
$error="";
$show="display:none;";
$alert="alert alert-danger";

if (isset($_POST['del_photo'])){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if($gender=="Male"){
		  $localimgpath="./uploads/staff_profile_photo/avatar_male.png";
		  }
		  else{
			$localimgpath="./uploads/staff_profile_photo/avatar_female.png";
		  }
		  $sqlphoto="UPDATE photo SET imgpath='$localimgpath', update_date=@now := now() WHERE euser_id=$sid";
		  if($conn->query($sqlphoto)=== TRUE) {
			$error="Profile Photo Removed!";
			$show="display:show;";
			$alert="alert alert-success";
			header("Location:../updatestaff.php?error=$error&show=$show&alert=$alert");
		  }
}
}


if (isset($_POST['submitstaff'])){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	 $sid = test_input($_POST["txtsid"]);
	 $mob = test_input($_POST["txtmob"]);
     $sql1="SELECT sid FROM staff WHERE sid='$sid' and status!=0 ";
     $result = $conn->query($sql1);
      if ($result->num_rows == 0){
        $error="Staff Member Name Is Not Exist!";
        $show="display:show;";
        $alert="alert alert-danger";
		header("Location:../edit_profile.php?error=$error&show=$show&alert=$alert");
		exit();
      }
	  $sql1="SELECT sid FROM staff WHERE sid!='$sid' AND mob='$mob' and status!=0 ";
	  $result = $conn->query($sql1);
      if ($result->num_rows > 0){
        $error="Staff Member Mobile Number Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";
		header("Location:../edit_profile.php?error=$error&show=$show&alert=$alert");
		exit();
      }
	  
$uidsend=$sid;
//********************************************************************************************************
if(!isset($_FILES['userfile']))
{
	$msg=inserstaff($uidsend);
	$error=$msg;
    $show="display:show;";
    $alert="alert alert-danger";
	//header("Location:../edit_profile.php?error=$error&show=$show&alert=$alert");
}
else
{
    try {
    $msg= upload($uidsend);  //this will upload your image
    $error=$msg;
    $show="display:show;";
    $alert="alert alert-info";
	header("Location:../edit_profile.php?error=$error&show=$show&alert=$alert");
    //echo $msg;  //Message showing success or failure.
    }
    catch(Exception $e) {
    echo $e->getMessage();
    //echo 'Sorry, could not upload file';
    $error="Sorry, could not upload file";
    $show="display:show;";
    $alert="alert alert-danger";
	header("Location:../edit_profile.php?error=$error&show=$show&alert=$alert");
    }
}
}
}

//***********************************************************************************************************
// insert staff with photo 
function upload($uidsend) {
    //include "file_constants.php";
	$msg=null;
	$sid = test_input($_POST["txtsid"]);
     $hon = test_input($_POST["txthon"]);
     $name = test_input($_POST["txtname"]);
     $edu = test_input($_POST["txtedu"]);
	 $post = test_input($_POST["txtpost"]);
     $depart = test_input($_POST["txtdepartment"]);
     $exp = test_input($_POST["txtexp"]);
     $email = test_input($_POST["txtemail"]);
     $mob = test_input($_POST["txtmob"]);
     $srno = test_input($_POST["txtsrno"]);
     include('../lock.php');
     $uid=$sid;
     $status=1;
     $type=1;
    
    //$maxsize = 10000000; //set to approx 10 MB
    $maxsize = 300000; //set to approx 300 KB

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
					
					include('../lock.php');
					$temp = explode(".", $_FILES["userfile"]["name"]);
					//$newfilename = round(microtime(true)) . '.' . end($temp);
					$newfilename = $sid."_".date("Ymdhis").'.' . end($temp);
					//move_uploaded_file($_FILES["userfile"]["tmp_name"], "../img/imageDirectory/" . $newfilename);
					//$destination_path = getcwd().DIRECTORY_SEPARATOR;
					//$target_path = $destination_path . basename( $_FILES["userfile"]["name"]);
					//move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path);
					move_uploaded_file($_FILES["userfile"]["tmp_name"],"../uploads/staff_profile_photo/".$newfilename);
					
					
					
                    // put the image in the db...
                    // database connection
                    //mysql_connect($host, $user, $pass) OR DIE (mysql_error());

                    // select the db
                    //mysql_select_db ($db) OR DIE ("Unable to select db".mysql_error());
                 
					$imgpath="./uploads/staff_profile_photo/".$newfilename;
					
                    // our sql query
					$sql = "UPDATE staff SET hon='$hon', name='$name', edu='$edu', post='$post', department='$depart', exp='$exp', mob='$mob', email='$email', srno=$srno, imgpath='$imgpath' WHERE sid=$sid AND status!=0";
					//$sql = "INSERT INTO staff (hon, name, edu, post, department, exp, mob, email, imgpath, status, date, uid)VALUES ('$hon', '$name', '$edu', '$post', '$depart', '$exp', '$mob', '$email', '$imgpath', '$status', @now := now(), $uid)";
                    //$sql = "INSERT INTO photo (imgpath, privacy, updatedate, status, euser_id) VALUES ( '$imgpath','$privacy', @now := now(), '$status', $user_id)";
					include('../conn.php');
                    // insert the image
                    if($conn->query($sql)===TRUE){
                    //mysql_query($sql) or die("Error in Query: " . mysql_error());
                    $msg='<p>Staff Details Is Updated successfully !</p>';
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
			$msg=inserstaff($uidsend);
		}
    }
    return $msg;
}

function inserstaff($uidsend){
	include('../conn.php');
	 $sid = test_input($_POST["txtsid"]);
	 $hon = test_input($_POST["txthon"]);
     $name = test_input($_POST["txtname"]);
     $edu = test_input($_POST["txtedu"]);
	 $post = test_input($_POST["txtpost"]);
     $depart = test_input($_POST["txtdepartment"]);
     $exp = test_input($_POST["txtexp"]);
     $email = test_input($_POST["txtemail"]);
     $mob = test_input($_POST["txtmob"]);
      $srno = test_input($_POST["txtsrno"]);
     $uid=$uidsend;
     $status=1;
     $type=1;
	  $sql = "UPDATE staff SET hon='$hon', name='$name', edu='$edu', post='$post', department='$depart', exp='$exp', mob='$mob', email='$email', srno=$srno WHERE sid=$sid AND status!=0";
          if ($conn->query($sql) === TRUE) {
          $msg="Staff Member Is Updated successfully!";
          }
          else{
          $msg="Somthing Is Wrong! Please Try Again!";
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