<?php
$servername="localhost";
$username="root";
$password="";
mysql_connect($servername,$username,$password);
mysql_select_db("social_network");
session_start(); 
$e1=$_SESSION['email'];
$e =$_SESSION['fname'];
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
	padding-top: 20px;
    padding-bottom: 20px;
	padding-left: 20px;
	padding-right: 20px;
}
</style>

</head>
<body class="text-center">

<div class="bg-1 text-center">
<h3>Edit Details!</h3>
</div>

<div class="container" >
<form method="post" action="updateDetails.php">
<div class="container" >
<div class="jumbotron" id="jumbotron1">
<div class="input-group">
     <span class="input-group-addon">First Name</span>
     <input id="fn" type="text" width="200" class="form-control" name="fn">
</div>
</div>
</div>

<div class="container" >
<div class="jumbotron" id="jumbotron1">
<div class="input-group">
     <span class="input-group-addon" >Last Name</span>
     <input id="ln" type="text" width="200" class="form-control" name="ln">
</div>
</div>
</div>

<div class="container" >
<div class="jumbotron" id="jumbotron1">
<div class="input-group">
     <span class="input-group-addon">Email</span>
     <input id="em" type="email" width="200" class="form-control" name="em">
</div>
</div>
</div>
<input type="submit" class="btn btn-success" value="Make changes" id="upload"/>
</form>
</div>

</body>
</html>
