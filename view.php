






<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>

</script>
</head>
<body>

<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>address</th>
	<th>phone number</th>
	<th>country</th>
	<th>state</th>
	<th>edit/delete</th>
      </tr>
    </thead>
    <tbody>

 
<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DATABASE','PRSONALINFO');
$con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die('could not connect' . mysql_error()) ;
$sql = 'SELECT * FROM users';

mysql_select_db(DATABASE);
$retval = mysql_query( $sql, $con ) or die('Could not get data: ' . mysql_error());
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    echo "<tr>".
         "<td>{$row['first_name']}</td>".
         "<td>{$row['last_name']}</td>".
         "<td>{$row['address']}</td>".
	 "<td>{$row['phone']}</td>".
	 "<td>{$row['country']}</td>".
	 "<td>{$row['state']}</td>";
      	 
    $id=$row['user_id'];
    echo "<td><div class='btn-group'>" .
         "<button type='button' class='btn btn-primary' ". "onclick='editFunction({$id})'" .">Edit</button>".
         "<button type='button' class='btn btn-primary' ". "onclick='deleteFunction({$id})'" .">Delete</button>".
         "</div></td></tr>";
}

mysql_close($conn);
?>  
    </tbody>
  </table>
</div>

</body>
</html>


