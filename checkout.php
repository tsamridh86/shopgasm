<?php
require_once 'config/connection.php';
require_once 'config/classes.php';
session_start();

$user = new Users($conn);

if(!isset($_SESSION['userName']))
{
	header("location: index.php");
}
else
{
		$row = $user->getUserByUserName($_SESSION['userName']);
		echo '<p id = "uId" class = "hidden">'.$row['userId'].'</p>';
		$products = $user->getProductsForCart($row['userId']);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- links to all the materalize things, no touchy touchy here -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="css/materialize.min.css">
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- The place where the css is  -->
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<title>Checkout</title>
	</head>
	<body>
		<nav class="nav-extended deep-orange darken-2">
			<div class="nav-wrapper">
				<a href="#" class="brand-logo">Your Orders,</a>
				<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="index.php">Add Products</a></li>
					<li><a href="index.php">Cancel</a></li>
					<li><a href="checkout.php?logout">Logout</a></li>
				</ul>
				<ul class="side-nav" id="mobile-demo">
					<li><a href="index.php">Add Products</a></li>
					<li><a href="index.php">Cancel</a></li>
					<li><a href="checkout.php?logout">Logout</a></li>
				</ul>
			</div>
		</nav>
		<div class="row">
			<div class="col s12 m12">
				<table>
					<thead>
						<tr>
							<th>Name</th>
							<th>Quantity</th>
							<th>Unit Price</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 0;
					while($i < count($products))
					{
						echo '<p class = "idHolder hidden">'.$products[$i]['pId'].'</p>';
						echo '<tr>';
						echo  '<td>'.$products[$i]['pName'].'</td>';
						if($products[$i]['quantity'] >= 10)
						echo  '<td><input type="number" value = "1" class="validate quantity col s6 m2" min="1" max="10"/></td>';
					else
						echo  '<td><input type="number" value = "1" class="validate quantity col s6 m2" min="1" max="'.$products[$i]['quantity'].'"/></td>';
						echo '<td class="unitPrice">'.$products[$i]['pPrice'].'</td>';
						echo '<td class="price"></td>';
						echo '</tr>';
						$i = $i + 1;
					}
					?>						
						<tr>
							<th></th>
							<td></td>
							<th>Total = </th>
							<td id="totalPrice"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<form id = "order" method="post" action="complete.php">
			<input id="uId" name = "uId" type="hidden" value = <?php echo $row['userId'];?>>
			<input id="finalPrice" name = "finalPrice" type="hidden">
			<input id="pIdString" name = "pIdString" type="hidden">
			<input id="quantityString" name = "quantityString"
			type="hidden">
			<div class="input-field col s7 m6" >
				<textarea id="address" name="address" class="materialize-textarea" required></textarea>
				<label for="address">Address</label>
			</div>
			<div class="col s4 m2 right">
				<a id = "orderForm" class="btn-large">Order</a>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/checkout.js"></script>
</html>
<?php
	if(isset($_GET['logout']))
	$user->logout();
?>