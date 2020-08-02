<?php

/*********************  HELPER FUNCTION  **********************/

function clean($string){
	return htmlentities($string);
}

function redirect($location){
	return header("location: {$location}");
}

function set_message($message){
	if (!empty($message)) {
		$_SESSION['message'] = $message;
	}else{
		$message = "";
	}
}

function display_message(){
	if (isset($_SESSION['message'])) {

		echo $_SESSION['message'];
		
		unset($_SESSION['message']);
	
	}
}

function token_generator(){
	$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));
	return $token;
}

function username_exist($username=''){
	$result = query("SELECT * FROM users");
	confirm($result);
	$row = fetch_array($result);

	if ($username == $row['username']) {
		return true;
	}else{
		return false;
	}
}

function email_exist($email=''){
	$result = query("SELECT * FROM users");
	confirm($result);
	$row = fetch_array($result);

	if ($email == $row['email']) {
		return true;
	}else{
		return false;
	}
}

function send_email($email, $subject, $msg, $headers){
	return mail($email, $subject, $msg, $headers);
}

/*********************  VALIDATION FUNCTION  **********************/

function validate_user_register(){

	$errors = [];
	$min = 3;
	$max = 20;

	if ($_SERVER['REQUEST_METHOD'] == "POST" ) { //start if post
		
		$first_name = 		clean($_POST['first_name']);	
		$last_name = 		clean($_POST['last_name']);
		$username = 		clean($_POST['username']);
		$email = 			clean($_POST['email']);
		$password = 		clean($_POST['password']);
		$confirm_password = clean($_POST['confirm_password']);

		//first_name
		if (strlen($first_name) < $min ) {
			$errors[] = "Your <b>First Name</b> cannot be less than {$min} characters ";
		}

		if (strlen($first_name) > $max ) {
			$errors[] = "Your <b>First Name</b> cannot be more than {$max} characters ";
		}

		//last_name
		if (strlen($last_name) < $min ) {
			$errors[] = "Your <b>Last Name</b> cannot be less than {$min} characters ";
		}

		if (strlen($last_name) > $max ) {
			$errors[] = "Your <b>Last Name</b> cannot be more than {$max} characters ";
		}

		//username
		if (strlen($username) < $min ) {
			$errors[] = "Your <b>Username</b> cannot be less than {$min} characters ";
		}

		if (strlen($username) > $max ) {
			$errors[] = "Your <b>Username</b> cannot be more than {$max} characters ";
		}

		if (username_exist($username)) {
			$errors[] = "Username already exist! ";
		}

		//email
		if (email_exist($email)) {
			$errors[] = "Email already exist! ";
		}

		//password
		if (strlen($password) < 6 ) {
			$errors[] = "Your <b>Password</b> cannot be less than 6 characters ";
		}

		if ($password !== $confirm_password) {
			$errors[] = "Your <b>password</b> field do not match";
		}

		

		if (!empty($errors)) {
			foreach ($errors as $error) {

			//afisez mesaj de eroare de validare
			$message = <<<DELIMITER

			<div class="alert alert-danger alert-dismissible" role="alert">
			  
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>

			  <strong>Warning!</strong> $error

			</div>
			DELIMITER;

			echo $message;
			//end

			}
		}else{

			if (register_user($first_name, $last_name, $username, $email, $password)) {

				set_message("<p class='bg-success text-center'>Please check your email or spam folder for activation link</p>");

				redirect("index.php");

				//afisez mesaj ca a fost creat cu succes utilizatorul
				$message = <<<DELIMITER
				<div class="alert alert-success" role="alert">
					Your account was created successfully!
				</div>
				DELIMITER;
				echo $message;
				//end

			}

			
		}


	
	} //end if post

} // end function


/*********************  REGISTER USER FUNCTION  **********************/


function register_user($first_name, $last_name, $username, $email, $password){

	$first_name = 	escape($_POST['first_name']);	
	$last_name 	= 	escape($_POST['last_name']);
	$username 	= 	escape($_POST['username']);
	$email 		= 	escape($_POST['email']);
	$password 	= 	escape($_POST['password']);

	if (email_exist($email)) {
		return false;
	}else if (username_exist($username)) {
		return false;
	}else{

		$password = md5($password);
		$validation_code = md5($username . microtime());

		$result = query("INSERT INTO users(first_name, last_name, username, email, password, validation_code, active) VALUES ('{$first_name}','{$last_name}','{$username}','{$email}','{$password}','{$validation_code}',0)");
		confirm($result);


		$subject = "Activate Account";
		$msg = "Please click the link below to activate your Account

		http://localhost/UDEMY/PHPLogin/activate.php?email={$email}&code={$validation_code}

		";
		$headers = "From: sebi_msm@yahoo.com";

		send_email($email, $subject, $msg, $headers);


		return true;

	}

} //end function 


/*********************  ACTIVATE USER FUNCTION  **********************/

function activate_user(){

	if ($_SERVER['REQUEST_METHOD'] == "GET" ) {
		if (isset($_GET['email'])) {
			
			$email = clean($_GET['email']);
			$validation_code = clean($_GET['code']);

			$result = query("SELECT id FROM users WHERE email='" .escape($_GET['email']). "' AND validation_code='" .escape($_GET['code']). "' ");
			confirm($result);

			if (row_count($result) == 1 ) {

				$result2 = query("UPDATE users SET active=1, validation_code=0 WHERE  email='".escape($email)."' AND validation_code='".escape($validation_code)."' ");
				confirm($result2);

				set_message("<p class='bg-success'>Your account has been activated please login</p>");

				redirect("login.php");

			}


		}
	} //end if 

} //end function


/*********************  VALIDATE USER LOGIN FUNCTION  **********************/

function validate_user_login(){

		$errors = [];
		$min = 3;
		$max = 20;

	if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
		
		$email = clean($_POST['email']);
		$password = clean($_POST['password']);
		$remember = isset( $_POST['remember'] );



		if (empty($email)) {
			$errors[] = "This field cannot be empty";
		}

		if (empty($password)) {
			$errors[] = "This field cannot be empty";
		}

		if (!empty($errors)) {
			foreach ($errors as $error) {
				
			//afisez mesaj de eroare de validare
			$message = <<<DELIMITER

			<div class="alert alert-danger alert-dismissible" role="alert">
			  
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>

			  <strong>Warning!</strong> $error

			</div>
			DELIMITER;

			echo $message;
			//end


			}
		}else{
				
				if (login_user($email, $password, $remember)) {
					redirect("admin.php");
				}else{
					//afisez mesaj de eroare de validare
				$message = <<<DELIMITER
				<div class="alert alert-danger" role="alert">
					LOGIN FAILED!
				</div>
				DELIMITER;
				echo $message;
					//end
				}

			}

	} //end if 

} //end function

/*********************  USER LOGIN FUNCTION  **********************/

function login_user($email, $password, $remember){

	$result = query("SELECT password, id FROM users WHERE email='".escape($email)."' AND active=1");
	confirm($result);

	if (row_count($result) ==1 ) {
		
		$row = fetch_array($result);

		$db_password = $row['password'];

		if (md5($password)==$db_password ) {

			//set remember
			if ($remember == "on") {
				setcookie('email', $email, time() + 86400 );
			}
			//

			$_SESSION['email'] = $email;
			return true;
		}else{
			return false;
		}



	}

} //end function

/*********************  USER LOGIN FUNCTION  **********************/
function logged_in(){

	if ( isset($_SESSION['email']) || isset($_COOKIE['email']) ) {
		return true;
	}else{
		return false;
	}

}


/*********************  RECOVER PASSWORD FUNCTION  **********************/
function recover_password(){

	if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
		
		if ( isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token'] ) {
			

			$email = clean($_POST['email']);

			if (email_exist($email)) {
				
				$validation_code = md5($email . microtime());

				setcookie('temp_access_code', $validation_code, time() + 900);

				$result = query("UPDATE users SET validation_code='".escape($validation_code)."' WHERE email='".escape($email)."' ");
				confirm($result);

				$subject = "Please reset your password";
				$message = "Here is your password rest code {$validation_code}

				Click here to reset your password http://localhost/UDEMY/PHPLogin/code.php?email=$email&code=$validation_code

				";

				$headers = "From: sebi_msm@yahoo.com";
				

				if (!send_email($email, $subject, $message, $headers)) {
					echo "email nu este trimis";
				}

				set_message("te rog verifica mail-ul");

				redirect("index.php");


			}else{
				echo "email not exist";
			}


		}else{
			redirect("index.php");
		}


		if (isset($_POST['cancel_submit'])) {
			redirect("index.php");
		}



	}

} //end function


/*********************  CODE VALIDATION FUNCTION  **********************/
function validate_code(){

	if (isset($_COOKIE['temp_access_code'])) {
		

			
		if ( !isset($_GET['email']) && !isset($_GET['code']) ) {
			redirect("index.php");
		}else{

			if (isset($_POST['code'])) {
				
				$email = clean($_GET['email']);
				$validation_code = clean($_POST['code']);

				$result = query("SELECT id FROM users WHERE validation_code='".escape($validation_code)."' AND email='".escape($email)."' ");
				confirm($result);

				if (row_count($result) ==1 ) {
					setcookie('temp_access_code', $validation_code, time() + 900);
					redirect("reset.php?email=$email&code=$validation_code");
				}else{
					echo "sorry wrong validation code";
				}

			}

		}



	}else{

		set_message("cokkie-ul tau a expirat..sorry :( ");

		redirect("recover.php");

	}

}

/*********************  PASSWORD RESET FUNCTION  **********************/
function password_reset(){

	if (isset($_COOKIE['temp_access_code'])) {

		if ( isset($_GET['email']) && isset($_GET['code']) ) {

			if ( isset($_SESSION['token']) && isset($_POST['token']) && $_POST['token'] === $_SESSION['token'] ) {

				if ( $_POST['password'] === $_POST['confirm_password'] ) {

					$update_password = md5($_POST['password']);

					$result = query("UPDATE users SET password ='".escape($update_password)."', validation_code=0 WHERE email ='".escape($_GET['email'])."'  ");
					confirm($result);

					set_message("Your password has been update!");

					redirect("login.php");
	

				}else{

					echo "The password is not the same!";

				}

			}

		}

	}else{
		set_message("Sorry your message has expired");
		redirect("recover.php");
	}


} //end function


?>