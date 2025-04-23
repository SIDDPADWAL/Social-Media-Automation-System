<?php
$error="";
$show="display:none;";
$alert="";
include('./lock.php');
include('./conn.php');
//fetch Company Details
$sql = "SELECT * FROM end_user WHERE euid = $euid";
$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
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
  <title>My Profile</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
   <script src="./activemenu.js"></script>
   <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA98Q7bgqRSax-gSZJW9eBG9OUJmPomZIw&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 400px;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
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
<body id="addcutomer">
<?php
include('./header.php');
?>
  <div class="container">
    <div class="row">
	<div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
      <div class="col-lg-12 col-md-12">
        <h2 align="center" class="page-title remove-top-padding">Profile Details </h2>
         <div class="row">         
		<div class="col-sm-8 col-md-12 col-lg-12">
            <div class="panel panel-info" style="border-color: #004c91;">
              <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;">
                <div class="panel-caption">
                  <h3 class="panel-title">My Profile				  				   
				  <a class="pull-right btn btn-info btn-sm" style="display:none;margin-top:-5px;margin-left:20px;color:white" align="right" href="./edit_profile.php?sid=<?php echo $euid?>"  >Edit Profile</a></h3>				   
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4 col-lg-3"> 						  
                          
						  <a href="#"><img src="./<?php echo $imgpath?>" width="150" height="200" class="thumbnail" /></a>
                          </div>
                  <div class="col-md-8 col-lg-9">
                    <h4><?php echo $euname." ( - ID ". $euid." )"; ?></h4>
                    <div class="row">
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
						  <tr>
                              <td class="col-xs-4 col-sm-4">Faculty Name</td>
                              <td><span>:</span>  <?php echo $euname; ?></td>
                            </tr>	
							<tr>
                              <td class="col-xs-4 col-sm-4">Mobile Number</td>
                              <td><span>:</span> <?php echo $eumob;?></td>
                            </tr>							
							<tr>
                              <td class="col-xs-4 col-sm-4">Password </td>
                              <td><span>:</span> <?php echo $eupass; ?>  </td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Email Id </td>
                              <td><span>:</span> <?php echo $email; ?>  </td>
                            </tr>														
                          </tbody>
                        </table>
                      </div>
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
							<tr>
                              <td class="col-xs-4 col-sm-4">Date Of Birth</td>
                              <td><span>:</span> <?php echo $dob;?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Gender </td>
                              <td><span>:</span> <?php echo $gender; ?>  </td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">City</td>
                              <td><span>:</span> <?php echo $city;?></td>
                            </tr>                            
							<tr>
                              <td class="col-xs-4 col-sm-4">Registration Date</td>
                              <td><span>:</span> <?php echo date( 'd/m/Y', strtotime($regdate));?></td>
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
<!--Footer-->
<?php
include('./footer.php');
?>  
</body>
</html>