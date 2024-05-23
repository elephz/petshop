<?php 
define('DB_NAME', 'eggshop');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
$con = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
date_default_timezone_set("Asia/Bangkok");
$con->set_charset("utf8");

?>