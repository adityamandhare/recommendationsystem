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
Diary-Diary Recommendation
</title>
<link rel="stylesheet" href="pattern.css">
</head>
<body>

<br><br><br><br>
<center>
<h2><font color="#808080">Computing Diary based<br>Recommendations</font></h2>
</center>


<?php    
$dd=array();
$dd1=array();
$list=array();
$inc=1;
$s1="select username from user";
$s2=mysql_query($s1);
while($s3=mysql_fetch_array($s2))
{
$list[$inc]=$s3['username'];
$inc++;
}


for($i=1;$i<$inc;++$i)
{
for($j=1;$j<$inc;++$j)
{
$dd[$list[$i]][$list[$j]]=0;
$dd1[$list[$i]][$list[$j]]=0;
}	
$dd[$list[$i]][$list[$i]]=-1;	

/* HERE CHANGE WAS MADE*/
$dd1[$list[$i]][$list[$i]]=-1;
/* HERE CHANGE ENDS*/

}


///////////////////////////////////


for($i=1;$i<=count($list);++$i)
{

$sf1="select * from followed where username='".$list[$i]."'";
$sf2=mysql_query($sf1) or die(mysql_error());

//////////////////

//echo $list[$i].":";

/////////////////
	

while($sf3=mysql_fetch_array($sf2))
{
$dd1[$list[$i]][$sf3['followed_username']]=1;

///////////////////////////
//echo($sf3['followed_username']);
///////////////////////////
}

////////////////////
//echo("<br>");
////////////////////

}


//$temp=mysql_query($s1);
for($k=1;$k<=count($list);++$k)
{
	
$sf1="select followed_username from followed where username='".$list[$k]."'";  // here date condition can be inserted
$sf2=mysql_query($sf1) or die(mysql_error());
$inc1=1;
$list1=array();

while($sf3=mysql_fetch_array($sf2))
{
$list1[$inc1]=$sf3['followed_username'];
$inc1++;

}

for($i=1;$i<$inc1;++$i)
{
for($j=$i+1;$j<$inc1;++$j)
{
	
	$dd[$list1[$i]][$list1[$j]]=$dd[$list1[$i]][$list1[$j]]+1;
	$dd[$list1[$j]][$list1[$i]]=$dd[$list1[$i]][$list1[$j]];

}
}

}

//////////////////////////////////////// change for testing
/*
echo("computing strength<br>");
for($i=1;$i<27;++$i)
{
for($j=1;$j<$inc1;++$j)
{
	
echo $dd[$list1[$i]][$list1[$j]]." ";
echo $dd['X'][$list[$i]]." ";
}
echo("<br>");
}

*/
////////////////////////////////////////////// change for testing ends


//echo $dd["C"]["B"];
/*
$list=array();
$inc=1;
$s2=mysql_query("select username from user");
while($s3=mysql_fetch_array($s2))
{
$list[$inc]=$s3['username'];
$inc++;
}
*/




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// change starts


$inc=count($list);
for($i=1;$i<=$inc;++$i)
{

$d="delete from recommend_dd where username='".$list[$i]."'";
mysql_query($d);
	
$rec_d=array();

for($t=1;$t<=$inc;++$t)
{
$rec_d[$list[i]][$list[t]]=0;
}
$rec_d[$list[i]][$list[i]]=-1;


$inc1=1;
$follow1=array();
for($k=1;$k<=count($list);++$k) // this will form a temporary array of diaries followed by diary i
{
if($dd1[$list[$i]][$list[$k]]==1)
{
$follow1[$inc1++]=$list[$k];		
}
}

$cnt=count($follow1);
/* This was to check if we are getting proper followed list
if($i==1)
{
for($t=1;$t<$inc1;++$t)
echo($follow1[$t]." ");
echo($cnt);
}
*/

for($k=1;$k<=$cnt;++$k)
{

for($y=1;$y<=$inc;++$y)
{

if($dd[$follow1[$k]][$list[$y]]>0)
{
$rec_d[$list[$i]][$list[$y]]+=$dd[$follow1[$k]][$list[$y]];	
}	

} // end of inner for loop
	
} // end of outer for loop


$rec_d[$list[$i]][$list[$i]]=-1;

/* This is just for testing
if($i==2)
{
echo("This is rec strength of Diary B to user B ");
echo $rec_d['B']['B'];	
}
*/

for($g=1;$g<=$inc;++$g)
{
$flag1=0;
if($rec_d[$list[$i]][$list[$g]]>0)
{

for($h=1;$h<=$cnt;++$h)
{
if($list[$g]==$follow1[$h])
{
$flag1=1;
//if($i==1)
//echo($follow1[$h]." Not Included.");
break;	
}
}

if($flag1==0)
{
$strength=$rec_d[$list[$i]][$list[$g]];
$in="insert into recommend_dd (username,follow_name,dd_strength) values ('$list[$i]','$list[$g]','$strength')";
mysql_query($in) or die(mysql_error());

//if($i==24)
//echo("Inserted ".$list[$g]." with strength of ".$strength);

}

	
}	
}	




}











//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// change ends







//// Here the previous wrong code starts
/*
$inc=count($list);
for($i=1;$i<=$inc;++$i)
{


$d="delete from recommend_dd where username='".$list[$i]."'";
mysql_query($d);
//echo($list[$i]."------------>");
$inc1=1;
$follow=array();
for($k=1;$k<=count($list);++$k) // this will form a temporary array of diaries followed by diary i
{
if($dd1[$list[$i]][$list[$k]]==1)
{
//echo($list[$k]);
//echo("Hello");
$follow[$inc1++]=$list[$k];		
}
}
	
		
for($j=1;$j<=$inc;++$j)
{
	
if($dd[$list[$i]][$list[$j]]>0)
{
	
$flag=0;

for($m=1;$m<=count($follow);++$m)
{
if($follow[$m]==$list[$j])
{
$flag=1;	
break;
}	
}	
	
if($flag==0)
{
$strength=$dd[$list[$i]][$list[$j]];
$in="insert into recommend_dd (username,follow_name,dd_strength) values ('$list[$i]','$list[$j]','$strength')";
mysql_query($in) or die(mysql_error());
}

}

}
}

*/
/// here the previous wrong code ends



$_SESSION['done_dd']=1;  
 
?>
<br><br><br><br>
<center>
<h3><font color="#C0C0C0">Completed Diary based Recommendations</font></h3>
</center>




</body>
</html>
<?php 
}
else 
header('Location:tool_login.php');

?>