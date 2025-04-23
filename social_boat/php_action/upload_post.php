<?php
include('../conn.php');
include('../lock.php');
//include('./getprofile.php');
$error="";
$show="display:none;";
$alert="alert alert-danger";
if (isset($_GET['sender'])) {
  $sender=$_GET['sender'];
}
else{
	$sender="upload_econtents";
}
if (isset($_POST['submitlink'])){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	 $post_desc = test_input($_POST["post_desc"]);
	  $sql1="SELECT * FROM post WHERE post_desc='$post_desc' AND post_status!=0";
     $result = $conn->query($sql1);
      if ($result->num_rows > 0){
        $error="Post Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";
		header("Location:../".$sender.".php?error=$error&show=$show&alert=$alert");
		exit();
      }
	 
$uidsend=$euid;
//********************************************************************************************************
if(!isset($_FILES['userfile']))
{
	$msg=upload_econtents($uidsend);
	$error=$msg;
    $show="display:show;";
    $alert="alert alert-danger";
	header("Location:../".$sender.".php?error=$error&show=$show&alert=$alert");
}
else
{
    try {
    $msg= upload($uidsend);  //this will upload your image
    $error=$msg;
    $show="display:show;";
    $alert="alert alert-info";
	header("Location:../".$sender.".php?error=$error&show=$show&alert=$alert");
    //echo $msg;  //Message showing success or failure.
    }
    catch(Exception $e) {
    echo $e->getMessage();
    //echo 'Sorry, could not upload file';
    $error="Sorry, could not upload file";
    $show="display:show;";
    $alert="alert alert-danger";
	header("Location:../".$sender.".php?error=$error&show=$show&alert=$alert");
    }
}
}
}

//***********************************************************************************************************
function upload($uidsend) {
	 $msg=null;
	 $post_privacy = test_input($_POST["post_privacy"]);
	 $post_desc = test_input($_POST["post_desc"]);
	 $post_type = test_input($_POST["post_type"]);
     include('../lock.php');
     $uid=$uidsend;
     $status=1; 
	$type="image";
	 if($post_type=="Video"){
		 $type="video/mp4";
	 }
	 else{
		 $type="image";
	 }
     $maxsize = 10000000; //set to approx 10 MB
    if($_FILES['userfile']['error']==UPLOAD_ERR_OK) {
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {    

            if( $_FILES['userfile']['size'] < $maxsize) {  
                 $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),$type)===0) {    
                    $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
					$temp = explode(".", $_FILES["userfile"]["name"]);
					$newfilename = $uid."_".date("Ymdhis").'.' . end($temp);
					move_uploaded_file($_FILES["userfile"]["tmp_name"],"../uploads/post/".$newfilename);
					$post_path ="./uploads/post/".$newfilename;
					 $sql = "INSERT INTO post (post_desc, post_type, post_privacy, post_path, post_date, post_status, euid)
						VALUES ( '$post_desc', '$post_type', '$post_privacy', '$post_path', @now := now(), '$status', $uid)";
						echo $sql;
                    include('../conn.php');
                    if($conn->query($sql)===TRUE){
                    $msg='<p>Post is Uploaded successfully !</p>';
                    }                  
                }
                else
                    $msg="<p>Uploaded file is not Valid.</p>";
            }
             else {
                $msg='pdf File exceeds the Maximum File limit, Maximum File limit is '.$maxsize.' bytes, File '.$_FILES['userfile']['name'].' is '.$_FILES['userfile']['size'].' bytes';
                }
        }
        else
		{
            $msg="pdf File not uploaded successfully.";
		}

    }
    else {
        $msg= file_upload_error_message($_FILES['userfile']['error']);
		if($msg=="No file was uploaded"){
			$msg=upload_econtents($uidsend);
		}
		
    }
    return $msg;
}
function upload_econtents($uidsend){
	include('../conn.php');
	 $post_privacy = test_input($_POST["post_privacy"]);
	 $post_desc = test_input($_POST["post_desc"]);
	 $post_type = test_input($_POST["post_type"]);
	 $post_path = test_input($_POST["txtlink"]);
	 $status=1;   
	 $uid=$uidsend;	 
	$sql = "INSERT INTO post (post_desc, post_type, post_privacy, post_path, post_date, post_status, euid)
			VALUES ( '$post_desc', '$post_type', '$post_privacy', '$post_path', @now := now(), '$status', $uid)";
	if ($conn->query($sql) === TRUE) {			
		$msg='<p>Post is updated successfully !</p>';
	}
	else{
		$msg='<p>Invalid Operation!</p>';
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