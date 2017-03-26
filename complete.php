<?php

require_once 'config/connection.php';
require_once 'config/classes.php';

$user = new Users($conn);

if(isset($_POST['uId']) && isset($_POST['address']))
{
	$uId = $_POST['uId'];
	$finalPrice = $_POST['finalPrice'];
	$pIdString = $_POST['pIdString'];
	$quantityString = $_POST['quantityString'];
	$address = $_POST['address'];

	$result = $user->placeOrder($uId, $finalPrice,$pIdString,$quantityString,$address);
	if(!$result)
	{
		"<script type = 'text/javascript'>alert(Some Problem);</script>";
		echo "<p><a href = 'index.php'>(Click here to go to home)</a></p>";

	}	
	else
	{
		$productIds = json_decode($pIdString);
		$quantities = json_decode($quantityString);

		$i = 0;
		while($i < count($productIds))
		{
			$result = $user->decrementQuantity($productIds[$i],$quantities[$i]);
			$i = $i + 1;
		}

		if(!$result)
			echo "<script type = 'text/javascript'>alert(Some Problem);</script>";
		else
		{
			$result = $user->deleteCart($uId);
			if(!$result)
				echo "<script type = 'text/javascript'>alert(Some Problem);</script>";
			else
				echo "<p>Order Placed succcesfully</p>";
				echo "<p><a href = 'index.php'>(Click here to go to home)</a></p>";
		}
	}
}
?>