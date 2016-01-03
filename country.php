<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('WORLD','world');

$con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or 
				die('could not connect' . mysql_error()) ;
$sql = 'SELECT Code ,Name from Country';
mysql_select_db(WORLD);
$retval = mysql_query( $sql, $con ) or 
				die('Could not get data: ' . mysql_error());
$result = array();
while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
$code=utf8_encode($row['Code']);
$name=utf8_encode($row['Name']);
	$result = array_merge($result, array("{$code}" => "{$name}"));

}
print_r(json_encode($result, JSON_PRETTY_PRINT));


mysql_close($con);
?>
