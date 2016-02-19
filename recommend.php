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
Final Recommendation
</title>
<link rel="stylesheet" href="pattern.css">
</head>
<body>

<br><br><br><br>
<center>
<h2><font color="#808080">Starting Final Recommendation Calculation</font></h2>
</center>
    
<?php  

$pd=array();
$list=array();
$inc=1;
$s1="select username from user";
$s2=mysql_query($s1);
while($s3=mysql_fetch_array($s2))
{
$list[$inc]=$s3['username'];
$inc++;
}


for($i=1;$i<=count($list);++$i)
{
	
$d="delete from recommend_final where username='".$list[$i]."'";
mysql_query($d);
	
	
$u=$list[$i];
	
	$sel="select recommend_dd.username, recommend_pd.follow_name, pd_strength, dd_strength 
from recommend_pd inner join recommend_dd 
where recommend_pd.username= recommend_dd.username 
and recommend_pd.follow_name= recommend_dd.follow_name 
and recommend_pd.username='".$u."' ";
	
	
	$sel1=mysql_query($sel) or die(mysql_error());
	
	
	while($sel2=mysql_fetch_array($sel1))
	{
		$fn=$sel2['follow_name'];
		$rdd=$sel2['dd_strength'];
		$rpd=$sel2['pd_strength'];
	
		$total=$rdd+$rpd;
		
        $ins1="insert into recommend_final(username,follow_name,total_strength,level)values('$u','$fn','$total','T')";
		mysql_query($ins1);
	}
	

$sel3="select recommend_dd.username, recommend_dd.follow_name, recommend_dd.dd_strength 
from recommend_dd 
where recommend_dd.username='".$u."' and 
recommend_dd.follow_name not in (select follow_name from recommend_pd where recommend_pd.username='".$u."')";	


$sel4=mysql_query($sel3) or die(mysql_error());
	
	while($sel5=mysql_fetch_array($sel4))
	{
		
		$fn=$sel5['follow_name'];
		$rdd=$sel5['dd_strength'];

		$ins2="insert into recommend_final(username,follow_name,total_strength,level)values('$u','$fn','$rdd','M')";
		mysql_query($ins2) or die(mysql_error());
	
		
	}
	
/////////////////////////////////////////

	
$sel6="select recommend_pd.username, recommend_pd.follow_name, recommend_pd.pd_strength 
from recommend_pd 
where recommend_pd.username='".$u."' and 
recommend_pd.follow_name not in (select follow_name from recommend_dd where recommend_dd.username='".$u."')";	


$sel7=mysql_query($sel6) or die(mysql_error());
	
	while($sel8=mysql_fetch_array($sel7))
	{

		$fn=$sel8['follow_name'];
		$rdd=$sel8['pd_strength'];

		$ins3="insert into recommend_final(username,follow_name,total_strength,level)values('$u','$fn','$rdd','L')";
		mysql_query($ins3) or die(mysql_error());
	
		
	}
	
}	
?>
<br><br><br><br>
<center>
<h3><font color="#C0C0C0">Finished Final Recommendation Calculations</font></h3>
</center>

</body>
</html>
<?php 
}
else 
header('Location:tool_login.php');

?>