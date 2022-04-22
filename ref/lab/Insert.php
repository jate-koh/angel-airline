 <?php
$con=mysqli_connect("localhost","root","","my_db");
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(empty($_POST['FirstName'])){
	echo "Please Input data FirstName" ;
}elseif(empty($_POST['LastName'])){
	echo "Please Input data LastName" ;
}elseif(empty($_POST['Age'])){
	echo "Please Input data Age" ;
}else{
	//esc//ape variables for security
	$firstname = mysqli_real_escape_string($con, $_POST['FirstName']);
	$lastname = mysqli_real_escape_string($con, $_POST['LastName']);
	$age = mysqli_real_escape_string($con, $_POST['Age']);

	$sql="INSERT INTO Persons (FirstName, LastName, Age)
	VALUES ('$firstname', '$lastname', '$age')";
	if (!mysqli_query($con,$sql)) {
	die('Error: ' . mysqli_error($con));
	}
	echo "Success" ;
}	

mysqli_close($con);
?>
<form name="inpfrm" method="post" action="Form.php">
<table border='0' align='center' class='table table-hover'>
<tr>
    <input name="reset" type="submit" id="Back" value="Back"/></td>
</tr>
</table>