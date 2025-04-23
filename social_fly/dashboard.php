<?php
 include('lock.php');
$error="";
$show="display:none;";
$alert="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name="author" content="Responsive Matrimonial">
<link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css"/>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">
<link rel="stylesheet" href="assets/css/custom.css">
<link type="text/css" rel="stylesheet" media="all" href="assets/css/chat.css" />
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
<script type="text/javascript" src="assets/js/ajaxfunction.js"></script>

<title>Dashboard</title>

<meta name="Description" content="Matrimony site for Responsive
Responsive Matrimonial">
<meta name="keywords" content="Responsive Matrimonial">

<!--<link rel="shortcut icon" href="images/favicon.png" />

--><noscript>

<meta http-equiv=\"refresh\" content=\"0;url=index.php\">

</noscript>
    <link rel="stylesheet" href="dist/css/formValidation.css"/>

    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="dist/js/formValidation.js"></script>
    <script type="text/javascript" src="dist/js/framework/bootstrap.js"></script>
    <script type="text/javascript" src="./sss.js"></script>


</head>
<!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]--> 
<body id="matches">
<?php
include('./includes/header.php');
?>
 



<script type="text/javascript">
function user_request(str,iid)
{ 

var xmlhttp;
if (str.length==0)
  {
  
  document.getElementById("req"+iid).innerHTML="";
  return;
  }
 // document.getElementById('progress'+iid).style.display='block';
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("req"+iid).innerHTML=xmlhttp.responseText;
	// document.getElementById('progress'+iid).style.display='none';
    }
  }
xmlhttp.open("GET","ajax_req.php?q="+str,true);
xmlhttp.send();
	
}

</script>
<script type="text/javascript">
function user_shortlist(str,iid)
{ 

var xmlhttp;
if (str.length==0)
  {
  
  document.getElementById("short"+iid).innerHTML="";
  return;
  }
  //document.getElementById('progress'+iid).style.display='block';
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("short"+iid).innerHTML=xmlhttp.responseText;
	// document.getElementById('progress'+iid).style.display='none';
    }
  }
xmlhttp.open("GET","ajax_short.php?q="+str,true);
xmlhttp.send();
	
}
</script>
<!-- Inner Page Full Width -->

<section class="full-width-inner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2 class="page-title remove-top-padding">Post</h2>
        <div class="row">
          
<?php
include('./includes/sidebar.php');
?>         
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				   <div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
         <div class="panel panel-info light-pink">
              <div class="panel-heading">
                <h3 class="panel-title">
				
              </div>
              <div class="panel-body remove-padding remove-border">
			  <?php
				//$sql1="SELECT e.euser_id, p.imgpath, e.fname, e.lname, e.bdate, pa.height, e.mstatus, e.religion, e.caste, ec.education, ec.profession, cnt.address, cnt.city, cnt.country  FROM end_user e, physical_appearance pa, lifestyle ls, educareer ec, family f, contact cnt, partnerpref pf, photo p, kundali k WHERE e.demostatus=0 AND e.status=1 AND e.euser_id=pa.euser_id AND e.euser_id=ls.euser_id AND e.euser_id=ec.euser_id AND e.euser_id=f.euser_id AND e.euser_id=cnt.euser_id AND e.euser_id=pf.euser_id AND e.euser_id=p.euser_id AND e.euser_id=k.euser_id;";
				// This first query is just to get the total count of rows
				
/*	$matchlimit=rand(50,$count);
	$matchlimit= 'LIMIT '.$matchlimit.' , '.$count;
	echo $matchlimit;*/
	
$sqlcnt = "SELECT * FROM post WHERE post_status=1";
$resultcnt = $conn->query($sqlcnt);
$rows = $resultcnt->num_rows;
// Here we have the total row count
//$rows = $row[0];
// This is the number of results we want displayed per page
$page_rows = 500;
// This tells us the page number of our last page
$last = ceil($rows/$page_rows);
// This makes sure $last cannot be less than 1
if($last < 1){
  $last = 1;
}
// Establish the $pagenum variable
$pagenum = 1;
// Get pagenum from URL vars if it is present, else it is = 1
if(isset($_GET['pn'])){
  $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}
// This sets the range of rows to query for the chosen $pagenum
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
// This is your query again, it is for grabbing just one page worth of rows by applying $limit
$sql = "SELECT * FROM post p, end_user eu WHERE eu.euid=p.euid AND p.post_status=1 ORDER BY post_id DESC $limit";
$query = $conn->query($sql);
// This shows the user what page they are on, and the total number of pages
//$textline1 = "Testimonials (<b>$rows</b>)";
//$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
// Establish the $paginationCtrls variable
$paginationCtrls = "";
// If there is more than 1 page worth of results
if($last != 1){
  /* First we check if we are on page one. If we are then we don't need a link to 
     the previous page or the first page so we do nothing. If we aren't then we
     generate links to the first page, and to the previous page. */
  if ($pagenum > 1) {
        $previous = $pagenum - 1;
    //$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span></a> &nbsp; &nbsp; ';
    $paginationCtrls .= "<li><a href='".$_SERVER['PHP_SELF']."?pn=".$previous."'>&laquo; Previous</a></li>";
    // Render clickable number links that should appear on the left of the target page number
    for($i = $pagenum-4; $i < $pagenum; $i++){
      if($i > 0){
            //$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
            $paginationCtrls .= "<li><a href='".$_SERVER['PHP_SELF']."?pn=".$i."'>".$i."</a></li>";
      }
      }
    }
  // Render the target page number, but without it being a link
  $paginationCtrls .= "<li class='active'><a href='".$_SERVER['PHP_SELF']."?pn=".$pagenum."'>".$pagenum."</a></li>";
  // Render clickable number links that should appear on the right of the target page number
  for($i = $pagenum+1; $i <= $last; $i++){
    $paginationCtrls .= "<li ><a href='".$_SERVER['PHP_SELF']."?pn=".$i."'>".$i."</a></li>";
    if($i >= $pagenum+4){
      break;
    }
  }
  // This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        //$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'"><span class="glyphicon glyphicon-forward" aria-hidden="true"></span></a> ';
        $paginationCtrls .= " <li class='next'><a href='".$_SERVER['PHP_SELF']."?pn=".$next."'>Next &raquo;</a></li> ";
    }
}
				echo"<div class='row'>
                  <div class='hidden-xs hidden-sm col-md-2 col-lg-2'>
				  </div>
                  <div class='col-md-12 col-lg-12'>
                   <ul class='pagination remove-margin-pagination pull-right' id='pagination-flickr'>". $paginationCtrls."</ul> </div>
                </div>";


				$result = $conn->query($sql);
				  if ($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
						$totallikes=0;
						$sql="SELECT * FROM likes Where post_id=".$row['post_id']." AND status=1";
						$query = $conn->query($sql);
						$totallikes = $query->num_rows;
						
			    echo"<article class='profile-search-result'>
                  <div class='profile-search-list-box'>
                    <div class='row'>
                      <div class='col-sm-12 col-md-12 col-lg-12'>
					  <div class='row'>
						<div class='col-md-2'>
							<a href='./view-profile.php?euid=".$row['euid']."'><img class='thumbnail img-responsive' src='../social_boat/".$row['imgpath']."' height='70' width='80' border='0' /></a>
						</div>
						<div class='col-md-10'>
							<p class='profile-user-name'><a href='./view-profile.php?euid=".$row['euid']."'>".$row['euname']."</a> </p>
						</div>
					  </div>
                        <div class='row'>
                          <div class='col-sm-12 col-md-12 col-lg-12'>
                            ".$row['post_desc']."<br/><br/>";
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
                        </div>
                       
                      </div>
                    </div>";
                   echo" <div class='row top-border'>
                      <div class='col-md-12'>
                        <div class='btn-group btn-group-md profile-group-btn'>
                          <a href='./view-profile.php?euid=".$row['euid']."' type='button' class='btn btn-default pink2-btn btn-on'><i class='fa fa-file'></i>View Profile</a>
						  
						  <button onclick='like(".$row['post_id'].")' class='btn btn-default pink2-btn btn-on'><i class='fa fa-heart'></i>".$totallikes." Likes</button>
						
							
						</div>
                      </div>
                    </div>
                  </div>
                </article>";
			}
		}
	
				echo"<div class='row'>
                  <div class='hidden-xs hidden-sm col-md-2 col-lg-2'>
				  </div>
                  <div class='col-md-12 col-lg-12'>
                   <ul class='pagination remove-margin-pagination pull-right' id='pagination-flickr'>". $paginationCtrls."</ul> </div>
                </div>";
    ?>
                 
                <div class="row">
                  <div class="hidden-xs hidden-sm col-md-2 col-lg-2 ">
                    <!--select id="minAge" name="minAge" class="form-control">
                      <option value="19" elected="">10</option>
                      <option value="20">50</option>
                      <option value="21">All</option>
                    </select-->
                  </div>
                  <div class="col-md-10 col-lg-10">
                                     </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/chat.js"></script>
 <script>
    $('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});
    </script>

<!--Footer-->
<?php
include('./includes/footer.php');
?>
<div id="back-top" style="display:none;"> <a href="#" class="scroll" data-scroll>
  <button class="btn btn-primary" title="Back to Top"><i class="fa fa-angle-up"></i></button>
  </a> </div>

</body>
</html>
