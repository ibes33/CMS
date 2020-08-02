<?php 

$con = mysqli_connect('localhost','my_login_user','tEI5F~c2Vy=s','my_login_app_db');
if (!$con) {
	die("EROARE la conectarea in baza de date " . mysqli_error($con));
}

function row_count($result){
	return mysqli_num_rows($result);
}

function escape($string){

	global $con;

	return mysqli_real_escape_string($con, $string);

}

function query($query){

	global $con;

	return mysqli_query($con,$query);

}

function confirm($result){

	global $con;

	if(!$result){
		die("QUERY FAILED " . mysqli_error($con));
	}

}

function fetch_array($result){

	global $con;

	return mysqli_fetch_array($result);

}


?>