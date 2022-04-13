  
 <?php
$con=mysqli_connect("localhost","root","","my_db");
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(!empty($_POST['FirstName'])){
	$firstname = $_POST['FirstName'];
}

if(!empty($_POST['LastName'])){
	$Lastname = $_POST['LastName'];
}

$r=1;
$query = "SELECT * FROM Persons where FirstName like '%$firstname%' and LastName like '%$Lastname%' ORDER BY FirstName asc" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
echo "<table border='1' align='center' class='table table-hover'>";
echo "<tr>";
echo "<td>"."No."."</td> ";
echo "<td>"."FirstName"."</td> ";	
echo "<td>"."Lastname"."</td> ";		
echo "<td>"."Age (Yr.)"."</td> ";		
echo "</tr>";
foreach( $result as $row ) {
	echo "<tr>";
	echo "<td>" .$r++ ."."."</td> ";
	echo "<td>" .$row["FirstName"] .  "</td> ";
	echo "<td>" .$row["LastName"] .  "</td> ";
	echo "<td>" .$row["Age"]."</td> ";
	echo "</tr>";
	
}
	echo "</table>";	
?> 
<form name="inpfrm" method="post" action="FormSelect.php">
<table border='0' align='center' class='table table-hover'>
<tr>
    <td><input name="reset" type="submit" id="Back" value="Back"/></td>
</tr>
</table>
