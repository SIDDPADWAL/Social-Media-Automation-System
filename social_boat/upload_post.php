<?php
$sender="upload_post";
$login_session="" ;
 $url="";
 $status="";
 include('lock.php');
  //session_start();
// import connection file
include ("conn.php");
// define variables and set to empty values
   $uname = "";
   $pass = "";
   $currdate= ""; 
   $status=null;
   $errorc="";
  $showc="display:none;";
   $errorv="";
  $showv="display:none;";
  $alertc="";
  $alertv="";
  $error="";
  $show="display:none;";
  $alert="";
// define variables and set to empty values
	  $error="";
	  $show="display:none;";
	  $alert="";
	if (isset($_GET['error'])) {
      $error=$_GET['error'];
      $show=$_GET['show'];
      $alert=$_GET['alert'];
    }
//**************************************************************************************************************************
if (isset($_GET['delalert'])) {
  $errorv="PDF No ".$_GET['delalert']." Is Deleted successfully!";
        $showv="display:show;";
        $alertv="alert alert-success";
  }
  if (isset($_GET['delfail'])) {
    $errorc="Password Invalid ! Transaction Is Not Deleted Try Again !";
    //$errorc='<b>'.$cname.'</b>'." "."Customer Name Is Not Exist!";
    $showc="display:show;";
    $alertc="alert alert-danger";
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
 <title> Upload Post  </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
  <script src="./sss.js"></script>
  <script type="text/javascript">
	function changefile(obj){
    var selectedtype= (obj.options[obj.selectedIndex].value);
		if(selectedtype=="Photo" || selectedtype=="Video")
		{
			document.getElementById("div_userfile").style="display:show;";
			document.getElementById("div_txtlink").style="display:none;";
			document.getElementById("txtlink").innerHTML="";
		}
		else if(selectedtype=="Link")
		{
			document.getElementById("div_txtlink").style="display:show;";
			document.getElementById("div_userfile").style="display:none;";
			document.getElementById("txtlink").innerHTML="";
		}
		else
		{
			document.getElementById("div_txtlink").style="display:none;";
			document.getElementById("div_userfile").style="display:none;";
			document.getElementById("txtlink").innerHTML="#";			
		}
    }
</script>

</head>
<body>
<?php
include('./header.php');
?>
<div class="container-fluid" style="margin-top:20px">
<div class="row">
    <div class="col-md-12">
      <div align="center" class="<?php echo $alertc; ?>" role="alert" style="<?php echo $showc; ?>"><?php echo $errorc; ?></div>
      <div align="center" class="<?php echo $alertv; ?>" role="alert" style="<?php echo $showv; ?>"><?php echo $errorv; ?></div>
    </div> <!-- close col-->
  </div> <!--close row-->
<div class="row">
  <div class = "col-md-4">
  <div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
<div class="panel panel-info">
      <div class="panel-heading" align="center">Upload Post </div>
      <div class="panel-body">
 <form enctype="multipart/form-data" data-toggle="validator" role="form" method="post" action="./php_action/upload_post.php?sender=<?php echo $sender?>">
	<div class="form-group">
		<label>Select Platform</label>
		<select class="form-control action" id="post_privacy" name="post_privacy" required>
		  <option value="">Select Platform</option>		   
		  <option value="1">Social Fly</option>		   
		  <option value="2">Social World</option>		   
		  <option value="3">Both Social Media</option>		   
		</select>
	</div>
  <div class="form-group">
      <label class="control-label">Post Description</label>
    <textarea class="form-control" rows="4" id="post_desc" name= "post_desc" required></textarea>
  </div>
	<div class="form-group">
        <label class="control-label">Select Content Type</label>
            <select class="form-control" name="post_type" id="post_type" onChange="changefile(this)" required>
                <option value="">Select Type</option>
                <option value="Photo">Photo </option>
				<option value="Video">Video</option>
				<option value="Link">Link</option>
                <option value="None">None </option>
            </select>
    </div>	
	<div class="form-group" id="div_userfile" style="display:none;">
		<label class="control-label">Upload File</label>
		<input class="form-control" id="userfile" name="userfile" type="file" />
	</div>
	<div class="form-group" id="div_txtlink" style="display:none;">
		<label class="control-label">Enter Link</label>
		<textarea class="form-control" rows="3" id="txtlink" name= "txtlink"></textarea>
	</div>
  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info" name="submitlink">Submit Post</button>
  </div>
</form>
</div> <!-- Close panel Body -->
</div> <!-- Close Panel -->
</div> <!-- Close Col -->
<div class="col-md-8">
<div class="panel panel-info" >
      <div class="panel-heading"  align="center">E-Contents Details</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      //include('conn.php');
      error_reporting(E_ALL); 
$sql="SELECT * FROM post WHERE euid=$euid AND post_status=1";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
       
          echo "<table class='table table-striped'>
          <thead>
            <tr>
			  <th>Sr.No.</th>
			  <th>Post Description</th>
              <th>Post Type </th>
              <th>Post Privacy </th>
              <th>Date </th>              
			  <th>File/Link</th>
			  <th>Status</th>			  			
			  <th>Action</th>
           </tr>
          </thead>
          <tbody>";
		  $count=0;
          while($row = $result->fetch_assoc()) {
			  $count++;
              echo"<tr>";             
              echo "<td>".$count."</td>";
              echo "<td>".$row['post_desc']."</td>";
              echo "<td>".$row['post_type']."</td>";
              echo "<td>".$row['post_privacy']."</td>";
			   echo "<td>".date( 'd/m/Y', strtotime($row['post_date']))."</td>";
			   if($row['post_type']=='Photo' || $row['post_type']=='Video'){
			   echo"<td><u><a href='".$row['post_path']."' target='self' >Download OR View (".$row['post_type'].")</a></u></td>";
			   }
			   else{
			   echo"<td><u><a href='".$row['post_path']."' target='self' >Download OR View (".$row['post_type'].")</a></u></td>";
			   }
			   if($row['post_status']==1){echo "<td class='success'>Active</td>";}
			   else if ($row['post_status']==2){echo "<td class='warning'>Pending</td>";}			
			   else if($row['post_status']==0){echo "<td class='danger'>Rejected</td>";}			
			   else {echo "<td class='primary'>None</td>";}	
			echo"<td class='text-center'>
			<div class='btn-group'>
			<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>	Action <span class='caret'></span></button>
			<ul class='dropdown-menu'>
			<li><a type='button' id='deletebtn' onclick='delete_post(".$row['post_id'].")'>Reject/Delete</a></li>
			</ul>
			</div></td>";			
           echo "</tr>";
         }
           
          echo"</tbody>
      </table>";
        
        }  
        else {
         echo "0 results";
        }
        $conn->close();
        ?> 
      </div>
      </div><!-- Close panel Body -->

</div> <!-- Close Panel -->
</div>
</div> <!-- Close Row -->
</div> <!-- Close Container -->
<?php
include('./footer.php');
?>
</body>
</html>