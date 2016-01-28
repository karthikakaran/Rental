
<html>
<head>
<div class="container-fluid bg-1 text-center">
	<div><h2><strong>Fill Cycle Details<strong></h2></div>
</div>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<style>
	 .bg-1 { 
	      background-color: #1abc9c;
	      color: #ffffff;
	 }
	 .container-fluid {
	      padding-top: 20px;
	      padding-bottom: 20px;
	 }
	 .asterik {
	     color: red; 	
         }
</style>
</head>
<body>
<div class="container">
    <form role="form" action = "" method = "post"  enctype = "multipart/form-data">
	</br>
	<div class="row">
		<div class="col-sm-4">
			<label>Name<span class="asterik">*</span></label>
		</div>
		<div class="col-sm-2">
			<input class="form-control" name="name" id="ex1" type="text" placeholder="Enter name" required/>
		</div>
	</div>
	</br>	
	<div class="row">
		<div class="col-sm-4">
			<label>Model/Type<span class="asterik">*</span></label>
		</div>
		<div class="col-sm-2">
			<select class="form-control" name="model" id="ex1" required/>
				<option>Select</option><option>Gear Cycle</option>
				<option>Gearless cycle</option>
			</select>
		</div>
	</div>
	</br>	
	<div class="row">
		<div class="col-sm-4">
			<label>Brand Name<span class="asterik">*</span></label>
		</div>
		<div class="col-sm-2">
			<input class="form-control" name="brand" id="ex1" type="text" placeholder="Enter brand name" required/>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-4">
			<label>Color<span class="asterik">*</span></label>
		</div>
		<div class="col-sm-2">
			<input class="form-control" name="color" id="ex1" type="text" placeholder="Enter color" required/>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-4">
			<label>Quantity(between 1 and 5)<span class="asterik">*</span></label>
		</div>
		<div class="col-sm-2">
			<input class="form-control" name="quantity" type="number" placeholder="Enter quantity"  min="1" max="5" required/>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-4">
			<label>Rate<span class="asterik">*</span></label>
		</div>
		<div class="col-sm-2">
			<input  class="form-control" name="rate" type="number" placeholder="$0/hr"  min="2" max="5" required/>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-4">
			<label>Description<span class="asterik">*</span></label>
		</div>
		<div class="col-sm-4">
			<textarea class="form-control" name="description" rows="5" cols="50" required></textarea>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col-sm-4">
			<label>Upload Image<span class="asterik">*</span></label>
		</div>
		<div class="col-sm-2">
			<input class="form-control" name="cycleImage" type="file" required/><!--<input type="submit" value="Upload">-->
		</div>
	</div>
	</br>
	<div class="col-sm-8">
		<button type="submit" name="save" value="save" class="btn btn-info">Save</button>&emsp;<button type="reset" class="btn btn-info">Cancel</button>
	</div>
    </form>
</div>
</body>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
  
   if($_POST['save'] == "save"){
	   define('DB_SERVER', 'localhost:8080');
	   define('DB_USERNAME', 'root');
	   define('DB_PASSWORD', '28111988');
	   define('DB_DATABASE', 'rentCycles');
	   $conn = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

	   if(! $conn ) {
	      die('Could not connect: ' . mysql_error());
	   }
	   mysql_select_db(DB_DATABASE);
	   if(isset($_FILES['cycleImage'])){
	      $file_type = strtolower(end(explode('.', $_FILES['cycleImage']['name'])));
	   }
	   $sql = "INSERT INTO CycleImgs (name, type) VALUES (\"".$_POST['name']."\",\"".$file_type."\")";
	   $retval = mysql_query( $sql, $conn );
	   
	   $sql1 = 'SELECT max(imgId) FROM CycleImgs';
	   $retval1 = mysql_query( $sql1, $conn );
	   $row = mysql_fetch_array($retval1, MYSQL_NUM);
      
           if(isset($_FILES['cycleImage'])){
	      $file_name = $_POST['name'].$row[0].".".$file_type;
	 
	      $target = "/home/vaishthiru/PHPProj/";
	      $target = $target . basename($file_name);

	      if(move_uploaded_file($_FILES['cycleImage']['tmp_name'], $target))
		  echo "The file ".$file_name. " has been uploaded";
	      //else
		//  echo "Sorry, there was a problem uploading your file.";
           }
	   $sql2 = "INSERT INTO imgDetails (id, name, model, brand, color, quantity, rate, description, username) VALUES (".$row[0].",\"".$_POST['name']."\",\"".$_POST['model']."\",\"".$_POST['brand']."\",\"".$_POST['color']."\",".$_POST['quantity'].",".$_POST['rate'].",\"".$_POST['description']."\",\"".$_COOKIE['username']."\")"; 
	   $retval2 = mysql_query( $sql2, $conn );
	 	
	   if(!$retval || !$retval1 || !$retval2)
		echo "Enter Proper Values ".mysql_error();
	   else if($retval && $retval1 && $retval2)
	   	echo "<h2 class='bg-success text-center'>Image Details Saved Successfully!!!\n</h2>"; 
	   
	   mysql_close($conn);   
   }
}
?>
</html>

