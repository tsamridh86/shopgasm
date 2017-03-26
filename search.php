<?php
require 'config/connection.php';
require 'config/classes.php';
session_start();
$user=new Users($conn);
$start=1;
$limit=5;
$limitSuggest=5;
$isFilter=0;
if(isset($_GET['suggest']))
{
	$suggestedProducts=$user->suggestProducts($_GET['suggest'],$limitSuggest);
	echo $suggestedProducts;
	exit();
}
$totalProducts=$user->countSearchProducts($_GET['q']);
$query=$_GET['q'];
if(isset($_SESSION['userName']))
{
	$row = $user->getUserByUserName($_SESSION['userName']);
}
			$allBrands = $user->getAllBrands();
			$allCategory = $user->getAllCategory();

if(isset($_GET['q']))
{
	if(isset($_GET['brand']))
	{
		$brand=$_GET['brand'];
		$isFilter=1;
	}
	else{
		$brand=-1;
	}
	if(isset($_GET['price']))
	{
		$isFilter=1;
		$price=$_GET['price'];
	}
	else{
		$price=-1;
	}
	if(isset($_GET['category']))
	{
		$isFilter=1;
		$category=$_GET['category'];
	}
	else{
		$category=-1;
	}
	
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
		
		<title>Search Product</title>
	</head>
	<body>
		<div class="card deep-orange darken-2 moveUp">
			<div class="card-content white-text">
				<div class="row">
					<div class="col s12 m2">
					<a href="index.php">
						<span class="card-title white-text shiftDown">Shopgasm</span>
						</a>
					</div>
					<div class="input-field col s10 m6">
						<input placeholder="Type here" id="query" name = "q" type="text" onkeyup="getProducts(this.value);" class="validate white-text autocomplete">
						<label for="query" class="white-text">What are you looking for today?</label>
         			 <div id="searchResults" class = "deep-orange lighten-3" ></div>

					</div>
					<div class="col s1 m1">
						<a class="btn-floating waves-effect waves-light blue z-depth-5 btn tooltipped btn-large" data-position="bottom" data-delay="50" data-tooltip="Search" id="search" onclick="searchProducts();"><i class="material-icons">search</i></a>
					</div>
					<div class="col s4 m1 align-right white-text ">
						<a class="btn-floating btn-large waves-effect waves-light green z-depth-5 btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Account Settings" href="#accountModal"><i class="material-icons">account_circle</i></a>
					</div>
					<div class="col s4 m1 align-right white-text ">
						<a id = "cart" class="btn-floating btn-large waves-effect waves-light amber darken-4 z-depth-5 btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cart" href="#cartModal"><i class="material-icons">shopping_cart</i></a>
					</div>
					<div class="col s4 m1 align-right white-text ">
						<a class="btn-floating button-collapse btn-large waves-effect waves-light purple darken-3 z-depth-5 btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Options" data-activates="slide-out" ><i class="fa fa-filter" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
		</div>	
			<!-- This is the signup/ login modal -->
			<div id="accountModal" class="modal">
				<?php
					if(!isset($_SESSION['userName']))
					{
				?>
				<div class="modal-content">
					<div class="row">
						<div class="col s12">
							<ul class="tabs">
								<li class="tab col s6"><a id="init" href="#login">login</a></li>
								<li class="tab col s6"><a href="#signup">sign up</a></li>
							</ul>
						</div>
						<div id="login" class="col s12">
							<p><h4>Log In</h4></p>
							<form method="post" action="" >
								<div class="input-field col s12">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" class="validate" name="userName1" required>
									<label for="icon_prefix">User Name</label>
								</div>
								<div class="input-field col s12">
									<i class="material-icons prefix">vpn_key</i>
									<input id="icon_prefix" type="password" class="validate" name="password1" required>
									<label for="icon_prefix">Password</label>
								</div>
								<div class="col s6">
									<button class="btn waves-effect waves-light" type="submit" name="login">Login
									<i class="material-icons right">input</i>
									</button>
								</div>
								<div class="col s6 align-right">
									<button class="btn waves-effect waves-light modal-close" >Cancel
									<i class="material-icons right">not_interested</i>
									</button>
								</div>
							</form>
						</div>
						<div id="signup" class="col s12">
							<p><h4>Sign Up</h4></p>
							<form action="" method="post" onsubmit="return validateForm();">
								<div class="input-field col s12 m6">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" class="validate" name="firstName" required>
									<label for="icon_prefix">First Name</label>
								</div>
								<div class="input-field col s12 m6">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" class="validate" name="lastName" required>
									<label for="icon_prefix">Last Name</label>
								</div><!--
								<div class="input-field col s12">
										<i class="material-icons prefix">home</i>
										<input id="icon_prefix" type="text" class="validate" name="address">
										<label for="icon_prefix">Address</label>
								</div> -->
								<div class="input-field col s12">
									<i class="material-icons prefix">email</i>
									<input id="icon_prefix" type="email" class="validate" name="email" required>
									<label for="icon_prefix">Email</label>
								</div>
								<div class="input-field col s12 m6" >
									<i class="material-icons prefix" id="userNameParent">supervisor_account</i>
									<input id="userName" type="text" name="userName" class="validate" onkeyup="getUserName(this.value);" required="">
									<label for="icon_prefix">New User Name</label>
								</div>
								<div class="input-field col s12 m6">
									<i class="material-icons prefix" id="phoneNumberParent">phone</i>
									<input type="text" class="validate" name="phoneNumber" id="phoneNumber" onkeyup="checkPhoneNumber(this.value);">
								</div>
								<div class="input-field col s12">
									<i class="material-icons prefix" id="passwordParent">vpn_key</i>
									<input type="password" class="validate" id="password" name="password" required="">
									<label for="icon_prefix">New Password</label>
								</div>
								<div class="input-field col s12">
									<i class="material-icons prefix" id="confirmPasswordParent">replay</i>
									<input id="confirmPassword" type="password" class="validate" onkeyup="checkPassword(this.value);">
									<label for="icon_prefix">Re-type Password</label>
								</div>
								<div class="col s6">
									<button class="btn waves-effect waves-light" type="submit" name="signUp" >Sign Up
									<i class="material-icons right">call_made</i>
									</button>
								</div>
								<div class="col s6 align-right">
									<button class="btn waves-effect waves-light modal-close" >Cancel
									<i class="material-icons right">not_interested</i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php
					}
					else
					{
					echo "<div class = 'modal-content'>";
						echo "<p>Hi ".$row['firstName']."</p>";
						echo "<p><h5>Your Orders</h5></p>";
			$allOrders = $user->getOrders($row['userId']);
			if($allOrders=="No orders")
				echo "<p>You have not ordered anything yet.</p>";
			else
			{
				$i = 0;
						while($i < count($allOrders))
						{
							echo "<p> Order Reference Number : ".$allOrders[$i]['orderId']."<p>";
							echo "<table>";
								echo "<thead>";
									echo "<tr>";
										echo "<th>Product Name</th>";
										echo "<th>Quantity</th>";
										echo "<th>Unit Price</th>";
										echo "<th>Total Price</th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								$productIdList = json_decode($allOrders[$i]['product']);
								$quantityList = json_decode($allOrders[$i]['quantity']);
								$j = 0;
								while ($j < count($productIdList)) 
								{
									$pList = $user->getProductByPId((int)$productIdList[$j]);
									echo "<tr>";
										echo  '<td>'.$pList['name'].'</td>';
										echo  '<td class = "quantity">'.$quantityList[$j].'</td>';
										echo  '<td class = "unitPrice">'.$pList['price'].'</td>';
										echo  '<td class = "price"></td>';
									echo "</tr>";
			
									$j = $j + 1;
								}
								echo '<tr>
										<th></th>
										<td></td>
										<th>Total = </th>
										<td>'.$allOrders[$i]['total'].'</td>
									</tr>';
								echo "</tbody>";
							echo "</table>";
			
							$i = $i + 1;
						}
					}
					echo "</div>";
					echo "<div class = 'modal-footer'>";
							echo "<a href='index.php?logout' class=' modal-action modal-close waves-effect waves-green btn-flat right'>Logout</a>";
							echo "<a class = 'modal-action modal-close waves-effect waves-green btn-flat right'>Close</a>";
					echo "</div>";
						}
				echo "</div>";
			echo "<!-- This is the cart modal -->";
			if(isset($_SESSION["userName"]))
			{
			echo '<p id = "uId" class = "hidden">'.$row['userId'].'</p>';
			echo '<div id="cartModal" class="modal">
				<div class="modal-content">
					<p><h4>Your Cart</h4></p>
					<p id = "noItem"></p>
					<table id = "cartStart" >
						<thead>
							<tr>
								<th data-field="name">Item Name</th>
								<th data-field="price">Item Price</th>
							</tr>
						</thead>
						<tbody id = "cartTable">
					
						</tbody>
					</table>
				</div>
				<div id = "cartEnd" class="modal-footer">
					<a  href = "checkout.php" id="uploadFile" class=" modal-action modal-close waves-effect waves-green btn-flat">Checkout</a>
					<a class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
				</div>
			</div>';
			}
			else
			{
			echo '<div id = "cartModal" class = "modal">
				<div class = "modal-content">
					<p>Please Login.</p>
				</div>
				<div id = "modal-footer">
					<a class=" modal-action modal-close waves-effect waves-green btn-flat right">Close</a>
				</div>
			</div>';
			}
			?>
			</div>
			<!-- End of all modals -->
			<ul id="slide-out" class="side-nav">
				<li onclick="getAllFilters();"><a><i class="fa fa-search fa-3x" aria-hidden="true" ></i>Filter Products</a></li>
				<li><div class="divider"></div></li>
				<li><a id="brandClick" class="waves-effect"><i class="fa fa-star fa-2x"></i>Filter by Brand<i id="brandArrow" class="fa fa-sort-down right"></i></a></li>
				<form>
				<div class="hidden" id="brandCollection">
					<?php
					$i = 0;
					while( $i < count($allBrands))
					{
						echo "<li class='shiftRight'><input type='checkbox' onclick='searchBrands(\"".$allBrands[$i]."\");' id = '".$allBrands[$i]."' value='".$allBrands[$i]."' /><label for='".$allBrands[$i]."'>".$allBrands[$i]."</label></li>";
						$i=$i+1;
					}
					?>
				</div>
				<li><div class="divider"></div></li>
				<li><a id="priceClick" class="waves-effect"><i class="fa fa-inr fa-2x"></i>Filter by Price<i id="priceArrow" class="fa fa-sort-down right"></i></a></li>
				<div class="hidden" id="priceCollection">
					<?php
					$i = $user->getCheapestProduct();
					$max = $user->getExpensiveProduct();
					$priceGradient = $user->getGradient();
					while( $i < $max )
					{
						if($i + $priceGradient < $max)
						echo "<li class='shiftRight'><input type='checkbox' onclick='searchPrice(\"".ceil($i)."\");' id = '".ceil($i)."' value='".ceil($i)."' /><label for='".ceil($i)."'>".ceil($i)." - ".ceil($i+$priceGradient)."</label></li>";
						else
						echo "<li class='shiftRight'><input type='checkbox' onclick='searchPrice(\"".ceil($i)."\");' id = '".ceil($i)."' value='".ceil($i)."' /><label for='".ceil($i)."'>".ceil($i)." - ".ceil($max)."</label></li>";
						$i=$i+$priceGradient;
					}
					?>
				</div>
				<li><div class="divider"></div></li>
				<li><a id="categoryClick" class="waves-effect"><i class="material-icons">view_week</i>Filter by Category<i id="categoryArrow" class="fa fa-sort-down right"></i></a></li>
				<div class="hidden" id="categoryCollection">
					<?php
					$i = 0;
					while( $i < count($allCategory))
					{
						echo "<li class='shiftRight'><input type='checkbox' onclick='searchCategory(\"".$allCategory[$i]."\");' id = '".$allCategory[$i]."' value='".$allCategory[$i]."' /><label for='".$allCategory[$i]."'>".$allCategory[$i]."</label></li>";
						$i=$i+1;
					}
					?>
				</div>
				</form>
			</ul>
			<div class="row">
				<div class="col s12">
					<span class="right"><h5>
						<!-- Put this in loop from here to -->
						<?php
						if($isFilter == 0)
						{
						if(!isset($_GET['start']))
							{
								$startPage=1;
							}
							else{
								$startPage=$_GET['start'];
								$start=$startPage;
								
							}
						if($startPage != 1) {?>
						<a href="search.php?q=<?php echo $query?>&start=<?php echo $_GET['start']-$limit;?>""><i id="previous" class="fa fa-chevron-left fa-2x"  ></a></i><?php }
						$temp=$startPage+$limit-1;
						if($temp >$totalProducts)
						$temp=$totalProducts;
						echo $startPage;
						echo "-".$temp;
						echo " of ".$totalProducts;
						if((($startPage)+$limit) <=$totalProducts) {?>
						<a href="search.php?q=<?php echo $query?>&start=<?php echo $start+$limit;?>"><i id="next" class="fa fa-chevron-right fa-2x" ></i></a><?php
					}}?></h5></span>
				</div>
				<?php
				$allProducts=array();
				// $startPage=$_GET['start'];
				if($isFilter == 0)
				{
					$allProducts=$user->searchProducts($_GET['q'],$startPage,$limit);
				}
				else{
				$allProducts=$user->filterSearchProducts($_GET['q'],$brand,$category,$price);

				}
				// $allProducts=json_decode($allProducts);
				// echo $allProducts[0]["productId"];
				$i=0;
				while($i < (count($allProducts))){
							echo '<div class="col s12 m3">'.
								'<div class="card z-depth-2">'.
										'<div class="card-image waves-effect waves-block waves-light">'.
												'<img height="300" class="activator" src="images/'.$allProducts[$i]['image'].'">'.
										'</div>'.
										'<div class="card-content" id = "'.$allProducts[$i]['productId'].'">'.
												'<span class="card-title activator grey-text text-darken-4">'.$allProducts[$i]['name'].'<i class="material-icons right">more_vert</i></span>';
												if(isset($_SESSION['userName']))
												{
													$check = $user->isInCart($row['userId'],$allProducts[$i]['productId']);
													if(!$check)
														echo '<p><a id = "addToCart" onClick = "addToCart(this)">Add to cart</a></p>';
													else
														echo '<p><a id = "addToCart" onClick = "addToCart(this)">Remove from cart</a></p>';
												}
								   echo '</div>'.
										'<div class="card-reveal">'.
												'<span class="card-title grey-text text-darken-4">'.$allProducts[$i]['name'].'<i class="material-icons right">close</i></span>'.
												'<p>Id : '.$allProducts[$i]['productId'].'</p>'.
												'<p>Sold By: '.$allProducts[$i]['brand'].'</p>'.
												'<p>Price : '.$allProducts[$i]['price'].'</p>'.
												'<p>Quantity Left: '.$allProducts[$i]['quantity'].'</p>'.
												'<p>Category: '.$allProducts[$i]['category'].'</p>'.
										'</div>'.
								'</div>'.
						'</div>';
						$i=$i+1;
						}
				?>
				
				<!-- till here -->
				
			</div>
		</body>
		<script type="text/javascript" src="js/search.js"></script>
		<script type="text/javascript" src="js/index.js"></script>

	</html>
	<?php
	if(isset($_POST['signUp']))
	{
	$isSignUp=$user->isSignUp($_POST['firstName'],$_POST['lastName'],$_POST['userName'],$_POST['password'],$_POST['phoneNumber'],$_POST['email']);
	if($isSignUp === true)
	{
		// echo $isSignUp;
	echo '<script type="text/javascript">
					$(document).ready(function(){
					$("#modal1").modal("open");
						});
	</script>
	<div id="modal1" class="modal">
		<div class="modal-content">
			<h4>Successfully Signed Up</h4>
		</div>
		<div class="modal-footer">
			<a href="index.php" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
		</div>
	</div>';
	}
	elseif ($isSignUp == "Username already exists") {
	echo '
	<script type="text/javascript">
					$(document).ready(function(){
					$("#modal1").modal("open");
						});
	</script>
	<div id="modal1" class="modal">
		<div class="modal-content">
			<h4>Username already Exists</h4>
		</div>
		<div class="modal-footer">
			<a href="index.php" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
		</div>
	</div>';
	// echo $isSignUp;
	}
	else{
	// echo $isSignUp;
	echo '
	<script type="text/javascript">
					$(document).ready(function(){
					$("#modal1").modal("open");
						});
	</script><div id="modal1" class="modal">
		<div class="modal-content">
			<h4>Sorry Something went</h4>
		</div>
		<div class="modal-footer">
			<a href="index.php" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
		</div>
	</div>';
	}
	}
	if(isset($_POST['login']))
	{
	$userName1=$_POST["userName1"];
	$password1=$_POST["password1"];
	$isLogin = $user->isLogin($userName1,$password1);
	if($isLogin === true)
	{
	$_SESSION['userName'] = $userName1;
	header('location:search.php');
	}
	else{
	echo '<script type="text/javascript">
				$(document).ready(function(){
				$("#modal1").modal("open");
					});
	</script>
	<div id="modal1" class="modal">
		<div class="modal-content">
			<h4>Wrong Credentials</h4>
		</div>
		<div class="modal-footer">
			<a href="index.php" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
		</div>
	</div>';
	}
	}
if(isset($_GET['logout']))
$user->logout();


?>