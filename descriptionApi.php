<html>
<head>
<div class="container-fluid bg-1 text-center">
	<div><h1><strong>Cycle Details<strong></h1></div>
	 <div id="a-right"><h3>WELCOME <?php echo strtoupper($_COOKIE["username"]); ?><h3></div>
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
	      padding: 60px 50px;
	      font-size: 18px;
	 }
	 .asterik {
	     color: red; 	
         }
	.panel-footer .btn {
	    background-color: #1abc9c;
	    color: #fff;
	 }
	.fontBlue{
	    color: blue;
	}
	#a-right{	
	    text-align: right;
        }
</style>
</head>
<?php
  define('DB_SERVER', 'localhost:8080');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '28111988');
  define('DB_DATABASE', 'rentCycles');
  $conn = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
  mysql_select_db(DB_DATABASE);

  if(! $conn ) {
     die('Could not connect: ' . mysql_error());
  }
  $nameId = preg_split('/(?<=\D)(?=\d)|\d+\K/', $_GET['cyclena']);
  $sql = "select * from imgDetails where id = $nameId[1] and name = \"$nameId[0]\"";//(id, name, model, brand, color, quantity, rate, description, username)
  $retval = mysql_query( $sql, $conn );
  if(!$retval)
	echo "Could not fetch ".mysql_error();
  $row = mysql_fetch_array($retval, MYSQL_ASSOC);
?>
<body>
<div class="container-fluid bg-grey">
  <div class="row">
    <div class=" col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <?php echo '<h2><strong>'.$_GET['cyclena'].'</strong></h2>'; ?>
        </div>
        <div class="panel-body">
    <?php echo '<div class="col-sm-4">
			<img src="'.$_GET['cyclena'].'.jpg" alt='.$_GET['cyclena'].' class="img-rounded" width="230" height="236"/>
			
    		</div>
		</br>	
			<div class="col-sm-4">
				<label>Model/Type</label>
			</div>
			<div class="col-sm-2">
				<label class="fontBlue">'.$row['model'].'</label>
			</div>
		</br>	
			<div class="col-sm-4">
				<label>Brand Name</label>
			</div>
			<div class="col-sm-2">
				<label class="fontBlue">'.$row['brand'].'</label>
			</div>
		</br>
			<div class="col-sm-4">
				<label>Color</label>
			</div>
			<div class="col-sm-2">
				<label class="fontBlue">'.$row['color'].'</label>
			</div>
		</br>
			<div class="col-sm-4">
				<label>Available Stock</label>
			</div>
			<div class="col-sm-2">
				<label class="fontBlue">'.$row['quantity'].'</label>
			</div>
		</br>
			<div class="col-sm-4">
				<label>Rate</label>
			</div>
			<div class="col-sm-2">
				<label class="fontBlue">$'.$row['rate'].'/hr</label>
			</div>
		
		</br>
			<div class="col-sm-4">
				<label>Description</label>
			</div>
			<div class="col-sm-2">
				<label class="fontBlue">'.$row['description'].'</label>
			</div>';
           ?>	
        </div>
        <div class="panel-footer">
          	<input type="submit" class="btn btn-lg" name="checkOut" value="Check Out" class="btn btn-info"/>&emsp;
		<a href="#details">Owner Details<span class="caret"></span></a>
	</div>     
   </div>
  </div>  
 </div>
</div>
<pre>





















</pre>
<footer class="container">
   <div id="details">
	<div class="row">
	    <div class="col-md-4">
	      <p><h4>Owner Details</h4></p>
	      <p><span class="glyphicon glyphicon-map-marker"></span>Chicago, US</p>
	      <p><span class="glyphicon glyphicon-phone"></span>Phone: +00 1515151515</p>
	      <p><span class="glyphicon glyphicon-envelope"></span>Email: mail@mail.com</p>	   
	    </div>
        </div>
   </div>
</footer>
</body>
</html>

