<?php
	extract($_GET);
	$servername="localhost";
	$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network");
$e=mysql_query("select fname from user");

	$ret=array();
	while($rows=mysql_fetch_assoc($e)){
		if(strncasecmp($rows['fname'],$user,strlen($user))==0){
			$ret[]=$rows['fname'];
		}
	}
	echo json_encode($ret);
?>


