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
View Recommendation
</title>
<link rel="stylesheet" href="pattern1.css">
<script type="text/javascript">
function check()
{
if(f1.username.value=="")
{
alert("Enter Username");
return false;
}
else
{
var name=f1.username.value;
alert("Showing Recommendations for "+name);
}
}	
</script>
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
<b><a href="tool_space.html" target="_parent">View Recommendations</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="run_tool.html" target="_parent">Run Tool</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php" target="_parent">Logout</a>&nbsp;
</b>
</font>
</div>
</td>
</tr>


<tr>
<td width="100%">
<center>
<br>
<form id="f1" action="view_recommendations.php" method="post" target="display">
<font color="#808080"><b>Enter the username&nbsp;:&nbsp;</b></font><input type="text" name="username">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="submit" value="show recommendations for this user" onclick=return(check())>
</form>
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