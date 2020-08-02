<?php


//   INSERT ADD POSTS
 
if (isset($_POST['create_post'])) {
	$post_title = escape($_POST['title']); 
	$post_author = escape($_POST['author']);
	$post_category_id = escape($_POST['post_category_id']);
	$post_status = escape($_POST['post_status']);

	$post_image = escape($_FILES['image']['name']);
	$post_image_temp = escape($_FILES['image']['tmp_name']);

	$post_tags = escape($_POST['post_tags']);
	$post_content = $_POST['post_content'];
	$post_date = date('d-m-y');
	//$post_comment_count = 0;

	move_uploaded_file($post_image_temp, "../images/$post_image");

	$query = "INSERT INTO posts(post_category_id,post_title,post_author,post_data,post_image,post_content,post_tags,post_status) VALUES ('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
	$create_post_query = mysqli_query($connection,$query);
	if (!$create_post_query) {
		die("Eroare insert query " . mysqli_error($connection));
	}

	$the_last_id_post = mysqli_insert_id($connection);

	echo "Post Add " . "<a href='../post.php?p_id={$the_last_id_post}'>View Post</a>";

}

?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
	<div class="form-group">
	 	<label for="title">Post Title</label>
	  	<input type="text" class="form-control" name="title">
	</div>



	<div class="form-group">
		<label for="post_category">Post Category Id</label>
<!-- 		
	  	<input type="text" class="form-control" name="post_category_id">
 -->

 	<select name="post_category_id">
 		<?php

 		$query = "SELECT * FROM categories";
 		$result = mysqli_query($connection,$query);
 		if (!$result) {
 			die("QUERY FAIL" . mysqli_error($connection));
 		}
 		while ($row = mysqli_fetch_assoc($result)) {
 			$cat_id = $row['cat_id'];
 			$cat_title = $row['cat_title'];
 			echo "<option value='$cat_id'>{$cat_title}</option>";
 		}

 		?>

 	</select>

	</div>





	<div class="form-group">
	 	<label for="title">Post Author</label>
	 	<select name="author">
	 		<?php  

	 		$query_u = "SELECT * FROM users";
	 		$result_u = mysqli_query($connection,$query_u);
	 		if (!$result_u) {
	 			die("QUERY FAILED select users in add post " . mysqli_error($connection));
	 		}
	 		while ($row = mysqli_fetch_assoc($result_u)) {
	 			$user_id = $row['user_id'];
	 			$username = $row['username'];
	 			echo "<option value='$username'>$username</option>";
	 		}
	 		

	 		?>
	 		
	 	</select>
	</div>



<!-- 
	<div class="form-group">
	 	<label for="title">Post Author</label>
	  	<input type="text" class="form-control" name="author">
	</div>
 -->


	<div class="form-group">
	 	<label for="post_status">Post Status</label>
	 	<!-- <input type="text" class="form-control" name="post_status"> -->
	 	<select name="post_status">
	 		<option value="private">Select Option</option>
	 		<option value="public">public</option>
	 		<option value="private">private</option>
	 	</select>
	</div>




	<div class="form-group">
	 	<label for="post_image">Post Image</label>
	  	<input type="file"  name="image" >
	</div>

	<div class="form-group">
	 	<label for="post_tags">Post Tags</label>
	 	<input type="text" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
	 	<label for="post_content">Post Content</label>
	 	<textarea class="form-control "name="post_content" id="body" cols="30" rows="10">
	 	</textarea>
	</div>


	<div class="form-group">
	  	<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
	</div>


</form>
    