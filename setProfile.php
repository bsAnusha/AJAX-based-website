<?php
	
session_start();
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
$email=$_SESSION['email'];
$image = $_FILES['image']['name'];
$q=mysql_query("update user set dp='$image' where email='$email'");
echo "".$image;


?>