<?php

//ma asigur ca datele din user selectat raman in campuri
//select

if (isset($_GET['edit_user'])) {
	$the_user_id = $_GET['edit_user'];

	$query = "SELECT * FROM users WHERE user_id = '{$the_user_id}'";
	$result = mysqli_query($connection,$query);
	if (!$result) {
		die("QUERY FAILED select user ".mysqli_error($connection));
	}
	while ($row = mysqli_fetch_assoc($result)) {
		$user_firstname = $row['user_firstname'];
		$user_lastname = $row['user_lastname'];
		$user_role = $row['user_role'];
		$username = $row['username'];
		$user_email = $row['user_email'];
		$user_password = $row['user_password'];
	}

	// ///////////decriptez parola!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	// $query = "SELECT randSalt FROM users";
	// $result = mysqli_query($connection,$query);
	// if (!$result) {
	// 	die("QUERY FAILED cript " . mysqli_error($connection));
	// }
	// $row = mysqli_fetch_assoc($result);
	// $salt = $row['randSalt'];
	// $hashed_password = crypt($user_password,$salt);

}




//   UPDATE ADD USER
 
if (isset($_POST['create_user'])) {

	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_role = $_POST['user_role'];
	

	// $post_image = $_FILES['image']['name'];
	// $post_image_temp = $_FILES['image']['tmp_name'];

	$username = $_POST['username'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];
	//$post_date = date('d-m-y');
	//$post_comment_count = 0;

	// move_uploaded_file($post_image_temp, "../images/$post_image");


	if (empty($user_password)) {
		echo "PASSWORD MUST BE COMPLETED";
	}
	if (!empty($user_password)) {
		//daca nu-i gol selectez parola aia lunga si criptata din db
		$query = "SELECT user_password FROM users WHERE user_id = '$the_user_id' ";
		$result = mysqli_query($connection,$query);
		if (!$result) {
			die("QUERY FAILED decriptare parola pt afisare " . mysqli_error($connection));
		}
		$row = mysqli_fetch_assoc($result);
		$db_user_password = $row['user_password'];

		//dupa ce am selectat vreau sa o decriptez si sa o fac mica
		if ($db_user_password != $user_password) {
			$hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>12));
		}

		///////////////////////////////////////////////mica schimbare la parola..o decriptez!!!!!!!!!!!!!
		/////////////am pus user_password='{$hashed_password}' in loc de user_password='{$user_password}'
		//ALTA MINUNE BOSS....
		//
		//
		$query = "UPDATE users SET username='{$username}',user_password='{$hashed_password}',user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',user_email='{$user_email}',user_role='{$user_role}' WHERE user_id=$the_user_id";
		$update_user_query = mysqli_query($connection,$query);
		if (!$update_user_query) {
			die("Eroare insert query users " . mysqli_error($connection));
		}

		echo "User Updated " . "<a href='users.php'>View Users</a>";
	}
}

?>

<form action="" method="post" enctype="multipart/form-data">    
     
      
      
	<div class="form-group">
	 	<label for="title">Firstname</label>
	  	<input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
	</div>



	<div class="form-group">
	 	<label for="post_status">Lastname</label>
	 	<input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
	</div>



	<div class="form-group">
		<label for="post_status">Role</label>
	 	<select name="user_role">
	 		<option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
	 	<?php
		//sa apara afisat daca e selectat admin
		if ($user_role == 'admin') {
			echo "<option value='subscriber'>subscriber</option>";
		}else{
			echo "<option value='admin'>admin</option>";
		}

		?>
	 		
			
			
	 	</select>
	</div>



<!-- 
	<div class="form-group">
	 	<label for="post_image">Post Image</label>
	  	<input type="file"  name="image" >
	</div>
 -->
	<div class="form-group">
	 	<label for="post_tags">Username</label>
	 	<input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
	</div>

	<div class="form-group">
	 	<label for="post_tags">Email</label>
	 	<input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
	</div>

	<div class="form-group">
	 	<label for="post_tags">Password</label>
	 	<input type="password" class="form-control" name="user_password" value="">
	 	<?php echo $user_password; ?>
	</div>



	<div class="form-group">
	  	<input class="btn btn-primary" type="submit" name="create_user" value="Publish Post">
	</div>


</form>
    