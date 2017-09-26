<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
$email=$_POST["usr"];
$pwd=$_POST["pwd"];
$e=mysql_query("select * from user where email='$email'");
$_SESSION["email"]=$email;
$rows=mysql_fetch_assoc($e);
$uid=$rows["uid"];
if(mysql_num_rows($e)>0)
{
	$p=mysql_query("select * from user where password='$pwd'");
	if(mysql_num_rows($p)>0)
	{
		$q=mysql_query("insert into in_out"."(login_time, logout_time, uid)"."values(now(),'','$uid')",$c);
		$_SESSION["uid"]=$uid;
		$rows=mysql_fetch_assoc($p);
		$_SESSION["fname"]=$rows["fname"];
		header("Location:wallpage.php");
	}
	else
	{
		echo "Password incorrect";
	}
}
else
{
	echo "Couldn't log you in";
}
?>
