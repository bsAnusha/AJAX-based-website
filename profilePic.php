<?php
	session_start(); 
	$servername="localhost";
	$username="root";
	$password="";
	mysql_connect($servername,$username,$password);
	mysql_select_db("social_network");
	$uid=$_SESSION["uid"];
	$q1=mysql_query("select * from user where uid='$uid'");
	$dp=array();
	while($r=mysql_fetch_assoc($q1))
	{
		$dp[$r["fname"]]=$r["dp"];
		echo json_encode($dp);
	}
?>