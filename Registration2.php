<?php
//###########################################################################
/*
**Written By:: Jayanta Halder
**Website:: techbangla.in
Date :: 6th Dec '17
*/
//##########################################################################


	

	//Declair a Global Error Variable
	$error="Enter All Field Properly";
	
	
		//Variable for Check data found from db 
	$Errcount=0;
	
		//Variable for match Password and confirm Password
	$Errpass=0;
	
		// Email validation check variable
	$Erremail=0;
	
		// Ph Number Validation
	$Errph=0;


	
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
			
			try
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
							//if data found 
							$Errcount=0;
							$error="Use Already Exist Please Try Another";
	
						}
						else 
						{
							//data not found
							$Errcount=1;
						}
				$conn->close();	
			}
			catch(Exception $e){
				echo 'Message: ' .$e->getMessage();
				
			}
			
			
				// check and match Password and confirm password 
			if($_POST['Pass']==$_POST['Con_pass'])
			{
					//if Pass and con Pass match
				$Errpass=1;
					
			}
			else {
					//if Pass and con Pass not match
				$Errpass=0;
				$error="Enter Password and Confirm Password Field Properly";
				
				}
				/*
				@@ Chech Email Validation
				*/
				
			if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) 
			{
				$error = "Invalid email format"; 
				$Erremail=0;
			}
			else
			{
				$Erremail=1;
				
			}
			
				/*
					@@ Check Ph Number Validation
				*/
			if (!preg_match("/^[0-9]{10}$/",$_POST['Ph_number'])) 
			{
				$error = "Write Ph Number Correctly";
				$Errph=0;
				
			}
			else
			{
				$Errph=1;
				
			}
			
				
			
			
		
	
		// check and match Password and confirm password 
		if ($Errcount==1 && $Errpass==1 && $Erremail==1 && $Errph==1 )
		{
		
				try
				{
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
				catch(Exception $e){
				echo 'Message: ' .$e->getMessage();	
					
				}
			}
			else{
				///////////////////
				//echo "check code";
				
				
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