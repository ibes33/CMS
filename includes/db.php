<?php

// $db['db_host'] = "localhost";
// $db['db_user'] = "demo_cms_user";
// $db['db_pass'] = "eR9R2}m(eMOf";
// $db['db_name'] = "demo_cms_db";

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";

foreach ($db as $key => $value) {
	define(strtoupper($key), $value);
}


$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if (!$connection) {
	die("Connection FAILED " . mysqli_error());
}
/*
if($connection){
    echo "We are connected";
}else{
    echo "We are NOt connected";
}
*/


?>