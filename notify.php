<?php
session_start();   
error_reporting(E_PARSE);

if($_SESSION['admin_logged_in']==1)
{

while($_SESSION['stop_notify']==0)
{
	
	
	
}

}
else 
header('Location:tool_login.php');
?>
