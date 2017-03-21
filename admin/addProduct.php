<?php
	require '../config/connection.php';
	require '../config/classes.php';

	$admin = new Admin($conn);

	if(isset($_POST["name"]))
	{
		$name = $_POST["name"];
		$brand = $_POST["brand"];
		$quantity = $_POST["quantity"];
		$price = $_POST["price"];
		$category = $_POST["category"];
		$productImg = $_FILES["productImg"]["tmp_name"];
		$productImgName = $_FILES["productImg"]["name"];
		$extension = pathinfo($productImgName, PATHINFO_EXTENSION);
		$productImgName = $brand."_".$name.".".$extension;
		move_uploaded_file($productImg, '../images/'.$productImgName);

		$check = $admin->isProduct($name, $brand);

		if($check == -1)
			echo "Product with same brand and name already exist !!!";
		else
		{
			$result = $admin->addProduct($name, $brand, $price, $category, $quantity, $productImgName);
			if(!$result)
				echo "Sorry something went wrong.";
				// echo "<script type='text/javascript'>alert('went wrong')</script>";
			else
				echo "Product added successfully.";

				// echo "<script  type='text/javascript'>alert('done')</script>";	

		}		
	}
	
?>