<?php 	
//require_once 'core.php';
require_once './lock.php';
require_once './conn.php';
$valid['success'] = array('success' => false, 'messages' => array());
$post_id = $_POST['post_id'];
if($post_id) {
	$sql = "SELECT * FROM likes WHERE post_id=$post_id AND euid=$euid AND status=1";
	 $query = $conn->query($sql);
	 if($query->num_rows >0){
		 $sql = "DELETE FROM likes WHERE post_id=$post_id AND euid=$euid AND status=1";
		 if($conn->query($sql) === TRUE ) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Removed";		
		 } else {
			$valid['success'] = false;
			$valid['messages'] = "Error while remove the brand";
			 }
	 }
	 else{
		 $sql = "INSERT INTO likes (post_id, euid, status) VALUES ($post_id, $euid, 1)";
		 if($conn->query($sql) === TRUE ) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Removed";		
		 } else {
			$valid['success'] = false;
			$valid['messages'] = "Error while remove the brand";
			 }
	}
 $conn->close();
 echo json_encode($valid);
} // /if $_POST