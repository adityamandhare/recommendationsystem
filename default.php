<?php
session_start();
error_reporting(E_PARSE);   
if($_SESSION['admin_logged_in']==1)
{

?>
<html>
<body>
<center>

<br><br><br><br><br>

<table width="100%" border="0">
<tr>



<td width="33%">
<center>
<font color="#808080">
<h1>Person-to-Diary</h1>
</font>
<font color="#C0C0C0">
<h3>Recommendation Tool</h3>
</font>
<br><br>
<table width="100" border="0" cellspacing="10">
<tr>
<td width="50%">
<img src="images/p1.jpg" width="70" height="70">
</td>
<td width="50%">
<img src="images/d41.jpg" width="70" height="70">
</td>
</tr>
</table>
</center>
</td>


<td width="33%">
<center>
<font color="#808080">
<h1>Diary-to-Diary</h1>
</font>
<font color="#C0C0C0">
<h3>Recommendation Tool</h3>
</font>
<br><br>
<table width="100" border="0" cellspacing="10">
<tr>
<td width="50%">
<img src="images/d31.jpg" width="70" height="70">
</td>
<td width="50%">
<img src="images/d41.jpg" width="70" height="70">
</td>
</tr>
</table>
</center>
</td>


<td width="33%">
&nbsp;&nbsp;
<center>
<font color="#808080">
<h1>Final</h1>
</font>
<font color="#C0C0C0">
<h3>Recommendation Tool</h3>
</font>
<br><br>
<table width="100" border="0" cellspacing="10">
<tr>
<td width="100%">
<img src="images/r3.jpg" width="110" height="110">
</td>
</tr>
</table>

</center>
</td>



</tr>
</table>
</center>
</body>
</html>

<?php 
}
?>