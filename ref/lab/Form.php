  
 <?php
$con=mysqli_connect("localhost","root","","my_db");
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?> 

  <form name="inpfrm" method="post" action="Insert.php">
	<table width="500" height="18" border="0" align="left" cellpadding="0" cellspacing="0">
	<tr>
		<td height="30" align="right"></td>
		<td width="105" align="left"> Register Form </td>
	</tr>
	<tr>
		<td height="30" align="right" >FirstName : </td>
		<td width="105" align="left"><input name="FirstName" type="text" id="FirstName" size="30" value="" maxlength="30"></td>
	</tr>
	<tr>
		<td height="30" align="right" >LastName : </td>
		<td width="105" align="left"><input name="LastName" type="text" id="LastName" size="30" value="" maxlength="30"></td>
	</tr>
	<tr>
		<td height="30" align="right" >Age : </td>
		<td width="100" align="left" class="number"><input name="Age" type="text" id="Age" size="3" value="" maxlength="3"> Yr.</td>
	</tr>
	<tr>
		<td height="30" align="right" ></td>
	    <td width="100" align="right"><input name="INSERT" type="submit" id="INSERT" value="INSERT" /></td>
	</tr>
	</table>