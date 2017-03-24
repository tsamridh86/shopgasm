<?php
		require 'config/connection.php';
			require 'config/classes.php';
			$user = new Users($conn);
			$allBrands = $user->getAllBrands();
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
		<?php 
		$i = 0;
		while( $i < count($allBrands))
		{
			echo "<li class='shiftRight'><input type='checkbox' id = '".$allBrands[$i]."' value='".$allBrands[$i]."' /><label for='".$allBrands[$i]."'>".$allBrands[$i]."</label></li>";
			$i=$i+1;
		}
		?>
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
	<!-- Put this in loop from here to -->
		<div class="col s6 m3">
			<div class="card z-depth-2">
				<div class="card-image waves-effect waves-block waves-light">
					<img class="activator" src="images/va_so.jpg">
				</div>
				<div class="card-content">
					<span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
					<p><a href="#">This is a link</a></p>
				</div>
				<div class="card-reveal">
					<span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
					<p>Here is some more information about this product that is only revealed once clicked on.</p>
				</div>
			</div>
		</div>
		<!-- till here -->
	</div>
</body>
<script type="text/javascript" src="js/search.js"></script>
</html>