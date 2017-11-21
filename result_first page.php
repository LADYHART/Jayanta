<?php
session_start();

	$servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "test_skill";
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 
	else {
		echo "connection success <br>";
	}
	//$sql= "SELECT uname, upass FROM result WHERE uname = 'Joy'";
	$sql = "SELECT uname,upass WHERE uname='Joy'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "Name :".$row["uname"]. "Password :".$row["upass"]."Math :".$row["math"]."Eng :".$row["eng"].
		//"Phy :".$row["phy"]."Total :".$row["total"]."Geade :".$row["grade"]."<br>";
		$dname=$row["uname"];
		$dpass=$row["upass"];te
		
    }
} else 
{
    echo "0 results";
}
$conn->close();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }
if (empty($_POST["password"])) {
    $passErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
}
?>


<!DOCTYPE HTML>
<html>
<head>
	<title>Page for Result Show</title>
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);">

<label>Name :  </label><input type="text" name="name" placeholder="Name"><br/><br/>
<label>Password :  </label><input type="text" name="password" placeholder="Password"><br/>

<input type="submit" name="submit" value="Submit">
</form>
<?php

//$_SESSION["name"];
//$password=$_SESSION["password"];
//echo "Session variables are set.";
?>





</body>

</html>
