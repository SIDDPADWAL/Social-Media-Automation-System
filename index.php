<!DOCTYPE html>
<html lang="en">
<head>
  <title>Social Media Automation System</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./social_boat/resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./social_boat/resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./social_boat/resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
   <script src="./social_boat/activemenu.js"></script>
<!-- fullCalendar 2.2.5 -->
<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');
      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();
      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });
    });
</script>
<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
	.card{
	width: 100%;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	text-align: center;
	}
	.cardHeader{
		background-color: #4CAF50;
		color: white; 
		padding: 10px; 
		font-size: 40px;
	}
	.cardContainer{
		padding: 10px;
	}
</style>
<!-- fullCalendar 2.2.5-->
</head>
<body id="dashboard">
 <div class="container" style="margin-top: 10px">
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<a href="./social_world/login.php" target="self" style="text-decoration:none;color:black;">
					Social World Login
					<span class="badge pull pull-right">Social World</span>	
				</a>
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	<div class="col-md-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				<a href="./social_fly/login.php" target="self" style="text-decoration:none;color:black;">
					Social Fly Login
					<span class="badge pull pull-right">Social Fly</span>	
				</a>
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				<a href="./social_boat/login.php" target="self" style="text-decoration:none;color:black;">
					Social Media Boat Login
					<span class="badge pull pull-right">Social Media Boat</span>	
				</a>
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Social Media Automation System</div>
			<div class="panel-body">
				<img src="./social_boat/images/social_media.png" class="img-responsive"/>
			</div>	
		</div>
	</div>
</div> <!--/row-->
</div> <!-- Close Container -->
<footer class="footer-default" style="position: absolute;  bottom: 0;  width: 100%;  height: 30px;  background-color: #f5f5f5;">
  <div class="container-fluid default">
    <p class="text-muted credit" align="center">Design & Developed By <a href="#">Project Team</a> Copyrights &copy; 2023</p>
  </div>
</footer>
</body>
</html>