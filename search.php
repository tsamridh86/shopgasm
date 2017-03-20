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
			<li><a id="brandClick"><i class="fa fa-star fa-2x"></i>Filter by Brand<i id="brandArrow" class="fa fa-sort-down right"></i></a></li>
			<form class="hidden" id="brandCollection">
			<li class="shiftRight"><input type="checkbox" id = "brand1" value="brand1" /><label for="brand1">Brand 1</label></li>
			<li class="shiftRight"><input type="checkbox" id = "brand2" value="brand2" /><label for="brand2">Brand 2</label></li>
			<li class="shiftRight"><input type="checkbox" id = "brand3" value="brand3" /><label for="brand3">Brand 3</label></li>
			<li class="shiftRight"><input type="checkbox" id = "brand4" value="brand4" /><label for="brand4">Brand 4</label></li>
			</form>
			<li><div class="divider"></div></li>
			<li><a id="priceClick"><i class="fa fa-inr fa-2x"></i>Filter by Price<i id="brandArrow" class="fa fa-sort-down right"></i></a></li>
			<li><a class="subheader">Subheader</a></li>
			<li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
		</ul>
	</body>
	<script type="text/javascript" src="js/search.js"></script>
</html>