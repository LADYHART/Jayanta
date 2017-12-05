<?php
//###########################################################################
/*
**Written By:: Jayanta Halder
**Website:: techbangla.in
Date :: 24th Nov '17
*/
//##########################################################################


	

	//Declair a Global Error Variable
	$error="Enter All Field Properly";



	
	//if form method post execute then page respond
	
	if( $_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		
		//session start
		//session_start();
				
		//Input Validation
		if(empty($_POST['Fname']) || empty($_POST['Uname']) || empty($_POST['Pass']) || empty($_POST['Con_pass']) || empty($_POST['Email']) || empty($_POST['Ph_number']) || empty($_POST['Position']))
		{
			//if field no full
			 $error="Enter All Field Properly";
		}
		
		
		//check unique username
		else
		{
			/*
			@@@@
			This Part check the Username unique or Not
			Match Input User Name  with DB 
			@@@@@
			
			*/
			
			//Including db connection file
				include 'dbconn.php';
				session_start();
				
				// Assign Username into a Variable
				$name=htmlspecialchars( stripslashes( trim( $_POST["Uname"]) ));
				/*
				//sql commend
				@@ No Limit fo check whole db
				@for match one valu from db
				
				*/
				
				$sql = "SELECT Uname,Pass,Position FROM my_table WHERE Uname='$name'";
				$result = $conn->query($sql);
					if ($result->num_rows > 0) 
						{
							$Count=1;
	
						}
						else 
						{
							$count=0;
						}
			$conn->close();	
				
			
			
		
	
		// check and match Password and confirm password 
		if ($Count==0)
		{
		if($_POST['Pass']==$_POST['Con_pass'])
		{
			if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
				$error = "Invalid email format"; 
			}
			elseif (!preg_match("/^[0-9]{10}$/",$_POST['Ph_number'])) {
				$error = "Write Ph Number Correctly";
					}
			
			else{
			//Including db connection file
				include 'dbconn.php';
				
			
				//$record= DBExecute(INSERT INTO my_table(`Fname`, `Uname`, `Pass`, `Email`, `Ph`, `Position`) VALUES ('htmlspecialchars( stripslashes( trim( $_POST["Fname"]) ) )','htmlspecialchars( stripslashes( trim( $_POST["Uname"]) ) )','htmlspecialchars( stripslashes( trim( $_POST["Pass"])))','htmlspecialchars( stripslashes( trim($_POST["Email"])))','htmlspecialchars( stripslashes( trim( $_POST["Ph"]) ) )','htmlspecialchars( stripslashes( trim( $_POST["Position`"]) ) )'));
			
				//$record = $db.DBExecute('SELECT uid, upass FROM result WHERE uname=\"' + htmlspecialchars( stripslashes( trim( $_POST["Uname"]) ) ) + '\" LIMIT 1');
				//Sql commend
				$record= "INSERT INTO my_table(`Fname`, `Uname`, `Pass`, `Email`, `Ph`, `Position`) VALUES ('".htmlspecialchars( stripslashes( trim( $_POST["Fname"]) ) )."','".htmlspecialchars( stripslashes( trim( $_POST["Uname"]) ) )."','".htmlspecialchars( stripslashes( trim( $_POST["Pass"])))."','".htmlspecialchars( stripslashes( trim($_POST["Email"])))."','".htmlspecialchars( stripslashes( trim( $_POST["Ph_number"]) ) )."','".htmlspecialchars( stripslashes( trim( $_POST["Position"]) ) )."')";
				$conn->query($record);//commend execute
			//mysql_query($record) or die(mysql_error()); 
				$conn->close();//close connection
			$error='DataInsert successfull';
			}
		}
		else
		{
			$error="Enter Password and Confirm Password Field Properly";
			
		}
		
		}
		else {
			
			$error="User Already exist. Please Type a Unique Username";
		}
		}
	
	}
	
?>














<!---------------------------------------------------------------->
<!-----------/*html, css & js script code*/ ----------------------->
<!---------------------------------------------------------------->

<!DOCTYPE html>

<html>
<!-----------------Html Head Part------------------------------->
	<head>
	<!------define character set------>
		<meta charset="utf-8"/>
		<title>Registration Page</title>
		
		<style>
		#form{
			align:center;
		}
		#Reg_form{
			
		
			
		}
		h2{
			color: #275a6b;
			align: center;
			
		}
		#form_con{
			
			
			
		}
		.error{
			
			color: red;
			font-size: 20px;
			
			
		}
		
		
		</style>
	</head>
<!-----------------Html Body Part------------------------------->
	<body>
		<table id="form">
		
			<form id="Reg_form" action="<?=htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" >
				<div>
					<H2>Registration Form:</H2>
				</div>
				<p class="error"><b><?="**".$error?></b></p>
				<div>
					<p id="form_con"><label>Full Name : </label><input type="text" name="Fname"  placeholder="Type Your Full Name" value="<?php if(isset($_POST['Fname'])){ echo $_POST['Fname'] ; } ?>" ><br/></p>
					<p id="form_con"><label>User Name : </label><input type="text" name="Uname"  placeholder="Type a User Name" value="<?php if(isset($_POST['Uname'])){ echo $_POST['Uname'];} ?>" ><br/></p>
					<p id="form_con"><label>Password : </label><input type="password" name="Pass"  placeholder="Type password"><br/></p>
					<p id="form_con"><label>Confirm Password : </label><input type="password" name="Con_pass"  placeholder="Retype Password"><br/></p>
			
					<p id="form_con"><label>Email : </label><input type="text" name="Email"  placeholder="Type email adress" value="<?php if(isset($_POST['Email'])){ echo $_POST['Email']; } ?>" ><br/></p>
					<p id="form_con"><label>Ph Number : </label><input type="text" name="Ph_number"  placeholder="Type Your Ph number" value="<?php if(isset($_POST['Ph_number'])){ echo $_POST['Ph_number']; } ?>" ><br/></p>
					<p id="form_con"><label>Position:<label><input type="radio" name="Position" <?php if (isset($Position) && $gender=="Admin") echo "checked";?> value="Admin">Admin
					<input type="radio" name="Position" <?php if (isset($Position) && $gender=="user") echo "checked";?> value="User">User</p>
					<p id="form_con"><input type="Submit" name="button_submit"  Value="Submit">&nbsp;&nbsp;&nbsp;<input type="Submit" name="button_cancel"  Value="Cancel"></p>
				</div>

			</form>
			<!------------
			<form><input type="Submit" name="button_cancel"  Value="Cancel">
			</form>
			------------------>
			
		</table>
	</body>
</html>