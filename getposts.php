<?php
extract($_GET);	
session_start();
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
$email=$_SESSION['email'];
$q1=mysql_query("select * from user where email='$email'");
$rows=mysql_fetch_assoc($q1);
$co=$cnum;
$u=$rows['uid'];
$ret = array();
$i=0;
$q2=mysql_query("select * from friends_with where uid='$u'");

while($r=mysql_fetch_assoc($q2))
{
	$t=$r['fid'];
	$q4=mysql_query("select * from user where uid = '$t'");
	$s=mysql_fetch_assoc($q4);
	$dp=$s['dp'];
	$q3=mysql_query("select * from scribble where uid='$t'");
	
	while($a=mysql_fetch_assoc($q3))
	{		$fn = $s['fname']; 
	    	$pt = $a['post_time'];
			$con = $a['content'] ;
			$ret[$i]= array($fn,$dp,$pt,$con);
			$i++;
			
	}
}

echo json_encode($ret);
?>