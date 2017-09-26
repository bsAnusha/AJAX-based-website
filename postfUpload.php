<?php
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
session_start();
	
	//if($_SERVER['REQUEST_METHOD']=='POST'){
    	$upload = $_FILES['upload']['name'];
		$Email=$_SESSION['email'];
		$que1=mysql_query("select * from user where email='$Email'");
		$a=mysql_fetch_assoc($que1);
		$uid=$a['uid'];
		$que2="insert into scribble"."(uid,post_time,content)". "values('$uid',now(),'$upload')";
		$r=mysql_query($que2,$c);
	//}
?>
