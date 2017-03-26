var div;
var brands="";
var category="";
var price="";
$(document).ready(function() {
	$('select').material_select();
	$('.modal').modal();
	
    // make checkbox checked
    var url = window.location.href;
    url=url.split('?')
    url=url[1].toString();
    if(url.indexOf('&') > -1) //not only q
    {
        url=url.split('&');
        var i=1,temp=0,temp2=0,j=0;
        while(i < url.length) //lopping through alll categories
        {
            temp=url[i].split("=");
            temp=temp[1].toString(); //removing brand=

            if(url[i].indexOf(",") == -1) //one one parameter
            {
                document.getElementById(temp).checked=true;
            }
            else{ // more than  one parameter

                 temp2=temp.split(',');
                 j=0;
                 while(j < temp2.length)
                 {  
                    document.getElementById(temp2[j].toString()).checked=true;
                    j++;
                 }

            }
            i++;
        }
    }
var c = new Array();
   c = document.getElementsByTagName('input');
   for (var i = 0; i < c.length; i++)
   {
       if (c[i].type == 'checkbox')
       {
           div=c[i].parentNode.parentNode.id;
           // console.log(div)
           // console.log(c[i].value + " "+c[i].checked);
           if(div == "priceCollection" && c[i].checked == true)
           {
                // console.log("in price");

            if(price == "")
                {
                    price="&price="+c[i].value;
                }
                else{
                     price=price+','+c[i].value;
                }
           }
           if(div == "brandCollection" && c[i].checked == true)
           {
                // console.log("in brand");
                if(brands == "")
                {
                    brands="&brand="+c[i].value;
                }
                else{
                     brands=brands+','+c[i].value;
                }
           }
           
        if(div == "categoryCollection" && c[i].checked == true)
           {
                // console.log("in category");

                if(category == "")
                {
                    category="&category="+c[i].value;
                }
                else{
                     category=category+','+c[i].value;
                }    
       }
   }
}
   console.log(brands + price + category);



});

$(".button-collapse").sideNav();

$("#brandClick").click(function(){
	$("#brandCollection").toggle("slow");
	var arrowDirection  = ($("#brandArrow").attr("class"));
	if (arrowDirection == "fa fa-sort-down right")
		$("#brandArrow").removeClass().addClass("fa fa-sort-up right");
	else
		$("#brandArrow").removeClass().addClass("fa fa-sort-down right")
});

$("#priceClick").click(function(){
	$("#priceCollection").toggle("slow");
	var arrowDirection  = ($("#priceArrow").attr("class"));
	if (arrowDirection == "fa fa-sort-down right")
		$("#priceArrow").removeClass().addClass("fa fa-sort-up right");
	else
		$("#priceArrow").removeClass().addClass("fa fa-sort-down right")
});

$("#categoryClick").click(function(){
	$("#categoryCollection").toggle("slow");
	var arrowDirection  = ($("#categoryArrow").attr("class"));
	if (arrowDirection == "fa fa-sort-down right")
		$("#categoryArrow").removeClass().addClass("fa fa-sort-up right");
	else
		$("#categoryArrow").removeClass().addClass("fa fa-sort-down right")
});

function addToCart(sender){


    var pId = sender.parentNode.parentNode.id;
    var uId = $('#uId').html();
    uId = parseInt(uId);
    var formData = new FormData();
    formData.append('uId',uId);
    formData.append('pId',pId);
    $.ajax({
        url : "addToCart.php",
        dataType: 'text',
        cache : false, 
        contentType : false,
        processData : false,
        data : formData,
        type : 'post',
        async:false,

        success : function(response)
        {
            console.log("success" + response);
            alert(response);
            if(response == "Product addded to cart successfully")
                $('#'+pId).find('#addToCart').html("Remove from Cart");
            else
                $('#'+pId).find("#addToCart").html("Add to cart");
            
        },
        error : function(response)
        {
            console.log("error" + response);
            alert("Some problem");
        }
    });
}

$('#cart').click(function(){
    var uId = $('#uId').html();
    uId = parseInt(uId);
    var formData = new FormData();
    
    var formData = new FormData();
    formData.append('uId',uId);
    formData.append('req','disp');
    $.ajax({

        url : "addToCart.php",
        dataType: 'text',
        cache : false, 
        contentType : false,
        processData : false,
        data : formData,
        type : 'post',
        async:false,

        success : function(response)
        {
            var content;
            console.log("success" + response);
            $('#cartTable').hide();
            $('#cartTable').empty();

            if(response != "No items in Cart")
            {
                $("#noItem").empty();
                var array = JSON.parse(response);
                for(i = 0 ; i < array.length ; i++)
                {
                    content = "<tr><td>"+array[i]['pName']+"</td><td>"+array[i]['pPrice']+"</td></tr>";
                    $('#cartTable').append(content);
                }            

                $('#cartTable').fadeIn();
                $("#cartStart").removeClass("hidden");
            }
            else
            {   
                console.log("hi");
                $("#cartStart").addClass("hidden");
                $("#noItem").hide();
                $("#noItem").empty();
                $("#noItem").append(response);
                $("#noItem").fadeIn();
            }

        },
        error : function(response)
        {
            console.log("error" + response);
        }

    });


});
function getUrlQueryOption()
{
    var url=window.location.href;
    url=url.split('?');
    url=url[1].toString();
    if(url.indexOf('&') ==-1)
    {
        return url;
    }
    else{
        url=url.split('&');
        return url[0].toString()
    }

        
    
}
// function searchBrand(brand)
// {
//     var url=getUrl.toString();
//     var isBrand=url.indexOf("brand");
//     if(isBrand == -1) //no any brand searched yet
//     {
//         window.location.href=url+"&brand="+brand;
//     }
//     else //some brand searched already
//     {
//         // look for index of brand
//         var temp=url.split('&');
//         var indexOfBrand=temp.indexOf("brand");
//         temp=temp[indexOfBrand].toString();
//         var isMultipleBrand=temp.indexOf(',');
//         if(isMultipleBrand == -1) //only one brand
//         {
//             temp=temp+","+brand;
//             var newUrl="localhost/shopgasm/search.php?"+
//         }
//     }
// }
// intialising variables so that already checked will be maintianed

function searchBrands(str)
{
    if(brands == "")
    {
        brands="&brand="+str;
    }
    else{
        if(brands.indexOf(str) == -1 && (document.getElementById(str).checked == true))
        {
            brands=brands+','+str;
        }
    else if(document.getElementById(str).checked == false)
        {
            // if(brandFlags[str]==1) //if 
            if((brands.split(',').length-1)== 0) //only one category
            {
                brands="";
            }
            else{
                var index=brands.indexOf(str);
                if(brands[index-1] != "=")
                    brands=brands.replace(","+str,""); //remove str
                else{ //first category don't need comma
                    brands=brands.replace(str+",",""); //remove str

                }
            }
        }
    }
    console.log(brands);
}
function searchPrice(str)
{
    if(price == "")
    {
        price="&price="+str;
    }
    else{
         if(price.indexOf(str) == -1 && (document.getElementById(str).checked == true))
        price=price+','+str;
    else if(document.getElementById(str).checked == false)
        {
            if((price.split(',').length-1)== 0) //only one category
            {
                price="";
            }
            else{
                var index=price.indexOf(str);
                if(price[index-1] != "=")
                    price=price.replace(","+str,""); //remove str
                else{ //first category don't need comma
                    price=price.replace(str+",",""); //remove str

                }
            }
        }

    }
    console.log(price);
}
function searchCategory(str)
{
    if(category == "")
    {
        category="&category="+str;
    }
    else{
        if(category.indexOf(str) == -1 && (document.getElementById(str).checked == true))
        category=category+','+str;
    else if(document.getElementById(str).checked == false)
        {
            if((category.split(',').length-1)== 0) //only one category
            {
                category="";
            }
            else{
                var index=category.indexOf(str);
                if(category[index-1] != "=")
                    category=category.replace(","+str,""); //remove str
                else{ //first category don't need comma
                    category=category.replace(str+",",""); //remove str

                }
            }
        }
    }
    console.log(category);
}
function getAllFilters()
{
    var q=getUrlQueryOption();
    window.location.href="search.php?"+q+brands+category+price;
}
