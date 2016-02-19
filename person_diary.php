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
Person-Diary Recommendation
</title>
<link rel="stylesheet" href="pattern.css">
</head>
<body>

<br><br><br><br>
<center>
<h2><font color="#808080">Computing Person based Recommendations</font></h2>
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

$l1=count($list);

for($i=1;$i<$inc;++$i)
{
for($j=1;$j<$inc;++$j)
{
$pd[$list[$i]][$list[$j]]=0;
}	
$pd[$list[$i]][$list[$i]]=-1;	
}
    

/*************************** assign 1 to followed list to prepare the array  *******************************/


for($i=1;$i<=$l1;++$i)
{
$sf1="select * from followed where username='".$list[$i]."'";
$sf2=mysql_query($sf1) or die(mysql_error());

while($sf3=mysql_fetch_array($sf2))
{

	$pd[$list[$i]][$sf3['followed_username']]=1;

}

}

/*************************** the assignment process is over  *******************************/

$inc1=1;
for($i=1;$i<=$l1;++$i)
{

$d="delete from recommend_pd where username='".$list[$i]."'";
mysql_query($d);	
	
$inc1=1;
$follow=array();

for($j=1;$j<=$l1;++$j) // this will form a temporary array of diaries followed by diary i
{
if($pd[$list[$i]][$list[$j]]==1)
{
//echo($list[$j]);
$follow[$inc1++]=$list[$j];		
}
}


$recommend=array(); // this is a temporary array of recommendations for each element i
$l2=count($follow);


for($k=1;$k<=$l1;++$k) // this is to check if two people have same choices of followed diaries ie. i and k
{
$flag=1;

if($l2==0)
$flag=0;

for($j=1;$j<=$l2;++$j)
{
	if($pd[$list[$k]][$follow[$j]]!=1)
	{
		$flag=0;
		break;	
	}
}

if($flag==1)
{
	
for($m=1;$m<=$l1;++$m)
{
if($pd[$list[$k]][$list[$m]]==1 && $pd[$list[$i]][$list[$m]]!=1)
{
$recommend[$list[$m]]+=1;
}
}// end of for loop m
}// end of if condition

}// end of for loop k



for($n=1;$n<=$l1;++$n) // this is for insertion into recommend_pd table of database
{
if($recommend[$list[$n]]>=1 && $list[$i]!=$list[$n])
{	
$temp2=$recommend[$list[$n]];	
$ins="insert into recommend_pd(username,follow_name,pd_strength)values('$list[$i]','$list[$n]','$temp2')";
mysql_query($ins);
}
}

}// end of outermost for loop i
$_SESSION['done_pd']=1;

?>
<br><br><br><br>
<center>
<h3><font color="#C0C0C0">Completed Person based Recommendations</font></h3>
</center>
</body>
</html>
<?php 
}
else 
header('Location:tool_login.php');
?>