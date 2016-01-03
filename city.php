<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('WORLD','world');
$country=$_GET["country"];
$con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or 
				die('could not connect' . mysql_error()) ;
$sql = "SELECT DISTINCT District  from City where CountryCode='$country'";
mysql_select_db(WORLD);
$retval = mysql_query( $sql, $con ) or 
				die('Could not get data: ' . mysql_error());
$result = array();

while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
	$name=utf8_encode($row['District']);
	$result = array_merge($result, array("{$name}" => "{$name}"));

}
print_r(json_encode($result,JSON_FORCE_OBJECT|JSON_PRETTY_PRINT));


mysql_close($con);
?>
