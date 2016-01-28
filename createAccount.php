<!DOCTYPE html>
<html lang="en">
<head>
  <style>
	.bg-1 { 
	      background-color: #1abc9c;
	      color: #ffffff;
	  }
	  .container-fluid {
	      padding-top: 30px;
	      padding-bottom: 30px;
	  }
	  .asterik {
	     color: red; 	
          }
  </style>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <div class="container-fluid bg-1 text-center">
  	<div><h2><strong>Create Account<strong></h2></div>
  </div>
</head>
<body>
  <div class="container">
    <form role="form" action = "" method = "post">
	</br>
	<div class="row">
		<div class="col-sm-2">
			<label>Email<span class="asterik">*</span></label>
		</div>
		<div class="col-sm-2">
			<input class="form-control" name="email" id="ex1" type="email" placeholder="Enter email" required>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-2">
			<label>Username<span class="asterik">*</span></label>
		</div>		
		<div class="col-sm-2">
			<input class="form-control" name="username" id="ex1" type="text" placeholder="Enter username" required>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-2">
			<label for="pwd">Password<span class="asterik">*</span></label>
		</div>		
		<div class="col-sm-2">
			<input class="form-control" name="password" id="pwd" type="password" placeholder="Enter password" required>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-2">
			<label for="pwd">Retype Password<span class="asterik">*</span></label>
		</div>		
		<div class="col-sm-2">
			<input class="form-control" name="retypePass" id="pwd" type="password" placeholder="Retype password" required>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-2">
			<label>Phone Number<span class="asterik">*</span></label>
		</div>		
		<div class="col-sm-2">
			<input class="form-control" name="phoneNo" id="ex1" type="phone" placeholder="Phone Number" required>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-2">
			<label>Address 1<span class="asterik">*</span></label>
		</div>		
		<div class="col-sm-2">
			<input class="form-control" name="address1" id="ex1" type="text" placeholder="Address" required>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-2">
			<label>Address 2</label>
		</div>		
		<div class="col-sm-2">
			<input class="form-control" name="address2" id="ex1" type="text" placeholder="Address">
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-2">
			<label>City<span class="asterik">*</span></label>
		</div>		
		<div class="col-sm-2">
			<input class="form-control" name="city" id="ex1" type="text" placeholder="City" required>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-2">
			<label>State<span class="asterik">*</span></label>
		</div>		
		<div class="col-sm-2">
			<input class="form-control" name="state" id="ex1" type="text" placeholder="State" required>
		</div>
	</div>
	</br>
	
	<div class="row">
		<div class="col-sm-2">
			<label>Postal Code<span class="asterik">*</span></label>
		</div>		
		<div class="col-sm-2">
			<input class="form-control" name="postalCode" id="ex1" type="text" placeholder="Postal Code" maxlength="10" required>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-2">
			<label for="SSN">SSN Id<span class="asterik">*</span></label>
		</div>		
		<div class="col-sm-2">
			<input class="form-control" name="ssn" id="ex1" type="text" placeholder="###-##-####" maxlength="12" minlength="10" required>
		</div>
	</div>
	</br>
	<div class="col-sm-8">
		<button type="submit" class="btn btn-info">Create Account</button>&emsp;<button type="reset" class="btn btn-info">Cancel</button>
	</div>
    </form>
  </div>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
   if($_POST['password'] != $_POST['retypePass'])
	echo "<h2 class='bg-warning text-center'>Password Mismatch!</h2>";
   else{
   define('DB_SERVER', 'localhost:8080');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '28111988');
   define('DB_DATABASE', 'rentCycles');
   $conn = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }
   
   $sql = "INSERT INTO userdetails (username, password) VALUES (\"".$_POST['username']."\",\"".$_POST['password']."\")";
   $sql1 = "INSERT INTO userPerDetails (username, email, phoneNo, address1, address2, city, state, postalCode, Ssn) VALUES (\"".$_POST['username']."\",\"".$_POST['email']."\",\"".$_POST['phoneNo']."\",\"".$_POST['address1']."\",\"".$_POST['address2']."\",\"".$_POST['city']."\",\"".$_POST['state']."\",\"".$_POST['postalCode']."\",\"".$_POST['ssn']."\")";

   mysql_select_db(DB_DATABASE);
   $retval = mysql_query( $sql, $conn );
   $retval1 = mysql_query( $sql1, $conn );

   if(!$retval || !$retval1) {
	if(mysql_errno() == 1062)
	    echo "<h2 class='bg-danger text-center'>UserName exists, enter a different name!</h2>";
      	    die();
   } else if($retval && $retval1)
   	echo "<h2 class='bg-success text-center'>Created account successfully!!!\n</h2>"; 
   mysql_close($conn);
   }
}
?>
 </body>
</html>

