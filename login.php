<?php 
/***********************************************************************************
** Written By Akanksha Adhikary(LADYHART)
** URL: www.ladyhart.in/about
** contact: ladyhart@protonmail.com
** Date: 23/11/2017 01.13 A.M.
************************************************************************************/

/* global error msg variable */		
		$error = null;	

/* if form has been post than all code are excute */
if( $_SERVER['REQUEST_METHOD'] == 'POST'){	
		/* Start session*/
		session_start();

				
		/* database credentianal */
		class DatabseConnection {
			
			/* instance  variable*/
				private $conn = null; 
			
			/* host name of mysql server */
				private $host = "localhost";
			
			/* rollno of mysql account and password */
				private $dbuser = "root";
				private $dbpassword = "";
			
			/* database name */
				private $dbname = "test_skill";
			
				function __construct()
				{	
					// try{
						
					// }
					// catch(Exception e){
						
					// }
					/* start database connection */
					$conn = new mysqli($host, $dbuser, $dbpassword, $dbname);
					
					/* exit if invaild database connection */
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
				}
			
			/* Close database connection  */
				function __destruct(){
					$conn->close();
				}
				
				function Execute($sql){
					return $conn->query($sql);
				}
		}
	
	
	/* START VALIDATION */
		/* input validation */			
		if(empty($_POST["rollno"]) || empty($_POST["pass"]) ){
			$error = "Field can not be empty";
		  } 
		  
		else{
			/* execute datbabe connection */
			$db = new DatabseConnection();
			
			/*
			@select table and attribute
			SELECT upass FROM result 
			
			@search trim and verified data
			WHERE uname= htmlspecialchars( stripslashes( trim( $_POST["rollno"]) ) ) 
			
			@return only single record or first one
			LIMIT 1
			*/
			$record = $db.Execute('SELECT uid, upass FROM result WHERE uname=\"' + htmlspecialchars( stripslashes( trim( $_POST["rollno"]) ) ) + '\" LIMIT 1');

			if( $record->num_rows > 0 ){
				
			/* Declear block varible */
				$dpass = null;
				$userID = null;
			
			/* fetch record from associative array */
				foreach($record->fetch_assoc() as $row ){
					$dpass = $row["upass"];
					$userID = $row["uid"];
				}
			
			/* Check user validation */
				if( $dpass == htmlspecialchars( stripslashes( trim( $_POST["pass"]) ) ) /* checking */ )  {
					/* set session variable */
					$_SESSION["UID"]= $userID;
					
					/* Redirect the page to result.php */
					header('Location: http://localhost/result.php');
				}
				else{
					$error = "Invalid rollno or password";
				}
			}
		}
	/* END VALIDATION */
	}		
?>



	
	
<!-- Code are written/compatable with Internet Explorer 8 -->	
<!DOCTYPE html>
<html>
	<head>
		<!-- define charecter set-->
		<meta charset="utf-8"/>
		<title>Login</title>
		<style>
			body{
				margin: 0px;
				font-family: sans;
				background: #FDFDFD;
			}
			form{
				padding: 20px 30px;
			}
			h3{
				color: orange;
			}
			input{
				border: 1px solid #CCC;
			}
			
			input[type="submit"]{
				background: orange;
				border: 1px solid orange;
				color: white;
			}
		</style>
	</head>
	<body>
		<!-- html form start -->
		<form method="post" action="<?=htmlspecialchars($_SERVER['PHP_SELF']) ?>">
			<!-- use paragraph for separation instead of breake -->
			<div>
			<h3>P.H.P. Cert. Result</h3>
			<!-- show error msg -->
			<p><?=$error ?><p>
			
			<p>
				<label>Roll No.:  </label>
				<input type="text" name="rollno" placeholder="Enter your rollno.."/>
			</p>
			
			<p>
				<label>Password :  </label>
				
				<!-- password type sholud be 'password' -->
				<input type="password" name="pass" placeholder="Enter your secret number.."/>
			</p>
			<p>
				<input type="submit" name="submit" value="See your result">
			</p>
			</div>
		</form>
		<!-- html form end -->
	</body>
</html>