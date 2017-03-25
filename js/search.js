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
