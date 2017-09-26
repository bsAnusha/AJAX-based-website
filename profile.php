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
  <script type=text/javascript>
  function setDp()
  {
		<?php
			$_SESSION['email'] = $e1;
		?>
		xhr = new XMLHttpRequest();
		xhr3=new XMLHttpRequest();
		xhr.onreadystatechange = set;
		xhr.responseType = "blob";
		xhr.open("GET", "setdp.php", true);
		xhr.send();
		$("#upload").click(function(){
        $("#myModal1").modal({backdrop: false});});
  }
  function set()
  {
		if(xhr.readyState == 4 && xhr.status== 200)
		{
			data = xhr.response;
			dp = document.getElementById("dp");
			img1 = document.createElement("img");
			img1.src = URL.createObjectURL(data);
			img1.className="img-responsive img-circle";
  		img1.style.width="300px";
  		img1.style.height="300px";
			dp.appendChild(img1); 
			fetchPosts();
		}
  }
  function changePic()
  {
		<?php
			$_SESSION['email'] = $e1;
		?>
  }
  function setPropic()
  {
  		file = document.getElementById("image");
		
		xhr2= new XMLHttpRequest();
		var image = file.files[0];
		form = new FormData();
		form.append("image", image);
		
		xhr2.onreadystatechange = changed;
		
		xhr2.open("POST", "setProfile.php", true);
	
		xhr2.send(form);

  }
  function changed()
  {
  		if(xhr2.readyState == 4 && xhr2.status == 200)
  		{
  			var img1=document.createElement("img");
  			img1.src=xhr2.responseText;
  			img1.className="img-responsive img-circle";
  			img1.style.width="300px";
  			img1.style.height="300px";
  			var dd= document.getElementById("dp");
  			while(dd.hasChildNodes())
  				dd.removeChild(dd.lastChild);
  			dd.appendChild(img1);
  			//alert(img1.style.width);
  			//alert(img1.className);
  		}
  }
  function fetchPosts() 
  {
      // body...
    pc=document.getElementById("jumbo");
    pc.style.display="block";
    //alert(window.scrollY-obj.ref);
      xhr3.onreadystatechange=showPosts;
      xhr3.open("GET","getmyposts.php",true);
      xhr3.send();
    }
    function  showPosts() {
      // body...
      if(xhr3.readyState==4 && xhr3.status==200)
      {
          
          posts=JSON.parse(this.responseText);
          //alert(users);
          //alert(posts);
          for(var i=0;i<posts.length;i++)
          {
            var newdiv=document.createElement("div");
            newdiv.className="media";
  
            var bnewdiv = document.createElement("div");
            bnewdiv.className="media-body";
            var small=document.createElement("small");
            var ii=document.createElement("i");
            var pi= document.createElement("p");
            pi.innerHTML="Posted at : "+posts[i][0];
            ii.appendChild(pi);
            small.appendChild(ii);
            bnewdiv.appendChild(small);
            var cat=posts[i][1];
            //alert(cat);
            if(cat.indexOf("jpg")>0 || cat.indexOf("jpeg")>0)
            {
                  var postimg=document.createElement("img");
                  postimg.className="img-thumbnail";
                  postimg.style.width="200px";
                  postimg.style.height="200px";
                  postimg.src=cat;
                  bnewdiv.appendChild(postimg);

            }
            else if (cat.indexOf("ogg") >0 || cat.indexOf("mp4") > 0) 
            {
                  var postvid=document.createElement("video");
                  postvid.className="img-thumbnail";
                  postvid.style.width="200px";
                  postvid.style.height="200px";
                  postvid.src=cat;
                  postvid.controls=true;
                  bnewdiv.appendChild(postvid);
            }
            else if(cat.indexOf("mp3")>0)
            {
                  var postaud=document.createElement("audio");
                  postaud.className="img-thumbnail";
                  postaud.src=cat;
                  postaud.controls=true;
                  bnewdiv.appendChild(postaud);
            }
            else
            {
                var p= document.createElement("p");
                p.innerHTML="Content : " +cat;
                bnewdiv.appendChild(p);
            }
            
            newdiv.appendChild(bnewdiv);
            pc.appendChild(newdiv);
            pc.appendChild(document.createElement("hr"));
            /*newdiv.innerHTML=users[i];
            newdiv.className="";
            newdiv.onclick=suggest.setUser;
            obj.pc.appendChild(newdiv);*/

          }
      }
    }
  </script>
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
</head>
<body onload="setDp()">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="wallpage.php">Go to wall</a>
    </div>
    
      
           
  </div>
</nav>

<div class="container-fluid bg-1 text-center">
	
	<div class="col-sm-3 text-right" id="dp">
	</div>
	
	<div class="col-sm-9 text-left">
	<br><br><br><br><br><h2><?php echo $e; ?> </h2>

	<input type="button" class="btn btn-success" value="Change DP" id="upload"/>
	<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Choose Image</h4>
        </div>
        <div class="modal-body">
         
              <label for="picture"><span class="glyphicon glyphicon-film"></span> Browse : </label>
              <input type="file" name="image" id="image" accept="image/*" class="form-control"><hr>
              <button type="button" class="btn btn-success btn-block" onclick="setPropic()"><span class="glyphicon glyphicon-upload"></span>Change DP!!</button>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	<br><br>
	<form action="editInfo.php" method="GET">
	<button type="submit" id="info" class="btn btn-info">Edit profile!!</button><br>
	</form>
	<br>
	</div> <br>
	
  </div>
<div class="container">
<div class="jumbotron" id="jumbo">
 
</div>
</div>
</body>
</html>
