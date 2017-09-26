<?php
$servername="localhost";
$username="root";
$password="";
mysql_connect($servername,$username,$password);
mysql_select_db("social_hub_db");
session_start(); 
$e1=$_SESSION['email'];
?>
<input type="file" />