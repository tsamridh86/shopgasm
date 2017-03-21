$(document).ready(function() {
	$('select').material_select();
	$('.modal').modal();
	
});
function getUserName(str){
	if (str.length==0) { 
            document.getElementById("userNameParent").innerHTML="supervisor_account";  
		return false;
	}
    $.ajax({
            url: "searchUserName.php?userName="+str,
            dataType:'text',
            cache: false,
            contentType : false,
            processData : false ,
            type : 'get',
            success : function(searchedResults)
            {
                if(searchedResults == 1)
                {
                    $("#userNameParent").html("thumb_up");
                    return true;
                }
                else if(searchedResults == -1)
                {
                    $("#userNameParent").html("thumb_down");

                    return false;
                }
                else
                {
                    $("#userNameParent").html("supervisor_account");
                    return false;  
                }
            }
    });
	// var searchedResults;
	// var xhttp=new XMLHttpRequest();
 //           xhttp.onreadystatechange = function() {
 //    if (this.readyState == 4 && this.status == 200) {
 //        searchedResults=this.responseText;
 //        if(searchedResults == 1)
 //        {
 //        document.getElementById("userNameParent").innerHTML="thumb_up";
 //        return true;
 //        }
 //        else if(searchedResults == -1)
 //        {
 //        	document.getElementById("userNameParent").innerHTML="thumb_down";
 //            return false;
 //        }
 //        else{
 //            document.getElementById("userNameParent").innerHTML="supervisor_account";
 //            return false;  
 //        }
	// 	}
	// }
	// xhttp.open("GET","searchUserName.php?userName="+str,true);
 //  xhttp.send();
}
function checkPassword(str)
{
    var password=$("#password").val();
    if(str.length ==0)
    {
        $("#confirmPasswordParent").html("replay");
        return false;

    }
    else if(str == password)
    {   
        $("#confirmPasswordParent").html("thumb_up");
        return true;
    }
    else if(str != password)
    {
        $("#confirmPasswordParent").html("thumb_down");
        return false;
    }
    else{
        $("#confirmPasswordParent").html("replay");
        return false;
    }
    return false;

}
function checkPhoneNumber(str)
{
    if(str.length == 10)
    {
        $("#phoneNumberParent").html("phone");
        return true;
    }
    else if(str.length == 0)
    {
        $("#phoneNumberParent").html("phone");
       return false;
    }
    else{
        $("#phoneNumberParent").html("call_end");
        return false;
    }
}

function validateForm()
{
    var phoneNumber=checkPhoneNumber(document.getElementById("phoneNumber").value);
    var password=checkPassword(document.getElementById("confirmPassword").value);
    var userName=$("#userNameParent").html();
    console.log(phoneNumber+" "+password+" "+userName)
    if((phoneNumber == true) && (password ==true) && (userName == "thumb_up"))
    {
        return true;
    }
    else if(phoneNumber == false)
    {
        alert("phone Number must be 10 digits")
        return false;
    }
    else if(password == false)
    {
        alert("Password must watch")
        return false;
    }
    else if(userName == "thumb_down")
    {
        alert("userName must be unique")
        return false;
    }
    else{
        return false;
    }
}
