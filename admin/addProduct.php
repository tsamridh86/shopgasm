<?php
	require '../config/connection.php';
	require '../config/classes.php';

	$admin = new Admin($conn);


	if(isset($_POST["req"]) && $_POST["req"] == "add")
	{
		$name = $_POST["name"];
		$brand = $_POST["brand"];
		$quantity = $_POST["quantity"];
		$price = $_POST["price"];
		$category = $_POST["category"];
		$productImg = $_FILES["productImg"]["tmp_name"];
		$productImgName = $_FILES["productImg"]["name"];
		$extension = pathinfo($productImgName, PATHINFO_EXTENSION);
		$productId = $admin->getLatestId();
		$productImgName = $productId.".".$extension;
		

		$check = $admin->isProduct($name, $brand);

		if($check == -1)
			echo "Product with same brand and name already exist !!!";
		else
		{
			move_uploaded_file($productImg, '../images/'.$productImgName);
			$result = $admin->addProduct($name, $brand, $price, $category, $quantity, $productImgName);
			if(!$result)
				echo "Sorry something went wrong.";
				// echo "<script type='text/javascript'>alert('went wrong')</script>";
			else
				echo "Product added successfully.";
				// echo "<script  type='text/javascript'>alert('done')</script>";	

		}
	}
	else if(isset($_POST["req"]) && $_POST["req"] == "update")
	{
		$productId =$_POST["productId"];
		$name = $_POST["name"];
		$brand = $_POST["brand"];
		$quantity = $_POST["quantity"];
		$price = $_POST["price"];
		$category = $_POST["category"];
		$productImg = $_FILES["productImg"]["tmp_name"];
		$productImgName = $_FILES["productImg"]["name"];
		$extension = pathinfo($productImgName, PATHINFO_EXTENSION);
		$productImgName = $productId.".".$extension;	

		$check = $admin->isProductId($productId);

		if($check == 1)
			echo "Brand with given Product Id does not exist. Can't update !!!";
		else
		{
			move_uploaded_file($productImg, '../images/'.$productImgName);

			$result = $admin->updateProduct($productId, $name, $brand, $productImgName, $price, $quantity, $category);
			if(!$result)
				echo "Sorry something went wrong";
			else
				echo "Product updated successfully";
		}
	}
	else if(isset($_POST["req"]) && $_POST["req"]=="del")
	{
		$productId = $_POST["productId"];

		$check = $admin->isProductId($productId);

		if($check == 1)
			echo "Brand with given Product Id does not exist";
		else
		{
			$productImgName = $admin->getImgName($productId);
			$result = $admin->deleteProduct($productId);

			if(!$result)
				echo "Sorry something went wrong";
			else
			{	
				$productImgName = $productImgName['image'];
				unlink("../images/".$productImgName);
				echo "Record deleted successfully";
			}
		}
	}
	else
	{

	}
	
?>