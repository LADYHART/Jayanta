<?php $yourname=""; 
  $yourname = $_POST["yourname"];
?>

<!DOCTYPE html>
<html>
<head>
<title>Hello PHP</title>
</head>
<body>
<form action="" method="post">
<label>What is your Name!</label>
<input type="text" name="yourname" id="yourname" placeholder="Enter your name" width="128" height="24"/>
<br/>
 <?php if(!empty($yourname)) { ?>
  <h3>Welcome Mr. <?=$yourname ?>
  <?php }>
</form>	
</body>
</html>
