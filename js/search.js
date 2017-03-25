$(document).ready(function() {
	$('select').material_select();
	$('.modal').modal();
	
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
        },
        error : function(response)
        {
            console.log("error" + response);
            alert(response);
        }
    });
}
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
var brands="";
var category="";
var price="";

function searchBrands(str)
{
    if(brands == "")
    {
        brands="&brand="+str;
    }
    else{
        brands=brands+','+str;
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
        price=price+','+str;
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
        category=category+','+str;
    }
    console.log(category);
}
function getAllFilters()
{
    var q=getUrlQueryOption();
    window.location.href="search.php?"+q+brands+category+price;
}