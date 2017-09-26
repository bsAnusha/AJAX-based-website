<?php
	session_start();
	$servername="localhost";
	$username="root";
	$password="";
	$c=mysql_connect($servername,$username,$password);
	mysql_select_db("social_network"); 
	$msg=$_GET["msg"];
	$rname=$_GET["rname"];
	$uid=$_SESSION["uid"];
	$q=mysql_query("select * from user where dp='$rname'");
	$rows=mysql_fetch_assoc($q);
	$rid=$rows["uid"];
	$_SESSION["rid"]=$rid;
	if($msg!="")
		$q1=mysql_query("insert into message"."(uid,rid,sent_time,content,rcv_time)"."values('$uid','$rid',now(),'$msg','')",$c);
?>
