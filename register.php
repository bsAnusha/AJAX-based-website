<?php
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
session_start();
	
	$Email=$_POST["email"];
	$que1=mysql_query("select * from user where email='$Email'");
	if(mysql_num_rows($que1))
	{
		$_SESSION['email']=$usr;
		header("Location:wallpage.php");
	}
	else
	{
		$FirstName=$_POST["fname"];
	 	$LastName=$_POST["lname"];
		$Gender=$_POST["gender"];
		$Birthday_Date=$_POST["bday"];
		$Email=$_POST["email"];
		$Password=$_POST["pwd"];
		$Password1=$_POST["pwd1"];
	 	if($Password == $Password1)
		{
		$que2="insert into user"."(fname,lname,gender,birthdate,email,password)". "values('$FirstName','$LastName','$Gender','$Birthday_Date','$Email','$Password')";
		$r=mysql_query($que2,$c);
		$_SESSION['email']=$usr;
		header("Location:wallpage.php");
      }
		else
		{
			echo "Password doesn't match";
		}
	}
?>
