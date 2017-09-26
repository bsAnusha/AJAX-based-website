<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="jquery.js"></script>
	  <script type="text/javascript" src="BS/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="suggests.js"></script>
    <link rel="stylesheet" type="text/css" href="suggest.css"/>
  <?php
session_start();
$servername="localhost";
$username="root";
$password="";
$c=mysql_connect($servername,$username,$password);
mysql_select_db("social_network"); 
$e=$_SESSION['email'];

?>
	<script type="text/javascript">
  obj=
{
  xhr:new XMLHttpRequest(),
  xhr2:new XMLHttpRequest(),
  xhr3:new XMLHttpRequest(),
  xhr4:new XMLHttpRequest(),
  search_form:null,
  dp:null,
  btgrp:null,
  bt1:null,
  bt2:null,
  bt3:null,
  cnum:1,
  ref:0,
  init:function()
  {
    //alert("hi");
    sinit();
    setTimeout(obj.getDp,1500);
    obj.xhr3.onreadystatechange=obj.showRequests;
    obj.xhr3.open("GET","getRequests.php",true);
    obj.xhr3.send();


  },
  postUpload : function()
  {
      stat = document.getElementById("stat");
      stat = stat.value;
      obj.xhr4.onreadystatechange=obj.postIt;
      obj.xhr4.open("GET","postIt.php?stat="+stat,true);
      obj.xhr4.send();
  },
  postIt : function()
  {
    if(obj.xhr4.readyState==4 && obj.xhr4.status==200)
    { 
            
            alert("Status " + this.responseText + " posted successfully !");
    }
  },
  showRequests : function()
  {
    var dd= document.getElementById("dd");
    if(obj.xhr3.readyState==4 && obj.xhr3.status==200)
    {
          //alert(obj.xhr3.responseText);
          var req=JSON.parse(obj.xhr3.responseText);
          for(var i=0;i<req.length;i++)
          {
            var li=document.createElement("li");
            var p=document.createElement("img");
            p.className="img-circle";
            p.style.height="30px";
            p.style.width="30px";
            p.src=req[i][1];
            li.innerHTML=req[i][0];
            li.appendChild(p);
            dd.appendChild(li);
          }
          
    }
  },
  displayForm:function()
  {
    
    search_form=document.getElementById("search_form");
    search_form.style.display="block";
    
    
  },
  getDp:function()
  {
    //alert("hi");
    setTimeout(obj.fetchPosts,2000);
    obj.dp=document.getElementById("dp");
    obj.dp.style.display="block";
    obj.xhr.onreadystatechange=obj.showDp;
    obj.xhr.open("GET","getDp.php",true);
    obj.xhr.send();
  },
  showDp : function()
  {
    if(obj.xhr.readyState==4 && obj.xhr.status==200)
    {
          //alert(obj.xhr.responseText);
          obj.dp.src=obj.xhr.responseText;
          setTimeout(obj.fillJumbo,1000);
          
    }
      
  },
  fillJumbo: function()
  {
          obj.btgrp =  document.createElement("div");
          obj.btgrp.className="btn-group";
          obj.bt1 =  document.createElement("button");
          obj.bt1.className="btn btn-primary btn-md";
          obj.bt1.id="myBtn";
          obj.bt1.type="button";
          obj.bt1.innerHTML="Image";
          obj.bt2 =  document.createElement("button");
          obj.bt2.className="btn btn-primary btn-md";
          obj.bt2.id="myBtn2";
          obj.bt2.type="button";
          obj.bt2.innerHTML="Video";
          obj.bt3 =  document.createElement("button");
          obj.bt3.className="btn btn-primary btn-md";
          obj.bt3.id="myBtn3";
          obj.bt3.type="button";
          obj.bt3.innerHTML="Audio";
          obj.btgrp.appendChild(obj.bt1);
          obj.btgrp.appendChild(obj.bt2);
          obj.btgrp.appendChild(obj.bt3);
          document.getElementById("jumbotron1").appendChild(obj.btgrp);
          setTimeout(obj.displayForm,2500);
    },
    postfUpload:function()
    {
      if(document.getElementById("pic").accept == "image/*")
      {
        file = document.getElementsByName("pic")[0];
      }
      else if(document.getElementById("vid").accept == "video/*")
      {
        file = document.getElementsByName("pic")[1];
      }
      else
      {
        file = document.getElementsByName("pic")[2];
      }
    
      obj.xhr5= new XMLHttpRequest();
      var upload = file.files[0];
      form = new FormData();
      form.append("upload", upload);
    
      obj.xhr5.onreadystatechange = obj.showfUpload;
    
      obj.xhr5.open("POST", "postfUpload.php", true);
  
      obj.xhr5.send(form);

    },
    showfUpload:function()
    {
      if(obj.xhr5.readyState==4 && obj.xhr5.status==200)
      {
        alert("Upload successful");
      }
    },
    fetchPosts:function() {
      // body...
    obj.pc=document.getElementById("jumbo");
    obj.pc.style.display="block";
    //alert(window.scrollY-obj.ref);
    if((window.scrollY-obj.ref)>=50){
      obj.xhr2.onreadystatechange=obj.showPosts;
      obj.xhr2.open("GET","getposts.php?cnum="+obj.cnum,true);
      obj.xhr2.send();
      obj.ref=window.scrollY;
    }

    },
    showPosts: function () 
    {
      // body...
      if(obj.xhr2.readyState==4 && obj.xhr2.status==200)
      {
          
          users=JSON.parse(this.responseText);
          //alert(users);
          for(var i=0;i<users.length;i++)
          {
            var newdiv=document.createElement("div");
            newdiv.className="media";
            var lnewdiv=document.createElement("div");
            lnewdiv.className="media-left";
            var img=document.createElement("img");
            img.className="media-object img-circle";
            img.style.width="100px";
            img.style.height="100px";
            img.src=users[i][1];
            //alert(img.src);
            lnewdiv.appendChild(img);
            newdiv.appendChild(lnewdiv);
            var bnewdiv = document.createElement("div");
            bnewdiv.className="media-body";
            var h4=document.createElement("h1");
            h4.className="media-heading";
            h4.innerHTML=users[i][0];
            var small=document.createElement("small");
            var ii=document.createElement("i");
            var pi= document.createElement("p");
            pi.innerHTML="Posted at : "+users[i][2];
            ii.appendChild(pi);
            small.appendChild(ii);
            bnewdiv.appendChild(h4);
            bnewdiv.appendChild(small);
            var cat=users[i][3];
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
                  postvid.style.width="200px";
                  postvid.style.height="200px";
                  postvid.src=cat;
                  postvid.controls=true;
                  bnewdiv.appendChild(postvid);
            }
            else if(cat.indexOf("mp3")>0)
            {
                  var postaud=document.createElement("audio");
                  postaud.src=cat;
                  postaud.controls=true;
                  bnewdiv.appendChild(postaud);
            }
            else
            {
                var p= document.createElement("p");
                p.innerHTML=cat;
                bnewdiv.appendChild(p);
            }
            
            newdiv.appendChild(bnewdiv);
            obj.pc.appendChild(newdiv);
            obj.pc.appendChild(document.createElement("hr"));
            /*newdiv.innerHTML=users[i];
            newdiv.className="";
            newdiv.onclick=suggest.setUser;
            obj.pc.appendChild(newdiv);*/
          }
          
          
          obj.cnum++;
        }
      }
}

  

	</script>
</head>
<body style="height: 1000px" onload=obj.init()>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="login.html">Friendsphere</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span></a> </li>
      <li><a href="profile.php">Profile</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="requests.html">Requests<span class="caret"></span></a>
          <ul class="dropdown-menu" id="dd">
           
          </ul>
        </li>
      <li><a href="chat.html">Start Chat</a></li>
       <li><a href="logout.php" class="btn btn-basic btn-md"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
    </ul>
    <form class="navbar-form" id="search_form" style="display: none" method="POST" action="#">
    <table border="0">
    <tr>
         <td>
         <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" id="search" name="search" onkeyup="suggest.getUsers()">
        </div>
        </td>
        <td>
           <div class="input-group-btn">
            <button class="btn btn-info" type="submit">
            <i class="glyphicon glyphicon-search"></i>
            </button>
            </div>
        </td>
    </tr>
    <tr>
    <td><div id="searchfill"></div></td>
    <td></td>
    </tr>
      </table>
    </form>
  </div>
</nav>


<div class="container" >
  <div class="jumbotron" id="jumbotron1">
    <div class="media">
      <div class="media-left">
      	<img id="dp" src="loading.gif" class="media-object" style="width:200px">
      </div>
        <div class="media-body">
      		<h4 class="media-heading">Today's status:</h4>
      		<form>
      			<div class="input-group">
     				<span class="input-group-addon">Text</span>
     				<input id="stat" type="text" width="200" class="form-control" name="stat" placeholder="Hi,Share something about your day..">
     			</div>
      		</form>
       		<button type="button" class="btn btn-success btn-sm" onclick="obj.postUpload()">
          		<span class="glyphicon glyphicon-upload"></span> Post
        	</button>
        </div>
  	 </div>
  	 <hr>
  	  
  <!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Choose Images</h4>
        </div>
        <div class="modal-body">
         
              <label for="picture"><span class="glyphicon glyphicon-film"></span> Browse : </label>
              <input type="file" name="pic" id="pic" accept="image/*" class="form-control"><hr>
              <button type="button" class="btn btn-success btn-block" onclick="obj.postfUpload()"><span class="glyphicon glyphicon-upload"></span>Upload !!</button>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Choose Videos</h4>
        </div>
        <div class="modal-body">
         
              <label for="picture"><span class="glyphicon glyphicon-film"></span> Browse : </label>
              <input type="file" name="pic" id="vid" accept="video/*" class="form-control"><hr>
              <button type="submit" class="btn btn-success btn-block" onclick="obj.postfUpload()"><span class="glyphicon glyphicon-upload"></span>Upload !!</button>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Choose Audios</h4>
        </div>
        <div class="modal-body">
              <label for="picture"><span class="glyphicon glyphicon-music"></span> Browse : </label>
              <input type="file" name="pic" id="aud" accept="audio/*" class="form-control"><hr>
              <button type="submit" class="btn btn-success btn-block" onclick="obj.postfUpload()"><span class="glyphicon glyphicon-upload"></span>Upload !!</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  </div>
 
    
</div>
<script>
$(document).ready(function(){
    setTimeout(function(){$("#myBtn").click(function(){
        $("#myModal1").modal({backdrop: false});
    })},8000); 
    setTimeout(function(){$("#myBtn2").click(function(){
        $("#myModal2").modal({backdrop: false});
    })},8000);
    setTimeout(function(){$("#myBtn3").click(function(){
        $("#myModal3").modal({backdrop: false});
    })},8000);
});
</script>
<div class="container"  >
<div class ="jumbotron" id="jumbo">
</div>
</div>
</body>
</html>

