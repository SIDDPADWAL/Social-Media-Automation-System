<?php
$sql = "SELECT * FROM end_user WHERE eustatus=1 AND euid=$euid";
$query = $conn->query($sql);
$result = $conn->query($sql);
  if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$euname=$row['euname'];
		$city=$row['city'];
		$email=$row['email'];
		$imgpath=$row['imgpath'];
	}
  }
?>
<div class="main-left-sidebar no-margin">
<div class="user-data full-width">
<div class="user-profile">
<div class="username-dt">
<div class="usr-pic">
<img src="../social_boat/<?php echo $imgpath;?>" height='100' width='100' alt="">
</div>
</div>
<div class="user-specs">
<h3><?php echo $euname;?></h3>
<span><?php echo $email;?></span>
</div>
</div>
<ul class="user-fw-status">
<li>
<h4>Following</h4>
<span>34</span>
</li>
<li>
<h4>Followers</h4>
<span>155</span>
</li>
<li>
<a href="view-profile.php?euid=<?php echo $euid;?>" title="">View Profile</a>
</li>
</ul>
</div>
<div class="suggestions full-width">
<div class="sd-title">
<h3>Suggestions</h3>
<i class="la la-ellipsis-v"></i>
</div>
<div class="suggestions-list">
<?php
$sql = "SELECT * FROM end_user WHERE eustatus=1 ORDER BY euid DESC LIMIT 6";
$query = $conn->query($sql);
$result = $conn->query($sql);
  if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
echo"<div class='suggestion-usd'>
<img src='../social_boat/".$row['imgpath']."' height='50' width='50' alt=''>
<div class='sgt-text'>
<h4>".$row['euname']."</h4>
<span>".$row['city']."</span>
</div>
<span><i class='la la-plus'></i></span>
</div>";
	}
  }
?>
</div>
</div>

</div>
</div>