<!DOCTYPE html>
<html>
<head>
	<!-- links to all the materalize things, no touchy touchy here -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/materialize.min.css">
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!-- The place where the css is  -->
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<title> Welcome to Shopgasm!</title>
</head>
<body>
	<div class="row">
		<div class="col s12 m12">
			<div class="card deep-orange darken-2">
				<div class="card-content black-text">
					<div class="row">
						<div class="col m2">
							<span class="card-title orange-text">Shopgasm</span>
						</div>
						<div class="input-field col s11 m6">
							<input placeholder="Type here" id="query" name = "q" type="text" class="validate">
							<label for="query">Enter your query</label>
						</div>
						<div class="col s1 m1">
							<a class="btn-floating waves-effect waves-light red shiftDown" id="search"><i class="material-icons">search</i></a>
						</div>
						<div class="col s1 m2 align-right white-text">
							<span> <a class="noDecoration" ><i class="material-icons">perm</i>Login </a>| <a class="noDecoration"> Sign Up </a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	<!-- Put this in loop from here to -->
	<div class="col s3 m3">
		<div class="card ">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="images/office.jpg">
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
</html>