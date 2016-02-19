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
<head>
<link rel="icon" href="images/as1.ico" type="image/x-icon">
<title>
Run Express Tool
</title>
<link rel="stylesheet" href="pattern1.css">
</head>
<body>

<table border="0" width="100%">

<tr>
<td width="100%" height="60" bgcolor="#4CC417">
<center>
<h2><font color="#FFFFFF" face="Elephant">Express Recommendation Tool</font></h2>
</center>
<div align="right">
<font color="#FFFFFF">
<b><a href="tool_space.html" target="_parent">View Recommendations</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="run_tool.html" target="_parent">Recommendation Tool</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php" target="_parent">Logout</a>&nbsp;
</b>
</font>
</div>
</td>
</tr>



<tr>
<td width="100%">
<center>
<br><br><br>
<table width="100%" border="0">
<tr>
<td width="33%">
<center>
<a href="person_diary.php" target="d1"><font color="#008000" face="Georgia"><b>Run Person-to-Item Tool</b></font></a>
</center>
</td>
<td width="33%">
<center>
<a href="diary_diary.php" target="d2"><font color="#008000" face="Georgia"><b>Run Item-to-Item Tool</b></font></a>
</center>
</td>
<td width="33%">
<center>
<a href="recommend.php" target="d3"><font color="#008000" face="Georgia"><b>Run Final Recommendation Tool</b></font></a>
</center>
</td>
</tr>
</table>

</center>
</td>
</tr>



</table>
</body>
</html>
<?php 
}
else header('Location:tool_login.php');
?>