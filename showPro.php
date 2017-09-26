<?php 
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
extract($_POST);
$fn=$_POST["search"];
$q=mysql_query("select * from user where fname='$fn'");
$row=mysql_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Theme Simply Me</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="jquery.js"></script>
	  <script type="text/javascript" src="BS/js/bootstrap.min.js"></script>
 
<style>
.bg-1 { 
    background-color: #474e5d; /* Green */
    color: #ffffff;
}
.bg-2 { 
    background-color: #474e5d; /* Dark Blue */
    color: #ffffff;
}
.bg-3 { 
    background-color: #ffffff; /* White */
    color: #555555;
}
.container-fluid {
    padding-top: 70px;
    padding-bottom: 70px;
}
.image-fluid {
    padding-top: 20px;
    padding-bottom: 20px;
}
.thumbnail{        
    width: 300px; 
    height: 500px;
    overflow: auto;
}
</style>
</style>
</head>
<body>

<div class="container-fluid bg-1 text-center">
	
	<div class="col-sm-3 text-right">
	<img class="img-responsive img-circle" src="<?php echo $row['dp']; ?>;" id="dp" style="display: block;height: 300px ;width:300px" />
	</div>
	
	<div class="col-sm-9 text-left">
	<br><br><br><br><br><h2><?php echo $fn; ?> </h2>
	</div>
</div>
<div class="container">
<div class="jumbotron" id="jumbo">
 
</div>
</div>
</body>
</html>