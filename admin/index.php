<!DOCTYPE html>
<html>
	<head>
		<!-- links to all the materalize things, no touchy touchy here -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="../css/materialize.min.css">
		<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="../js/materialize.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- The place where the css is  -->
		<link rel="stylesheet" type="text/css" href="../css/admin.css">
		<title>Admin</title>
	</head>
	<body>
		<nav class="nav-extended deep-orange darken-2">
			<div class="nav-wrapper">
				<a href="#" class="brand-logo">Welcome, Admin</a>
				<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="#">View All Orders</a></li>
					<li><a href="#">View All Users</a></li>
					<li><a href="#">Logout</a></li>
				</ul>
				<ul class="side-nav" id="mobile-demo">
					<li><a href="#">View All Orders</a></li>
					<li><a href="#">View All Users</a></li>
					<li><a href="#">Logout</a></li>
				</ul>
			</div>
			<div class="nav-content">
				<ul class="tabs tabs-transparent">
					<li class="tab"><a class="active" href="#add">Add</a></li>
					<li class="tab"><a href="#update">Update </a></li>
					<li class="tab"><a href="#delete">Delete</a></li>
					<li class="tab"><a href="#all">All </a></li>
				</ul>
			</div>
		</nav>
		<!-- adding new product -->
		<div id="add" class="col s12">
			<div class="row">
				<div class="col s12">
					<h4> <p>Add New Product </p></h4>
				</div>
			</div>
			<div class="row">
				<form class="col s12">
					<div class="row">
						<div class="input-field col s12 m6">
							<input id="brand" type="text" class="validate">
							<label for="brand">Brand Name</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="name" type="text" class="validate">
							<label for="name">Product Name</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="price" type="number" class="validate">
							<label for="price">Price</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="quantity" type="number" class="validate">
							<label for="quantity">Quantity Available</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="category" type="text" class="validate">
							<label for="category">Category</label>
						</div>
						<div class="input-field col s12 m6">
							<div class="file-field input-field">
								<div class="btn">
									<span>File</span>
									<input type="file">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Upload a picture">
								</div>
							</div>
						</div>
					</div>
					<button class="btn waves-effect waves-light" type="submit" name="action">Add
					<i class="material-icons right">add</i>
					</button>
				</form>
			</div>
		</div>
		<div id="update" class="col s12">
			<h4> <p>Update Existing Product </p></h4>
			<div class="row">
				<form class="col s12">
					<div class="row">
						<div class="input-field col s12 m6">
							<input id="brand" type="number" class="validate">
							<label for="brand">Product Id to Replace</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="brand" type="text" class="validate">
							<label for="brand">Brand Name</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="name" type="text" class="validate">
							<label for="name">Product Name</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="price" type="number" class="validate">
							<label for="price">Price</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="quantity" type="number" class="validate">
							<label for="quantity">Quantity Available</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="category" type="text" class="validate">
							<label for="category">Category</label>
						</div>
						<div class="input-field col s12 m6">
							<div class="file-field input-field">
								<div class="btn">
									<span>File</span>
									<input type="file">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Upload a picture">
								</div>
							</div>
						</div>
					</div>
					<button class="btn waves-effect waves-light" type="submit" name="action">Update
					<i class="material-icons right">replay</i>
					</button>
				</form>
			</div>
		</div>
		<div id="delete" class="col s12">
			<h4> <p>Delete Existing Product </p></h4>
			<div class="row">
				<form class="col s12">
					<div class="row">
						<div class="input-field col s12 m6">
							<input id="brand" type="number" class="validate">
							<label for="brand">Product Id to Delete</label>
						</div>
					</div>
					<button class="btn waves-effect waves-light" type="submit" name="action">Delete
					<i class="material-icons right">delete</i>
					</button>
				</form>
			</div>
		</div>
		<div id="all" class="col s12">
		<div class="row">
			<!-- Put this in loop -->
			<div class="col s6 m3">
				<div class="card z-depth-2">
					<div class="card-image waves-effect waves-block waves-light">
						<img class="activator" src="../images/office.jpg">
					</div>
					<div class="card-content">
						<span class="card-title activator grey-text text-darken-4">Product Name<i class="material-icons right">more_vert</i></span>
						<p><a href="#">Add to Cart</a></p>
					</div>
					<div class="card-reveal">
						<span class="card-title grey-text text-darken-4">Product Name<i class="material-icons right">close</i></span>
						<p>Id : 1</p>
						<p>Sold By: Brand</p>
						<p>Price : 100</p>
						<p>Quantity Left: 100</p>
						<p>Category: Category</p>
					</div>
				</div>
			</div>
			<!-- till here -->
		</div>	
		</div>
	</body>
	<script type="text/javascript" src="../js/admin.js"></script>
</html>