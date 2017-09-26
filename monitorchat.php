<?php
	header("Content-type: text/event-stream");
	session_start();
	$servername="localhost";
	$username="root";
	$password="";
	mysql_connect($servername,$username,$password);
	$c=mysql_select_db("social_network"); 
	$uid=$_SESSION["rid"];
	$rid=$_SESSION["uid"];
	$q=mysql_query("select * from message where uid='$uid' and rid='$rid' order by sent_time desc limit 1");
	while($rows=mysql_fetch_assoc($q))
	{
			$latestmsg=$rows["content"];
			$time=$rows["rcv_time"];
			$stime=$rows["sent_time"];
			if($time=='0000-00-00 00:00:00')
			{
				if($latestmsg!="")
				{
					echo "event:mymsg\n";
					echo "retry:100\n";
					echo "data: $latestmsg\n\n";
				}
				$q2=mysql_query("update message set rcv_time=now() where content='$latestmsg' and sent_time='$stime'");
			}
	}
?>