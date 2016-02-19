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
<br><br><br><br>
<font color="#808080">
<h1>Person-to-Diary</h1>
</font>
<font color="#C0C0C0">
<h3>Recommendation Tool</h3>
</font>
<br><br>
<table width="100" border="0" cellspacing="10">
<tr>
<td width="50%">
<img src="images/p1.jpg" width="70" height="70">
</td>
<td width="50%">
<img src="images/d41.jpg" width="70" height="70">
</td>
</tr>
</table>

</center>
</body>
</html>
<?php 
}
?>