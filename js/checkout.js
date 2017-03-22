$(".button-collapse").sideNav();


$(document).ready(function(){

	calculatePrices();
	
});

$(".quantity").change(function(){
	calculatePrices();
});


function calculatePrices()
{
	var quantityArray= [] , priceArray = [] ,total = 0;
	$(".quantity").each(function(index,element){
		quantityArray[index] = parseInt($(element).val());
	});
	var totalItems = quantityArray.lenght;
	$(".unitPrice").each(function(index,element){
		priceArray[index] = parseInt($(element).html());
	});
	$(".price").each(function(index,element){
		$(element).html(priceArray[index]*quantityArray[index]);
		total +=priceArray[index]*quantityArray[index];
	});
	
	$("#totalPrice").html(total);	
	
}