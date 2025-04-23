function like(post_id = null) {
	if(post_id) {
			$.ajax({
				url: './like_post.php',
				type: 'post',
				data: {post_id : post_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	}
	else {
		alert('error! refresh the page again');
	}	
}