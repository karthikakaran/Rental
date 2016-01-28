<html>
<head>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	 <style>
	  .bg-1 { 
	      background-color: #1abc9c;
	      color: #ffffff;
	  }
	  .container-fluid {
	      padding-top: 30px;
	      padding-bottom: 30px;
	  }	
	  .btn-circle {
	       width: 35px;
	       height: 35px;
	       text-align: center;
	       padding: 2px 0;
	       font-size: 20px;
	       line-height: 1.65;
	       border-radius: 25px;
	  }
	  #a-right{	
		text-align: right;
	  }		
  	</style>						
</head>
<body>
<?php
	define('DB_SERVER', 'localhost:8080');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '28111988');
	define('DB_DATABASE', 'rentCycles');
	   $conn = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

	   if(! $conn ) {
	      die('Could not connect: ' . mysql_error());
	   }
	   
	   $sql = 'SELECT name, imgId, type FROM CycleImgs';
	   mysql_select_db(DB_DATABASE);
	   $retval = mysql_query( $sql, $conn );
	   
	   if(! $retval ) {
	      die('Could not get data: ' . mysql_error());
	   }   
?>
<div class="container-fluid bg-1 text-center">
  <div id="a-right"><h3>WELCOME <?php echo strtoupper($_COOKIE["username"]); ?><h3></br>
  <form action="rentCycleUpload.php" method="post"  > 
  	<input class="btn btn-default" type="submit" name="rentCycles" value="RENT CYCLES"/>
  </form></div>
  <img src="cycle1.jpg" class="img-circle" alt="cycle1.img" width="150" height="150">
 <h2><strong>Cycles for Rent</strong></h2>
</div>
<div class="container-fluid text-center"> 
  <div class="row">
    <form role="form" action = "" method = "post">
    <?php $qty=0;
        while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
		echo '<div class="col-sm-4">
	      	<p><strong>'.$row['name'].$row['imgId'].'</strong></p><br>
	      	<a href="descriptionApi.php?cyclena='.$row['name'].$row['imgId'].'"><img src='.$row['name'].$row['imgId'].'.'.$row['type'].' alt='.$row['name'].$row['imgId'].' class="img-rounded" width="304" height="236"/></a>
		</br> 
		<p> 
		    <input type="submit" class="btn btn-circle btn-info" name="plus" value="+"/>
		    <input type="text" size="2" name="qtyVal" value="'. $qty.'"/>
                    <input type="submit" class="btn btn-circle btn-info" name="plus" value="-"/>
		<p>
	    	</div>';
	}
    ?>
    </form>
</div>
<?php 
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if($_POST['plus'] == "+")
			$qty = $qty + 1;
		else if($_POST['plus'] == "-")
			$qty = $qty - 1;
	}
	mysql_close($conn); 
?>
</body>
</html>
