<?php
$servername="localhost";
$username="root";
$password="";
mysql_connect($servername,$username,$password);
mysql_select_db("social_network");
session_start(); 
$email=$_SESSION['email'];
$q1=mysql_query("select * from user where email='$email'");
$r=mysql_fetch_assoc($q1);
$q2=$r["uid"];

extract($_POST);
	if($fn)
	$q=mysql_query("update user set fname='$fn' where uid='$q2'");
	if($ln)
	$q=mysql_query("update user set lname='$ln' where uid='$q2'");
	if($em)
	$q=mysql_query("update user set email='$em' where uid='$q2'");
$_SESSION['fname']=$fn;
$_SESSION['email']=$em;
header("Location:profile.php");
?>