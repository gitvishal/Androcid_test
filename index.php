<?php
   define('DB_HOST','localhost');
   define('DB_USER','root');
   define('DB_PASSWORD','');
   define('DATABASE','PRSONALINFO');
   if( $_POST["name"] && $_POST["address"] && $_POST["pnumber"] && $_POST["country"] && $_POST["state"]) {

      $pattern=  preg_split("/[\s]+/", $_POST["name"]); 
      $firstname=$pattern[0];
      $lastname=$pattern[1];
      $address=$_POST["address"];
      $pnumber=$_POST["pnumber"];
      $country=$_POST["country"];
      $state=$_POST["state"];

      $con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die('could not connect' . mysql_error()) ;

      $sql = "INSERT INTO users";
      $sql .= "(first_name,last_name,address,phone,country,state)";
      $sql .= "VALUES";
      $sql .= "('$firstname','$lastname','$address','$pnumber','$country','$state')";
      mysql_select_db(DATABASE);
      $retval = mysql_query( $sql, $con ) or die('Could not get data: ' . mysql_error());
      
      mysql_close($con);

      header("Location: view.php"); 
      exit();
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Androcid</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Sample Form</h2>
  <form class="form-horizontal" id="android-form" role="form" method="post" action = "<?php $_PHP_SELF ?>" >
    <div class="form-group " >
      <label class="control-label col-sm-2" for="name">Name:</label>
      <div class="col-sm-4">
        <input type="text" pattern="^[a-zA-Z]+\s+[a-zA-Z]+$" class="form-control" name="name" id="name" placeholder="Firstname Lastname">
      </div>
    </div>
	
    <div class="form-group">
      <label class="control-label col-sm-2" for="address">Address:</label>
      <div class="col-sm-4">          
        <textarea class="form-control" rows="5" id="address" name="address" placeholder="Address"></textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pnumber">Phone Number:</label>
      <div class="col-sm-4">
        <input type="text" pattern="^[0-9]{10}$" class="form-control" id="pnumber" name="pnumber" placeholder="Phone Number">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="country">Country:</label>
       <div class="col-sm-4"> 
         <select class="form-control" id="country" name="country" >
    		
    		
         </select>
	</div>
    </div>
   <div class="form-group">
      <label class="control-label col-sm-2" for="state">State:</label>
       <div class="col-sm-4"> 
         <select class="form-control" id="state"  name="state">
         </select>
	</div>
    </div>
    
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
        <button type="clear" class="btn btn-default">Clear</button>
      </div>
    </div>
  </form>
</div>

 <script>
function validateText(id)
{

	if($("#"+id).val()==null || $("#"+id).val()=="")
	{
		var div=$("#"+id).closest("div");
		div.addClass("has-error");
		return false;
	}
	else return true;
}

function namePattern(id)
{
	if (!($("#"+id).val().match(/^[a-z]+\s+[a-z]+$/i))) {
		var div=$("#"+id).closest("div");
		div.addClass("has-error");
		return false;
	}
	else return true;
}

function phonePattern(id)
{
	if (!($("#"+id).val().match(/^[0-9]{10}$/))) {
		var div=$("#"+id).closest("div");
		div.addClass("has-error");
		return false;
	}
	else return true;

}
   $(document).ready(
     function(){
                 $.getJSON("country.php", function(result){
        		$.each(result, function(key, value){
            			$('#country').append($('<option>', { value : key })
   					     .text(value));
        			});

    			});	

		$( "#android-form" ).submit(function( event ) {
		
			if(!validateText("name") && !namePattern("name"))return false;
			if(!validateText("address"))return false;
			if(!validateText("pnumber"))return false;
			if(!validateText("country"))return false;
			if(!validateText("state"))return false;
			
               });
}

    );

$('#country').change(function(){
			var country=$('#country').val();
			
              
                        $.getJSON("city.php?country="+country, function(result){
				$('#state').empty();
				$.each(result, function(key, value){
            			$('#state').append($('<option>', { value : key })
   					     .text(value));
        			});

			 });
                });



 </script>
</body>
</html>
