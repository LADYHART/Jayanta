<?php
################################################################################################
	//code for Database connection
	//Writtent by :: Jayanta Halder
	//Date :: 24th Nov '17

################################################################################################
	
	 //Variable for Sql server name
	$servername = "localhost";
    
	 //variable for server User Name
	$username = "root";
    
	 //varia for Server Password
	$dbpassword = "";
    
	 //Veriable for Db name
	$dbname = "test_skill";
		
		//create connection with db
		$conn = new mysqli($servername, $username, $dbpassword, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			else {
				//echo "connection success <br>";
		
			}
	?>