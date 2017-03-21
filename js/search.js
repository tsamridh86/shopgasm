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