function init()
{
	$("#online").hide();
	$("#chatbox").hide();
	$("#chat").bind("click",showFrnds);
	$("#end").bind("click",closeChat);
	$("#online").bind("click",makeComet);
	showPic();
}
function showPic()
{
	xhr=new XMLHttpRequest();
	xhr.onreadystatechange=display;
	xhr.open("GET","profilePic.php",true);
	xhr.send();
}
function display()
{
	if(this.readyState==4 && this.status==200)
	{
		div=document.getElementById("recent_chats");
		i=document.createElement("img");
		p=document.createElement("p");
		arr=JSON.parse(this.responseText);
		for(key in arr)
		{
			span=document.createElement("span");
			p.innerHTML=key;
			p.style.color="white";
			p.style.fontSize="70px";
			i.src=arr[key];
			i.style.width="200px";
			i.style.height="200px";
			i.style.borderRadius="50%";
			i.style.cssFloat="left";
			//p.style.textAlign="center";
			span.appendChild(p);
			span.appendChild(i);
		}
		div.appendChild(span);
	}
	
}
function closeChat()
{
	$("#chatbox").hide();
}
function showFrnds()
{
	$("#online").show();
	xhr=new XMLHttpRequest();
	xhr.onreadystatechange=showStatus;
	xhr.open("GET","checkOnline.php",true);
	xhr.send();
	setTimeout(showFrnds,5000);
}
function showDiv()
{
	$("#chatbox").show();
	$("#end").bind("click",hide);
}
function hide()
{
	$("#chatbox").hide();
}
function showStatus()
{
	if(this.readyState==4 && this.status==200)
	{
		div=document.getElementById("online");
		while(div.hasChildNodes())
			div.removeChild(div.childNodes[0]);
		arr=JSON.parse(this.responseText);
		for(key in arr)
		{
			span=document.createElement("span");
			i=document.createElement("img");
			i.src=arr[key];
			i.style.height="50px";
			i.style.width="50px";
			i.style.borderRadius="50%";
			i.style.cssFloat="left";
			i.addEventListener("click",findImg);
			d=document.createElement("div");
			d.innerHTML=key;
			d.style.color="crimson";
			d.style.font="40px";
			d.style.textAlign="left";
			span.appendChild(i);
			span.appendChild(d);
			div.appendChild(span);
		}
	}
}
function findImg(event)
{
	e=event.target;
	rname=e.src.substr(this.src.lastIndexOf('/') + 1);
	$("#chatbox").show();
}
function failure()
{
	alert("Error");
}
function makeComet()
{
	ev=new EventSource("monitorchat.php");
	ev.addEventListener("mymsg",handle,true);
}
function handle(event)
{
	data=event.data;
	d1=document.getElementById("chatbox");
	d=document.createElement("div");
	d.innerHTML=data;
	d.style.width="150px";
	d.style.background="bisque";
	d.className="pull-right";
	d1.appendChild(d);
	d1.appendChild(document.createElement("br"));
}
function send()
{
	data=document.getElementById("msg").value;
	d1=document.getElementById("chatbox");
	d=document.createElement("div");
	xhr=new XMLHttpRequest();
	xhr.onreadystatechange=show;
	xhr.open("GET","w1.php?msg="+data+"&rname="+rname,true);
	xhr.send();
	d.innerHTML=data;
	d1.appendChild(document.createElement("br"));
	d.style.width="150px";
	d.style.background="palegreen";
	d.className="pull-left"
	d1.appendChild(d);
	d1.appendChild(document.createElement("br"));
	document.getElementById("msg").value="";
}
function show()
{
	if(this.readyState==4 && this.status==200)
	{
		alert(this.responseText);
	}
}