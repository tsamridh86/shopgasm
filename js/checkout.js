$(".button-collapse").sideNav();


$(document).ready(function(){

	calculatePrices();
	
});

$(".quantity").change(function(){
	calculatePrices();
});


function calculatePrices()
{
	var quantityArray= [] , priceArray = [] , idArray = [] ,total = 0;
	$(".quantity").each(function(index,element){
		quantityArray[index] = parseInt($(element).val());
	});
	$(".unitPrice").each(function(index,element){
		priceArray[index] = parseInt($(element).html());
	});
	$(".price").each(function(index,element){
		$(element).html(priceArray[index]*quantityArray[index]);
		total +=priceArray[index]*quantityArray[index];
	});

	$(".idHolder").each(function(index,element){
		idArray[index] = $(element).html();
	});
	

	$("#pIdString").val(JSON.stringify(idArray));
	$("#quantityString").val(JSON.stringify(quantityArray));

	$("#totalPrice").html(total);	
	$("#finalPrice").val(total);	
	
}

$("#orderForm").click(function(){
	$("#order").submit();
});

$("#order").submit(function(){
	confirm("Are you sure you want to place order.");
});
