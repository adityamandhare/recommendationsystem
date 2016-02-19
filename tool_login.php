<?php
session_start();
error_reporting(E_PARSE);   
if($_SESSION['admin_logged_in']==1)
header('Location:tool_space.html');
else 
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
Tool Login
</title>
<link rel="stylesheet" href="pattern.css">
<script type="text/javascript">
function check_password()
{
if(f1.username.value=="" && f1.password.value=="")
	alert("Enter Username and Password");
else
if(f1.username.value=="" && f1.password.value!="")
	alert("You need to Enter Username ");
else
if(f1.password.value=="" && f1.username.value!="")
	alert("You need to Enter Password");		
}	
</script>
</head>
<body>

<center>
<table width="60%" border="0">
<tr>
<td width="100%" height="60" bgcolor="#4CC417">
<font color="#FFFFFF" face="Elephant">
<br>
<center><h1>Express Recommendation Tool</h1></center>
</font>
<br>
</td>
</tr>

<tr>
<td width="100%">
<table width="100%" border="0">
<tr>
<td width="40">
<br><br><br>
<center><img src="images/admin.png" width="250" height="250"></center>
</td>
<td width="45">
<br><br>
<?php 
if(isset($_POST['submit']))
{
$u=addslashes(trim($_POST['username']));
$p=sha1(addslashes(trim($_POST['password1'])));

$r="select password from admin where username='".$u."'";
$r1=mysql_query($r) or die(mysql_error());
$r2=mysql_fetch_array($r1);
$check=strcmp($p,$r2['password']);
}    
if(isset($_POST['submit']))
{
if($check!=0)
{
	echo("<font color=\"#008000\"><b><center>Incorrect username/password!<br></center></b></font>");	
}
else 
{
	$_SESSION['admin_logged_in']=1;
	header('Location:tool_space.html');
	
}
}
?>

<br><br>
<b><font color="#808080">
<center>Admin Login</center>
<br><br>

<form id="f1" action="tool_login.php" method="post">
&nbsp;&nbsp;admin id&nbsp;:&nbsp;<input type="text" name="username">
<br><br>
&nbsp;password&nbsp;:&nbsp;<input type="password" name="password1">
<br><br>

<center><input type="submit" name="submit" value="login" onclick=return(check_password())></center>
</form>
</font>
</b>
</td>

<td width="15%">

</td>

</tr>
</table>
</td>
</tr>


</table>
</center>
</body>
</html>
<?php 
}
?>