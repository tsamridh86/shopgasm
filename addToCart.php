<?php

require_once 'config/connection.php';
require_once 'config/classes.php';

$user = new Users($conn);

if(isset($_POST['uId']) && isset($_POST['pId']))
{
	$result = $user->isInCart($_POST['uId'],$_POST['pId']);
	if(!$result)
	{
		$result1 = $user->addToCart($_POST['uId'],$_POST['pId']);
		if(!$result1)
			echo "Sorry something went wrong";
		else
			echo "Product addded to cart successfully";	
	}
	else
	{
		$result1 = $user->removeFromCart($_POST['uId'],$_POST['pId']);
		if(!$result)
			echo "Sorry something went wrong";
		else
			echo "Product removed from cart successfully";
	}
	
}

if(isset($_POST['req']) && $_POST['req'] == 'disp')
{
	$products = $user->getProductsForCart($_POST['uId']);
	if($products != "No items in Cart")
		echo json_encode($products);
	else
		echo "No items in Cart";
}
?>