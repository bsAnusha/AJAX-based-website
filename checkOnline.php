<?php
	session_start();
	$servername="localhost";
	$username="root";
	$password="";
	$c=mysql_connect($servername,$username,$password);
	mysql_select_db("social_network"); 
	$uid=$_SESSION["uid"];
	$q=mysql_query("select * from friends_with f join in_out io on f.fid=io.uid where f.uid='$uid' and io.logout_time=''");
	$ret=array();
	while($rows=mysql_fetch_assoc($q))
	{
		$u=$rows["fid"];
		$q1=mysql_query("select * from user where uid='$u'");
		$r=mysql_fetch_assoc($q1);
		$ret[$r["fname"]]=$r["dp"];
	}
	echo json_encode($ret);
?>