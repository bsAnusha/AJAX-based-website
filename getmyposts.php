<?php
extract($_GET);	
session_start();
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
$email=$_SESSION['email'];
$q1=mysql_query("select * from user where user.email='$email'");
$rows=mysql_fetch_assoc($q1);
$u=$rows['uid'];
$ret = array();
$i=0;
	$q3=mysql_query("select * from scribble where scribble.uid='$u'");
	
	while($a=mysql_fetch_assoc($q3))
	{
	    	$pt = $a['post_time'];
			$con = $a['content'] ;
			$ret[$i]= array($pt,$con);
			$i++;
			
	}
echo json_encode($ret);
?>
