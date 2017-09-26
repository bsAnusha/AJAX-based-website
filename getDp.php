<?php
	
session_start();
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
$email=$_SESSION['email'];
$e=mysql_query("select * from user where email='$email'");

while($rows=mysql_fetch_assoc($e))
{
	echo "".$rows["dp"];
}


?>
