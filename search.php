<?php
require 'config/connection.php';
require 'config/classes.php';
session_start();
$user=new Users($conn);
$start=1;
$limit=5;
$limitSuggest=5;
if(isset($_GET['suggest']))
{
	$suggestedProducts=$user->suggestProducts($_GET['suggest'],$limitSuggest);
	echo $suggestedProducts;
	exit();
}
$totalProducts=$user->countSearchProducts($_GET['q']);
$query=$_GET['q'];

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
						<span class="card-title white-text shiftDown">Shopgasm</span>
					</div>
					<div class="input-field col s10 m6">
						<input placeholder="Type here" id="query" name = "q" type="text" class="validate white-text">
						<label for="query" class="white-text">What are you looking for today?</label>
					</div>
					<div class="col s1 m1">
						<a class="btn-floating waves-effect waves-light blue z-depth-5 btn tooltipped btn-large" data-position="bottom" data-delay="50" data-tooltip="Search" id="search"><i class="material-icons">search</i></a>
					</div>
					<div class="col s4 m1 align-right white-text ">
						<a class="btn-floating btn-large waves-effect waves-light green z-depth-5 btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Account Settings" href="#accountModal"><i class="material-icons">account_circle</i></a>
					</div>
					<div class="col s4 m1 align-right white-text ">
						<a class="btn-floating btn-large waves-effect waves-light amber darken-4 z-depth-5 btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cart" href="#cartModal"><i class="material-icons">shopping_cart</i></a>
					</div>
					<div class="col s4 m1 align-right white-text ">
						<a class="btn-floating button-collapse btn-large waves-effect waves-light purple darken-3 z-depth-5 btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Options" data-activates="slide-out" ><i class="fa fa-filter" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
		</div>
		<ul id="slide-out" class="side-nav">
			<li><a><i class="fa fa-filter fa-3x" aria-hidden="true"></i>Filter Products</a></li>
			<li><div class="divider"></div></li>
			<li><a id="brandClick" class="waves-effect"><i class="fa fa-star fa-2x"></i>Filter by Brand<i id="brandArrow" class="fa fa-sort-down right"></i></a></li>
			<form class="hidden" id="brandCollection">
			<li class="shiftRight"><input type="checkbox" id = "brand1" value="brand1" /><label for="brand1">Brand 1</label></li>
			<li class="shiftRight"><input type="checkbox" id = "brand2" value="brand2" /><label for="brand2">Brand 2</label></li>
			<li class="shiftRight"><input type="checkbox" id = "brand3" value="brand3" /><label for="brand3">Brand 3</label></li>
			<li class="shiftRight"><input type="checkbox" id = "brand4" value="brand4" /><label for="brand4">Brand 4</label></li>
			</form>
			<li><div class="divider"></div></li>
			<li><a id="priceClick" class="waves-effect"><i class="fa fa-inr fa-2x"></i>Filter by Price<i id="priceArrow" class="fa fa-sort-down right"></i></a></li>
			<form class="hidden" id="priceCollection">
			<li class="shiftRight"><input type="checkbox" id = "range1" value="range1" /><label for="range1">0 - 1000</label></li>
			<li class="shiftRight"><input type="checkbox" id = "range2" value="range2" /><label for="range2">1001 - 2000</label></li>
			<li class="shiftRight"><input type="checkbox" id = "range3" value="range3" /><label for="range3">2001 - 3000</label></li>
			<li class="shiftRight"><input type="checkbox" id = "range4" value="range4" /><label for="range4">3001 - 4000</label></li>
			</form>
			<li><div class="divider"></div></li>
			<li><a id="categoryClick" class="waves-effect"><i class="material-icons">view_week</i>Filter by Category<i id="categoryArrow" class="fa fa-sort-down right"></i></a></li>
			<form class="hidden" id="categoryCollection">
			<li class="shiftRight"><input type="checkbox" id = "category1" value="category1" /><label for="category1">Category 1</label></li>
			<li class="shiftRight"><input type="checkbox" id = "category2" value="category2" /><label for="category2">Category 2</label></li>
			<li class="shiftRight"><input type="checkbox" id = "category3" value="category3" /><label for="category3">Category 3</label></li>
			<li class="shiftRight"><input type="checkbox" id = "category4" value="category4" /><label for="category4">Category 4</label></li>
			</form>
		</ul>

		<div class="row">
		<div class="col s12">
		<span class="right"><h5>
		<!-- Put this in loop from here to -->
		<?php
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
			}?></h5></span>
		</div>
			<?php
			$allProducts=array();
			// $startPage=$_GET['start'];
			$allProducts=$user->searchProducts($_GET['q'],$startPage,$limit);
			// $allProducts=json_decode($allProducts);
			echo $allProducts[0]["productId"];
			$i=0;
			while($i < (count($allProducts))){
						echo '<div class="col s12 m3">'.
						'<div class="card z-depth-2">'.
							'<div class="card-image waves-effect waves-block waves-light">'.
								'<img height="300" class="activator" src="images/'.$allProducts[$i]['image'].'">'.
							'</div>'.
							'<div class="card-content">'.
								'<span class="card-title activator grey-text text-darken-4">'.$allProducts[$i]['name'].'<i class="material-icons right">more_vert</i></span>'.
							'</div>'.
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
</html>