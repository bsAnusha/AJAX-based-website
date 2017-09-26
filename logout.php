<?php
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
session_start();
$uid=$_SESSION["uid"];
$q=mysql_query("update in_out set logout_time=now() where uid='$uid' and logout_time=''");
header("Location:login.html");
?>