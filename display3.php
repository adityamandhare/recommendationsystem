<?php
session_start();
error_reporting(E_PARSE);   
if($_SESSION['admin_logged_in']==1)
{
	$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    mysql_select_db("diary",$con) or die ("cannot select db");

?>
<html>
<body>
<center>
<font color="#808080">
<br><br><br><br>
<h1>Final</h1>
</font>
<font color="#C0C0C0">
<h3>Recommendation Tool</h3>
</font>
<br><br>
<table width="100" border="0" cellspacing="10">
<tr>
<td width="100%">
<img src="images/r3.jpg" width="100" height="100">
</tr>
</table>
</center>
</body>
</html>

<?php 
}
?>