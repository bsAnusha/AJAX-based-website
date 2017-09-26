<?php
	session_start();
	$servername="localhost";
	$username="root";
	$password="";
	$c=mysql_connect($servername,$username,$password);
	mysql_select_db("social_network"); 
	$uid=$_SESSION["uid"];
	$q=mysql_query("select * from message where uid='$uid'");
	$ret=array();
	while($rows=mysql_fetch_assoc($q))
	{
		$u=$rows["rid"];
		$q1=mysql_query("select * from user where uid='$u'");
		$r=mysql_fetch_assoc($q1);
		$ret[$r["fname"]]=$r["dp"];
	}
	echo json_encode($ret);
?>