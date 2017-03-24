<?php

require_once 'config/connection.php';
require_once 'config/classes.php';

$user = new Users($conn);

if(isset($_POST['uId']) && isset($_POST['pId']))
{
	$result = $user->addToCart($_POST['uId'],$_POST['pId']);
	if(!$result)
		echo "Sorry something went wrong";
	else
		echo "Product addded to cart successfully";
}
?>