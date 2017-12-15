

<?php 
//###########################################################################
/*
**Written By:: Jayanta Halder
**Website:: techbangla.in
Date :: 15th Dec '17
*/
//#########################################################################

include 'dbconn.php';


if(@$_POST['submit'])
{
	    //storing all necessary data into the respective variables.
	$file = $_FILES['file'];
	$file_name = $file['name'];
	$file_type = $file ['type'];
	$file_size = $file ['size'];
	$file_path = $file ['tmp_name'];
	
		//if($file_name!="" && ($file_type="image/jpeg"||$file_type="image/png"||$file_type="image/gif")&& $file_size<=614400)
	
	//if(move_uploaded_file ($file_path,'image/'.$file_name))	
	if (is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['error']==0) 
	{
		$path = 'image/' . $_FILES['file']['name'];
		if (!file_exists($path)) {
      if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
        echo "The file was uploaded successfully.";
		 echo "The file is temporarily stored: " . $_FILES['file']['tmp_name'] . "<br>";
		echo "The file name was: " . $_FILES['file']['name'] . "<br>";
		echo "The file type is: " . $_FILES['file']['type'] . "<br>";
		echo "The file size is: " . $_FILES['file']['size'] . "<br>";
		
		
		try{
		$file_up=$_FILES['file']['name'];
		//$imgContent = addslashes(file_get_contents($file_up));
	$record= "INSERT INTO img_test2(img)VALUES('$file_up')";
		$insert =$conn->query($record);
		if($insert){
            echo "File uploaded successfully.";
			
			
			
			//$result=  mysql_query("SELECT img FROM img_test2 LIMIT1");
			$sql="SELECT *FROM img_test2 LIMIT1";
			$result = $conn->query($sql);
			
			while($row = $result->fetch_assoc()){
				//echo "<img src='image/".$row['img']."' height = '130px' width = '130px'>";
				//$img="image/".$row['img'];
				//$img="images/".$file_name;
				//echo '<img src= "'.$img.'" height=200 width=150>';
				$img=base64_encode( $row['img'] );
				echo "<img src='data:image/jpeg;base64,'".$img." height = '130px' width = '130px'/>";
				echo $row['img'];
			}
        }else{
            echo "File upload failed, please try again.";
        }
		
		$conn->close();
		echo 'DataInsert successfull';
		
		  
	}
	catch(Exception $e){
				echo 'Message: ' .$e->getMessage();	
				 echo mysql_error();
					
				}
		
      } else {
        echo "The file was not uploaded successfully.";
      }
    } else {
      echo "File already exists. Please upload another file.";
    }
	
   
		
	//$query=mysql_query("insert into user(photo)values('$file_name')");
	
	}
	else 
	{
		echo "The file was not uploaded successfully.";
    echo "(Error Code:" . $_FILES['file']['error'] . ")";
		
	}
		
	}


/*
$name= $_FILES['file']['name'];

$tmp_name= $_FILES['file']['tmp_name'];

$submitbutton= $_POST['submit'];

$position= strpos($name, "."); 

$fileextension= substr($name, $position + 1);

$fileextension= strtolower($fileextension);

$description= $_POST['description_entered'];

if (isset($name)) {

$path= 'image/';

if (!empty($name)){
if (move_uploaded_file($tmp_name, $path.$name)) {
echo 'Uploaded!';

}
}
}
*/

		?>





<!DOCTYPE html>
<html>
<body>
<!--------
<form action="#" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
-------------->
<form action="#" method='post' enctype="multipart/form-data">
Description of File: <input type="text" name="description_entered"/><br><br>
<input type="file" name="file" /><br><br>
	
<input type="submit" name="submit" value="Upload"/>

</form>


</body>
</html>
