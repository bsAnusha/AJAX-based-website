<?php
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
session_start();
	
	$stat=$_GET["stat"];	
	$Email=$_SESSION['email'];
	$que1=mysql_query("select * from user where email='$Email'");
		$a=mysql_fetch_assoc($que1);
		$uid=$a['uid'];
		$que2="insert into scribble"."(uid,post_time,content)". "values('$uid',now(),'$stat')";
		$r=mysql_query($que2,$c);
		echo $stat;
		//$_SESSION['email']=$usr;
		//header("Location:wallpage.php");
?>
