<?php
	
session_start();
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
$email=$_SESSION['email'];
$q1=mysql_query("select * from user where email='$email'");
$rows=mysql_fetch_assoc($q1);
$u=$rows['uid'];
$ret = array();
$i=0;
$q2=mysql_query("select * from friend_requests where receiver='$u'");
while($r=mysql_fetch_assoc($q2))
{	
	$rec=$r['sender'];
	$q3=mysql_query("select * from user where uid='$rec'");
	$s=mysql_fetch_assoc($q3);
	$fn=$s['fname'];
	$dp=$s['dp'];
	$ret[$i]= array($fn,$dp );
	$i++;
}
echo json_encode($ret);
?>