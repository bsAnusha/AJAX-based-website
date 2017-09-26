
function sinit(){
	suggest= new Suggest();
	suggest.user=document.getElementById("search");
	suggest.divcontainer=document.getElementById("searchfill");
	//alert("hi..");
}
//Constructor function for the Suggest functionality
function Suggest(){
	this.timer=null;
	this.xhr=new XMLHttpRequest();
	//Function that decides WHEN we should go to the server,
	//This function will be called everytime the user types
	//a character.
	this.getUsers=function(){
		if(this.timer){
			clearTimeout(this.timer);
		}
		this.timer=setTimeout(suggest.fetchUsers,1000);
	};
	this.fetchUsers=function(){
		//alert("Going now");
		
		if(suggest.user.value==""){
			
			suggest.divcontainer.innerHTML="";
			suggest.divcontainer.style.display="none";
			return;
		}else{
			if(localStorage[suggest.user.value]){
				suggest.showUsers(JSON.parse(localStorage[suggest.user.value]));
				
			}else{
				suggest.xhr.onreadystatechange=suggest.populateUsers;
				suggest.xhr.open("GET","getUsers.php?user="+suggest.user.value,true);
				suggest.xhr.send();
				
			}
		}
	};
	this.populateUsers=function(){
		
		if(this.readyState==4 && this.status==200){
			users=JSON.parse(this.responseText);
			//alert(users);
			if(users.length==0){
				suggest.user.className="form-control";
				suggest.divcontainer.innerHTML="";
				suggest.divcontainer.style.display="none";
			}else{
				
				localStorage[suggest.user.value]=this.responseText;
				suggest.user.className="form-control";
				suggest.showUsers(users);
			}
		}
	};
	this.showUsers=function(movList){
		suggest.divcontainer.innerHTML="";
		
		for(i=0;i<movList.length;i++){
			newdiv=document.createElement("div");
			newdiv.innerHTML=movList[i];
			newdiv.className="suggest";
			newdiv.onclick=suggest.setUser;
			suggest.divcontainer.appendChild(newdiv);
		}
		suggest.divcontainer.style.display="block";
	}
	this.setUser=function(event){
		suggest.user.value=event.target.innerHTML;
		suggest.divcontainer.innerHTML="";
		suggest.divcontainer.style.display="none";
	}
	
	//Call to go
}