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
<title>Person diary rec</title>
</head>
<body>
<center>
<h2><font color="#808080">Final Recommendation</font></h2>

<table width="90%" border="1" title="Final Ten Recommendations to be provided to the user">
<th width="50%"><font color="#808080">Recommendation</font></th>
<th width="25%"><font color="#808080">Strength</font></th>

<!-- change starts-->

<th width="25%"><font color="#808080">Level</font></th>

<!-- change ends -->

<tr>
<?php 
$_SESSION['uid']=$_SESSION[username];

$sel="select follow_name, total_strength, level from recommend_final where username='".$_SESSION[uid]."' and level='T' ";
$sel1=mysql_query($sel) or die(mysql_error());

$inc=1;

$rec_list=array();
$index=1;

while($sel2=mysql_fetch_array($sel1))
{

$rec_list[1][$index]=$sel2['follow_name'];	
$rec_list[2][$index]=$sel2['total_strength'];
//////////////////////
$rec_list[3][$index]=$sel2['level'];
//////////////////////
$index++;
}

// sorting according to strength
for($i=1;$i<$index;++$i)
{
for($j=$i+1;$j<$index;++$j)
{
	if($rec_list[2][$i]<$rec_list[2][$j])
	{
		$temp1=$rec_list[1][$i];
		$temp2=$rec_list[2][$i];
		////////////////////////
		$temp3=$rec_list[3][$i];
		////////////////////////
		
		$rec_list[1][$i]=$rec_list[1][$j];
		$rec_list[2][$i]=$rec_list[2][$j];
		/////////////////////////
		$rec_list[3][$i]=$rec_list[3][$j];
		////////////////////////
		
		
		$rec_list[1][$j]=$temp1;
		$rec_list[2][$j]=$temp2;
		///////////////////////////
		$rec_list[3][$j]=$temp3;
		//////////////////////////
	}
}	
}


for($i=1;$i<$index;++$i)
{
echo("<td width=\"50%\"><center>".$rec_list[1][$i]."</center></td>");
echo("<td width=\"25%\"><center>".$rec_list[2][$i]."</center></td>");
/////////////////////////////////////////////////////////////////////////////
echo("<td width=\"25%\"><center>".$rec_list[3][$i]."</center></td>");
////////////////////////////////////////////////////////////////////////////
echo("</tr><tr>");
++$inc;
if($inc>=11)
break;
}

if($inc<11)
{

$sel="select follow_name, total_strength, level from recommend_final where username='".$_SESSION[uid]."' and level='M' ";
$sel1=mysql_query($sel) or die(mysql_error());

//$inc=1;

$rec_list=array();
$index=1;

while($sel2=mysql_fetch_array($sel1))
{

$rec_list[1][$index]=$sel2['follow_name'];	
$rec_list[2][$index]=$sel2['total_strength'];

///////////////////////////////////////////////
$rec_list[3][$index]=$sel2['level'];
///////////////////////////////////////////////

$index++;
}

// sorting according to strength
for($i=1;$i<$index;++$i)
{
for($j=$i+1;$j<$index;++$j)
{
	if($rec_list[2][$i]<$rec_list[2][$j])
	{
		$temp1=$rec_list[1][$i];
		$temp2=$rec_list[2][$i];
		/////////////////////////////
		$temp3=$rec_list[3][$i];
		/////////////////////////////
		
		$rec_list[1][$i]=$rec_list[1][$j];
		$rec_list[2][$i]=$rec_list[2][$j];
		////////////////////////////////
		$rec_list[3][$i]=$rec_list[3][$j];
		///////////////////////////////
		
		
		$rec_list[1][$j]=$temp1;
		$rec_list[2][$j]=$temp2;
		/////////////////////////
		$rec_list[3][$j]=$temp3;
		/////////////////////////
	}
}	
}


for($i=1;$i<$index;++$i)
{
echo("<td width=\"50%\"><center>".$rec_list[1][$i]."</center></td>");
echo("<td width=\"25%\"><center>".$rec_list[2][$i]."</center></td>");
///////////////////////////
echo("<td width=\"25%\"><center>".$rec_list[3][$i]."</center></td>");
////////////////////////////

echo("</tr><tr>");
++$inc;
if($inc>=11)
break;
}
	
}

if($inc<11)
{

$sel="select follow_name, total_strength, level from recommend_final where username='".$_SESSION[uid]."' and level='L' ";
$sel1=mysql_query($sel) or die(mysql_error());

//$inc=1;

$rec_list=array();
$index=1;

while($sel2=mysql_fetch_array($sel1))
{

$rec_list[1][$index]=$sel2['follow_name'];	
$rec_list[2][$index]=$sel2['total_strength'];

///////////////////////////////////////////////
$rec_list[3][$index]=$sel2['level'];
///////////////////////////////////////////////


$index++;
}

// sorting according to strength
for($i=1;$i<$index;++$i)
{
for($j=$i+1;$j<$index;++$j)
{
	if($rec_list[2][$i]<$rec_list[2][$j])
	{
		$temp1=$rec_list[1][$i];
		$temp2=$rec_list[2][$i];
		////////////////////////////////
		$temp3=$rec_list[3][$i];	
		/////////////////////////////////
		
		$rec_list[1][$i]=$rec_list[1][$j];
		$rec_list[2][$i]=$rec_list[2][$j];
		/////////////////////////////////
	    $rec_list[3][$i]=$rec_list[3][$j];
		////////////////////////////////
		
		
		$rec_list[1][$j]=$temp1;
		$rec_list[2][$j]=$temp2;
		/////////////////////////////////
		$rec_list[3][$j]=$temp3;
		////////////////////////////////
	}
}	
}


for($i=1;$i<$index;++$i)
{
echo("<td width=\"50%\"><center>".$rec_list[1][$i]."</center></td>");
echo("<td width=\"25%\"><center>".$rec_list[2][$i]."</center></td>");
///////////////////////////////
echo("<td width=\"25%\"><center>".$rec_list[3][$i]."</center></td>");
////////////////////////////////
echo("</tr><tr>");
++$inc;
if($inc>=11)
break;
}
	
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