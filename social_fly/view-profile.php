<?php
include('./conn.php');
include('./lock.php');

	if (isset($_GET['euid'])) {	
	$euid=$_GET['euid'];
    $sql1="SELECT * FROM end_user WHERE eustatus=1 AND euid=$euid";
    $result = $conn->query($sql1);
      if ($result->num_rows > 0){
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
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
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

<title>View Profile</title>
<!--<link rel="shortcut icon" href="images/favicon.png" />

--><noscript>

<meta http-equiv=\"refresh\" content=\"0;url=index.php\">

</noscript>
    <link rel="stylesheet" href="dist/css/formValidation.css"/>

    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="dist/js/formValidation.js"></script>
    <script type="text/javascript" src="dist/js/framework/bootstrap.js"></script>

	<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA98Q7bgqRSax-gSZJW9eBG9OUJmPomZIw&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
<script type="text/javascript">
  function printbill(){
    //alert("hiiiiiiiiiiii");
    var prtContent = document.getElementById("invoice");
    var WinPrint = window.open('Todays Cases', 'Todays Cases', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
   }
</script>
<script type="text/javascript">
  function printreceipt(){
    //alert("hiiiiiiiiiiii");
    var prtContent = document.getElementById("receipt");
    var WinPrint = window.open('receipt', 'Receipt', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
   }
</script>
<style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 400px;
      }
    </style>
	 <script>
      // In this example, we center the map, and add a marker, using a LatLng object
      // literal instead of a google.maps.LatLng object. LatLng object literals are
      // a convenient way to add a LatLng coordinate and, in most cases, can be used
      // in place of a google.maps.LatLng object.
      let map;

      function initMap() {
        const mapOptions = {
          zoom: 14,
          center: { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> },
        };
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        const marker = new google.maps.Marker({
          // The below line is equivalent to writing:
          // position: new google.maps.LatLng(-34.397, 150.644)
          position: { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> },
          map: map,
        });
        // You can use a LatLng literal in place of a google.maps.LatLng object when
        // creating the Marker object. Once the Marker object is instantiated, its
        // position will be available as a google.maps.LatLng object. In this case,
        // we retrieve the marker's position using the
        // google.maps.LatLng.getPosition() method.
        const infowindow = new google.maps.InfoWindow({
          content: "<p>Marker Location:" + marker.getPosition() + "</p>",
        });
        google.maps.event.addListener(marker, "click", () => {
          infowindow.open(map, marker);
        });
      }
    </script>
</head>
<!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]--> 
<body id="profile">

<?php
include('./includes/header.php');
?>
<style>
.form-control-feedback {
    position: absolute;
    top: 20px !important;
    right: 13px !important;
    z-index: 2;
    display: block;
    width: 34px;
    height: 34px;
    line-height: 34px;
    text-align: center;
    pointer-events: none;
}
</style>
<section class="full-width-inner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2 class="page-title remove-top-padding">View User Profile</h2>
		<div class="row">
           <?php
			include('./includes/sidebar.php');
		   ?>          
 
		<div class="col-sm-8 col-md-9 col-lg-9">
            <div class="panel panel-info light-pink">
              <div class="panel-heading action-box">
                <div class="panel-caption">
                  <h3 class="panel-title">Profile </h3>
                </div>
                <div style="padding-left:20px;" class="panel-tools" ></div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4 col-lg-3"> 						  
                          
						  <a href="#"><img src="../social_boat/<?php echo $imgpath;?>" width="157" height="207" class="thumbnail" /></a>
                          </div>
                  <div class="col-md-8 col-lg-9">
                  <div class="profile-sumup">
                    <p class="profile-user-name"><a href="#"><?php echo $euname; ?></a> <span class="profile-user-id"><?php echo $euid; ?></span></p>
                    <div class="row">
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
                            <tr>
                              <td class="col-xs-4 col-sm-4">Full Name</td>
                              <td><span>:</span> <?php echo $euname;?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Mobile </td>
                              <td><span>:</span> <?php echo $eumob; ?></td>
                            </tr>							
							<tr>
                              <td class="col-xs-4 col-sm-4">Email</td>
                              <td><span>:</span> <?php echo $email; ?>  </td>
                            </tr>						
                          </tbody>
                        </table>
                      </div>
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
						   <tr>
                              <td class="col-xs-4 col-sm-4">City</td>
                              <td><span>:</span> <?php echo $city; ?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Birth Date</td>
                              <td><span>:</span> <?php echo $dob; ?>  </td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Gender</td>
                              <td><span>:</span> <?php echo $gender; ?>  </td>
                            </tr>
							                         
                          </tbody>
                        </table>
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
