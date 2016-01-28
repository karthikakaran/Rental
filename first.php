<html>
<title>Rental cycles</title>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<div class="container-fluid bg-1 text-center">
	<h1><center><strong>Rental Cycles</strong></center></h1>
</div>
<style>
	.bg-1 { 
	      background-color: #1abc9c;
	      color: #ffffff;
	 }
	 .container-fluid {
	      padding-top: 20px;
	      padding-bottom: 20px;
	 }
	body {
	    background-image: url("cycle1.jpg");
	    background-repeat: no-repeat;
	}
	div{
	    color:black;
	    font-weight: bold;
	}
</style>
</head>
<?php
	define('DB_SERVER', 'localhost:8080');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '28111988');
	define('DB_DATABASE', 'rentCycles');
	$dbConn = mysql_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	if(! $dbConn ) {
	   die('Could not connect: ' . mysql_error());
	}
	$sql = 'Select username, password from userdetails';
	mysql_select_db('rentCycles');
	$retval = mysql_query( $sql, $dbConn );
	 if(! $retval ) {
	      die('Could not get data: ' . mysql_error());
	 }
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		echo "";
		switch($_POST["cycleAction"]){
			    case "Submit":
		//function CycleView(){
				while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
					if ($_POST['username'] == $row['username'] && $_POST['password'] == $row['password']){
						setcookie("username", $row['username'], time() + 3600, "/","", 0);
						header('location: cyclesView.php');
					 }
				}
		//}
				echo "<h2 class='bg-danger text-center'>Invalid Username or Password!!</h2>";
				break;
			    case "CreateAccount":
				header('location: createAccount.php');
				break;
		}
	}
	mysql_close($dbConn);
?>
   <body>	
      <div align = "right">
         <div style = "width:400px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;" align = "center"><b>Login</b></div>
				
            <div style = "margin:30px">
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br/><br/>
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br/>
                  &emsp;&emsp;&emsp;&emsp;&emsp;<input type = "submit" name = "cycleAction" value = "Submit"/></br></br>
		  New user?&nbsp;<input type = "submit" name = "cycleAction" value = "CreateAccount"><br/>
               </form>					
            </div>		
         </div>
	<div style = "font-size:20px; color:#333333; margin-top:10px">
			
	</div>
      </div>
  </body>
</html>
