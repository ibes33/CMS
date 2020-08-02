<?php

//select

if (isset($_GET['p_id'])) {
	$the_post_id = $_GET['p_id'];
	

	$query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}'";
	$select_posts = mysqli_query($connection,$query);
	if (!$select_posts) {
	    die("Eroare query select post " . mysqli_error($connection));
	}

	while ($row = mysqli_fetch_assoc($select_posts)) {
		$post_user = $row['post_user'];
	    $post_category_id = $row['post_category_id'];
	    $post_title = $row['post_title'];
	    $post_author = $row['post_author'];
	    $post_data = $row['post_data'];
	    $post_image = $row['post_image'];
	    $post_content = $row['post_content'];
	    $post_tags = $row['post_tags'];
	    $post_comment_count = $row['post_comment_count'];
	    $post_status = $row['post_status'];
	    $post_id = $row['post_id'];
	}

}

	
// //update

// echo $the_post_id;
if (isset($_POST['update_post'])) {

	$post_title = $_POST['title'];
	$post_author = $_POST['author'];
	$post_category_id = $_POST['post_category'];
	$post_status = $_POST['post_status'];

	$post_image = $_FILES['image']['name'];
	$post_image_temp = $_FILES['image']['tmp_name'];

	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];
	$post_date = date('d-m-y');
	// $post_comment_count = 4;

 

	move_uploaded_file($post_image_temp, "../images/$post_image");

//verific sa ramana imaginea

	if (empty($post_image)) {
		$query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}'";
		$select_img = mysqli_query($connection,$query);
		if (!$select_img) {
			die("ERROR QUERY SELECT IMG".mysql_error($connection));
		}
		while ($row = mysqli_fetch_array($select_img)) {
			$post_image = $row['post_image'];
		}
	}

// //query update

	$query = "UPDATE posts SET post_category_id='{$post_category_id}',post_title='{$post_title}',post_author='{$post_author}',post_data=now(),post_image='{$post_image}',post_content='{$post_content}',post_tags='{$post_tags}',post_status='{$post_status}' WHERE post_id='{$the_post_id}'";
	$update_post_query = mysqli_query($connection,$query);
	if (!$update_post_query) {
		die("Eroare update query " . mysqli_error($connection));
	}

	echo "<p class='bg-success'>Post Updated <a href='../post.php?p_id={$the_post_id}'>View post</a> or <a href='posts.php'>Edit Another Post</a> </p> ";

}



?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
	<div class="form-group">
	 	<label for="title">Post Title</label>
	  	<input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
	</div>

	<div class="form-group">
		<label for="category">Post Category Id</label>
		<!-- 
	  	<input value="<?php echo $post_category_id; ?>" type="text" class="form-control" name="post_category_id">
	  	 -->
	  	<select name="post_category" id="post_category">

			<?php

	  		$query = "SELECT * FROM categories";
	  		$result = mysqli_query($connection,$query);
	  		if (!$result) {
	  			die("Query FAIL" . mysqli_error($connection));
	  		}

	  		while ($row = mysqli_fetch_assoc($result)) { 
	  			$cat_id = $row['cat_id'];
	  			$cat_title = $row['cat_title'];
	  			//echo "<option value='$cat_id'>{$cat_title}</option>";
				if ($cat_id == $post_category_id) {
					echo "<option value='$cat_id' selected>{$cat_title}</option>";
				} else {
					echo "<option value='$cat_id'>{$cat_title}</option>";
				}
	  		}

	  		?> 
 
	  	</select>
	</div>



	<div class="form-group">
	 	<label for="title">Post Author</label>
	 	<select name="author">
	 		<?php  
	 		echo "<option value='$post_author'>$post_author</option>";

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




<!-- 	<div class="form-group">
	 	<label for="title">Post Author</label>
	  	<input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
	</div>
 -->


	<div class="form-group">
	 	<label for="post_status">Post Status</label>
<!-- 
	 	<input value="<?php echo $post_status; ?>"  type="text" class="form-control" name="post_status">
-->
		<select name="post_status" id="">
			<option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
			<?php
				if ($post_status == 'public') {
					echo "<option value='private'>Private</option>";
				}else{
					echo "<option value='public'>Public</option>";
				}
			?>
		</select>
	</div>



	<div class="form-group">
 	 	<label for="post_image">Post Image</label>
	  	<input type="file"  name="image" > 
	  	<img width='100' src="../images/<?php echo $post_image; ?>">
	</div>

	<div class="form-group">
	 	<label for="post_tags">Post Tags</label>
	 	<input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
	 	<label for="post_content">Post Content</label>
	 	<textarea  class="form-control "name="post_content" id="body" cols="30" rows="10"><?php echo $post_content; ?>
	 	</textarea>
	</div>



	<div class="form-group">
	  	<input class="btn btn-primary" type="submit" name="update_post" value="Publish Post">
	</div>


</form>
    