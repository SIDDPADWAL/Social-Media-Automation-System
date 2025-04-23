function delete_post(post_id = null) {
	if(post_id) {
		var r = confirm("Are You Sure To Delete Post?");
		if(r==true){
			$.ajax({
				url: './delete_post.php',
				type: 'post',
				data: {post_id : post_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Post Deleted Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
