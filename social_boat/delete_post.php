<?php 	
//require_once 'core.php';
require_once 'conn.php';
$valid['success'] = array('success' => false, 'messages' => array());
$post_id = $_POST['post_id'];
if($post_id) { 
 $sql = "UPDATE post SET post_status=0 WHERE post_id = $post_id";
 if($conn->query($sql) === TRUE ) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 $conn->close();
 echo json_encode($valid);
} // /if $_POST