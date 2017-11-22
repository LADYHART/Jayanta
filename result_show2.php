  
 <?php
session_start();
	$nam=$_SESSION["name"];
	 $pass=$_SESSION["password"];
	 //echo "Name From Session :".$nam."Password From Session :".$pass. "<br>";
	//$session=$_POST["name"];
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
	$sql = "SELECT uname,upass,math,eng,phy,total,grade FROM result WHERE uname='$nam'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "Name :".$row["uname"]. "Password :".$row["upass"]."Math :".$row["math"]."Eng :".$row["eng"].
		"Phy :".$row["phy"]."Total :".$row["total"]."Geade :".$row["grade"]."<br>";
		//$dname=$row["uname"];
		//$dpass=$row["upass"];
		//echo "Name is :".$dname."<br>Password is :".$dpass."<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<body>

<?php
//$_SESSION["name"]=$_POST[Name];
//$_SESSION["password"]=$_POST[Password];
//echo "Tour Name is " . $_POST["name"] . ".<br>";
//echo "Your Password is " . $_POST["password"] . ".";


?>

</body>
</html> 