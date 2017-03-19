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
    var password=$("#password").val();
    if(str.length ==0)
    {
        $("#confirmPasswordParent").html("replay");
        return;

    }
    if(str == password)
    {   
        $("#confirmPasswordParent").html("thumb_up");
    }
    else if(str != password)
    {
        $("#confirmPasswordParent").html("thumb_down");

    }
    else{
        $("#confirmPasswordParent").html("replay");

    }
}
function checkPhoneNumber(str)
{
    if(str.length == 10)
    {
        $("#phoneNumberParent").html("phone");
        return;
    }
    else if(str.length == 0)
    {
        $("#phoneNumberParent").html("phone");
       return ;
    }
    else{
        $("#phoneNumberParent").html("call_end");
        return;
    }
}

