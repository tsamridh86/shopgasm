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
	<nav class="nav-extended orange">
		<div class="nav-wrapper">
			<a href="#" class="brand-logo">Welcome, Administrator</a>
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
				<li class="tab"><a class="active" href="#test1">Add Products</a></li>
				<li class="tab"><a href="#test2">Update Products</a></li>
				<li class="tab"><a href="#test3">Delete Products</a></li>
				<li class="tab"><a href="#test4">Test 4</a></li>
			</ul>
		</div>
	</nav>
	<div id="test1" class="col s12">Test 1</div>
	<div id="test2" class="col s12">Test 2</div>
	<div id="test3" class="col s12">Test 3</div>
	<div id="test4" class="col s12">Test 4</div>
</body>
<script type="text/javascript" src="../js/admin.js"></script>
</html>