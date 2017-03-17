$(document).ready(function() {
	$('select').material_select();
	$('.modal').modal();
	
});
function getUserName(str){
	if (str.length==0) { 
            document.getElementById("userNameParent").innerHTML="supervisor_account";  
		return;
	}
	var searchedResults;
	var xhttp=new XMLHttpRequest();
           xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        searchedResults=this.responseText;
        if(searchedResults == 1)
        {
        document.getElementById("userNameParent").innerHTML="thumb_up";
        }
        else if(searchedResults == -1)
        {
        	document.getElementById("userNameParent").innerHTML="thumb_down";
        }
        else{
            document.getElementById("userNameParent").innerHTML="supervisor_account";  
        }
		}
	}
	xhttp.open("GET","searchUserName.php?userName="+str,true);
  xhttp.send();
}
function checkPassword(str)
{
    var password=document.getElementById("password").value;
    if(str.length ==0)
    {
        document.getElementById("confirmPasswordParent").innerHTML="replay"
        return

    }
    if(str == password)
    {   
        document.getElementById("confirmPasswordParent").innerHTML="thumb_up"
    }
    else if(str != password)
    {
        document.getElementById("confirmPasswordParent").innerHTML="thumb_down"

    }
    else{
        document.getElementById("confirmPasswordParent").innerHTML="replay"

    }
}

