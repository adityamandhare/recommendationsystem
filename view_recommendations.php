<?php
session_start();
error_reporting(E_PARSE);   
if($_SESSION['admin_logged_in']==1)
{

	$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    mysql_select_db("diary",$con) or die ("cannot select db");
if(isset($_POST['submit']))
{
	$_SESSION['username']=addslashes(trim($_POST['username']));
		
}

?>
<html>
<frameset cols="75%, 25%">

<frameset rows="33%, 33%, 33%">

<frameset cols="50%, 50%">
<frame src="pd.php" frameborder="0">
<frame src="dd.php" frameborder="0">
</frameset>

<frameset cols="100%">
<!-- <frameset cols="50%, 50%"> <frame src="only_pd.php" frameborder="0"> -->

<frame src="only_dd.php" frameborder="0">
</frameset>

<frame src="both.php" frameborder="0">
</frameset>

<frame src="final_rec.php" frameborder="0">

</frameset>
</html>

<?php 
}
?>