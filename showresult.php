<?php
session_start();

//connect database
$servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "test_skill";
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 
	else {
		//echo "connection success <br>";
		
	}
	//Variable Declair
	$nerror="";
	$perror="";
	$NotMatch="";
	$dpass="";
	
	//save value from post method
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nerror = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
	//chech User Name With Database And return Password
	$sql = "SELECT uname,upass FROM result WHERE uname='$name'";
	$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "Name :".$row["uname"]. "Password :".$row["upass"]."Math :".$row["math"]."Eng :".$row["eng"].
		//"Phy :".$row["phy"]."Total :".$row["total"]."Geade :".$row["grade"]."<br>";
		//global $dname=$row["uname"];
		$dpass=$row["upass"];//password from db
		//echo "Name is :".$name."<br>Password is :".$dpass."<br>";
		//header('Location: http://localhost/result_show2.php'); 
		
    }
} else {
    //header('Location: http://localhost/result_show.php'); 
	$NotMatch="No Data Found, Type User Name and Password Correctly";
}
$conn->close();
  }
if (empty($_POST["password"])) {
    $perror = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//math db password with Post Password
if($password==$dpass){
	$_SESSION["name"]=test_input($_POST["name"]);
	 $_SESSION["password"]=test_input($_POST["password"]);
	header('Location: http://localhost/result_show2.php'); 
}
else{
	
	$NotMatch="No Data Found, Type User Name and Password Correctly";
	
}

	?>
	
	
	
	<!DOCTYPE HTML>
<html>
<head>
	<title>Page for Result Show</title>
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<label>Name :  </label><input type="text" name="name" placeholder="Name"><label><?php echo "*".$nerror ?></label><br/><br/>
<label>Password :  </label><input type="text" name="password" placeholder="Password"><label><?php echo "*". $perror ?></label><br/>

<input type="submit" name="submit" value="Submit">
<label><?php echo $NotMatch ?></label>
</form>
</body></html>