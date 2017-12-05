<?php
//###########################################################################
/*
**Written By:: Jayanta Halder
**Website:: techbangla.in
Date :: 4th Dec '17
*/
//##########################################################################

//Declair a Global Error Variable
	$error="Enter All Field Properly";
	
	
	//if form method post execute then page respond
	
	if( $_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		//Input Validation check empty or not
		if(empty($_POST['Uname']) || empty($_POST['password']))
		{
			$error="Enter All Field Properly";
			
		}
		else
		{
			//Including db connection file and Session Start
				session_start();
				include 'dbconn.php';
				
				// Assign Username into a Variable
				$name=htmlspecialchars( stripslashes( trim( $_POST["Uname"]) ));
				
				/*
				//sql commend
				@@ LIMIT 1
				@for match one valu from db
				
				*/
				
				$sql = "SELECT Uname,Pass,Position FROM my_table WHERE Uname='$name' LIMIT 1";
				//$sql = "SELECT Uname,Pass,Position FROM my_table WHERE uname=\"' + htmlspecialchars( stripslashes( trim( $_POST["Uname"]) ) ) + '\" LIMIT 1";
				$result = $conn->query($sql);
				
				/*
				//for erro check of sql commend//
				if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				} 
				else {
    				echo "Error: " . $sql . "<br>" . $conn->error;
						}
				*/
				
				
		if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      
		//$password=1;
		//$dpass=$row["Pass"];//password from db
		//echo "Name is :".$row["Uname"]." Password is :".$row["Pass"]." Position is : ".$row["Position"];
		
		//
		// store db fetch data into session variable
		//
		$_SESSION['name']=$row["Uname"];
		$_SESSION['password']=$row["Pass"];
		$_SESSION['position']=$row["Position"];
		
		
    }
}
 else {
    
	//$NotMatch="No Data Found, Type User Name and Password Correctly";
	//$dpass="Not";
}
			//db connection close
			$conn->close();
  }
  
		/*
		//////  Check  Db Password and Form Password [user get] 
		*/
  if($_SESSION['password']==$_POST['password'])
  {
	 // echo "sucess";
	 //echo $_SESSION['name'].$_SESSION['password'].$_SESSION['position'];
	 
	 /*
	 / @@ If User Name and Password Match
	 / @@Check Admin Or User
	 */
	 
	 if($_SESSION['position']=='Admin'){
		header('Location: http://localhost/Admin_page.php'); 
	 }
	 elseif($_SESSION['position']=='User')
	 {
	   header('Location: http://localhost/User_page.php'); 
	}
  }
   else{
	  $error="User Name Or Password Incorrect";
	  
  }
  
			
		}




	
?>




	<!DOCTYPE HTML>
<html>
<head>
	<title>Page for Result Show</title>
	
	<style>
	.error{
			
			color: red;
			font-size: 15px;
			}
			.login{
				
				color:Blue;
				font-size:20px;
			}
	
	</style>
</head>

<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label class="login"><strong><b>User LogIn </b></strong> </label><br/><br/>
<label class="error"><b><?="**".$error ?></b> </label><br/><br/>
<label>User Name :  </label><input type="text" name="Uname" placeholder="User Name"><br/><br/>
<label>Password :  </label><input type="password" name="password" placeholder="User Password"><br/>

<input type="submit" name="submit" value="Submit">

</form>
</body></html>