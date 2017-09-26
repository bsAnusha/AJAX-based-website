<?php
	$servername="localhost";
	$username="root";
	$password="";
	mysql_connect($servername,$username,$password);
	mysql_select_db("social_network"); 
	extract($_GET);
	header("Content-type:text/event-stream");
	ob_flush();
	flush();
	ob_start();
	$rid=1;
	$q1=mysql_query("select * from message where rid='$rid'");
	while(true)
	{
		while($rows=mysql_fetch_assoc($q1))
		{
			if($rows['content']!='')
			{
				echo "event:mymsg\n";
				echo "data:$rows['content']\n\n";
				ob_flush();
				flush();
			}
			$q2=mysql_query("insert into message"."(rid,uid,sent_time,content)"."values('$uid','$rid',now(),'$msg')",$c);
			$q3=mysql_query("insert into message"."(uid,rid,sent_time,content)"."values('$uid','$rid',now(),'$msg')",$c);
		}
		clearstatcache();
		sleep(3);
	}
?>
