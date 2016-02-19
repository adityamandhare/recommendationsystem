<?php
session_start();
error_reporting(E_PARSE);   
if($_SESSION['admin_logged_in']==1)
{
	$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    mysql_select_db("diary",$con) or die ("cannot select db");

$sel="select follow_name, pd_strength from recommend_pd where username='".$_SESSION[username]."' order by pd_strength  DESC";    
$sel1=mysql_query($sel) or die(mysql_error()); 
?>
<html>
<head>
<title>Person diary rec</title>
</head>
<body>
<center>
<h2><font color="#808080">Person-Diary Recommendation</font></h2>

<table width="70%" border="1" title="Person-to-Diary Recommendations">
<th width="50%"><font color="#808080">Recommendation</font></th>
<th width="50%"><font color="#808080">Strength</font></th>
<tr>
<?php 
while($sel2=mysql_fetch_array($sel1))
{
echo("<td width=\"50%\"><center>".$sel2['follow_name']."</center></td><td width=\"50%\"><center>".$sel2['pd_strength']."</center></td></tr><tr>");
}
?>
</tr>
</table>
</center>
</body>
</html>
<?php 
}
?>