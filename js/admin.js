$(document).ready(function(){
	$(".button-collapse").sideNav();
	$('.modal').modal();
	
	
});


$("#addForm").submit(function() {

		
		var brand = $("#brand").val();
		var name = $("#name").val();
		var price = $("#price").val();
		var quantity = $("#quantity").val();
		var category = $("#category").val();
		var productImg = $("#productImg").prop('files')[0];

		var formData = new FormData();
		formData.append('brand',brand);
		formData.append('name',name);
		formData.append('price',price);
		formData.append('quantity',quantity);
		formData.append('category',category);
		formData.append('productImg',productImg);
		formData.append('req','add');

		$.ajax({
				url : 'addProduct.php',
				dataType: 'text',
				cache : false, 
				contentType : false,
				processData : false,
				data : formData,
				type : 'post',
				async:false,
				success : function(response)
				{
					alert(response);
					console.log("success");
					console.log(response);
				},
				error : function(response)
				{
					alert(response);
					console.log("error");
					console.log(response);
				}
			});
		console.log("ended");

	});


$("#updateProduct").click(function(){

		var productId = $("#uproductId").val();
		var brand = $("#ubrand").val();
		var name = $("#uname").val();
		var price = $("#uprice").val();
		var quantity = $("#uquantity").val();
		var category = $("#ucategory").val();
		var productImg = $("#uproductImg").prop('files')[0];


		var formData = new FormData();

		formData.append('productId',productId);
		formData.append('brand',brand);
		formData.append('name',name);
		formData.append('price',price);
		formData.append('quantity',quantity);
		formData.append('category',category);
		formData.append('productImg',productImg);
		formData.append('req','update');

		$.ajax({

			url : "addProduct.php",
			dataType: 'text',
			cache : false, 
			contentType : false,
			processData : false,
			data : formData,
			type : 'post',
			async:false,

			success : function(response)
			{
				alert(response);
				console.log("success");
				console.log(response);
			},
			error : function(response)
			{
				alert(response);
				console.log("error");
				console.log(response);
			}
		});

});
