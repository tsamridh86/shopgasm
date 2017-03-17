<?php
require_once 'config/connection.php';
require_once 'config/classes.php';
session_start();
?>
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
		<div class="card deep-orange darken-2">
			<div class="card-content white-text">
				<div class="row">
					<div class="col m2">
						<span class="card-title white-text shiftDown">Shopgasm</span>
					</div>
					<div class="input-field col s11 m6">
						<input placeholder="Type here" id="query" name = "q" type="text" class="validate white-text">
						<label for="query" class="white-text">What are you looking for today?</label>
					</div>
					<div class="col s1 m1">
						<a class="btn-floating waves-effect waves-light blue z-depth-5 btn tooltipped btn-large" data-position="bottom" data-delay="50" data-tooltip="Search" id="search"><i class="material-icons">search</i></a>
					</div>
					<div class="col s6 m1 align-right white-text ">
						<a class="btn-floating btn-large waves-effect waves-light green z-depth-5 btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Account Settings" href="#accountModal"><i class="material-icons">account_circle</i></a>
					</div>
					<div class="col s6 m1 align-right white-text ">
						<a class="btn-floating btn-large waves-effect waves-light amber darken-4 z-depth-5 btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cart" href="#cartModal"><i class="material-icons">shopping_cart</i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- Put this in loop from here to -->
			<div class="col s6 m3">
				<div class="card z-depth-2">
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
		<!-- This is the signup/ login modal -->
		<div id="accountModal" class="modal">
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
						<form method="post" action="">
							<div class="input-field col s12">
								<i class="material-icons prefix">account_circle</i>
								<input id="icon_prefix" type="text" class="validate" name="userName1">
								<label for="icon_prefix">User Name</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input id="icon_prefix" type="password" class="validate" name="password1">
								<label for="icon_prefix">Password</label>
							</div>
							<div class="col s6">
								<button class="btn waves-effect waves-light modal-close" type="submit" name="login">Login
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
						<form action="" method="post">
							<div class="input-field col s6">
								<i class="material-icons prefix">account_circle</i>
								<input id="icon_prefix" type="text" class="validate" name="firstName">
								<label for="icon_prefix">First Name</label>
							</div>
							<div class="input-field col s6">
								<i class="material-icons prefix">account_circle</i>
								<input id="icon_prefix" type="text" class="validate" name="lastName">
								<label for="icon_prefix">Last Name</label>
							</div><!-- 
							<div class="input-field col s12">
								<i class="material-icons prefix">home</i>
								<input id="icon_prefix" type="text" class="validate" name="address">
								<label for="icon_prefix">Address</label>
							</div> -->
							<div class="input-field col s12">
								<i class="material-icons prefix">email</i>
								<input id="icon_prefix" type="email" class="validate" name="email">
								<label for="icon_prefix">Email</label>
							</div>
							<div class="input-field col s6" >
								<i class="material-icons prefix" id="userNameParent">supervisor_account</i>
								<input id="userName" type="text" name="userName" class="validate" onkeyup="getUserName(this.value);" >
								<label for="icon_prefix">New User Name</label>
							</div>
							<div class="input-field col s6">
								<i class="material-icons prefix" id="phoneNumberParent">phone</i>
								<input type="text" class="validate" name="phoneNumber" onkeyup="checkPhoneNumber(this.value);">
								<label for="icon_prefix">Phone Number</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix" id="passwordParent">vpn_key</i>
								<input type="password" class="validate" id="password" name="password">
								<label for="icon_prefix">New Password</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix" id="confirmPasswordParent">replay</i>
								<input id="confirmPassword" type="password" class="validate" onkeyup="checkPassword(this.value);">
								<label for="icon_prefix">Re-type Password</label>
							</div>
							<div class="col s6">
								<button class="btn waves-effect waves-light modal-close" type="submit" name="signUp">Sign Up
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
		</div>
		<div id="cartModal" class="modal">
			<div class="modal-content">
				<p><h4>Your Cart</h4></p>
				<table>
					<thead>
						<tr>
							<th data-field="name">Item Name</th>
							<th data-field="price">Item Price</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Eclair</td>
							<td>$0.87<i class="material-icons right">delete</i></td>
						</tr>
						<tr>
							<td>Jellybean</td>
							<td>$3.76<i class="material-icons right">delete</i></td>
						</tr>
						<tr>
							<td>Lollipop</td>
							<td>$7.00<i class="material-icons right">delete</i></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#!"  id="uploadFile" class=" modal-action modal-close waves-effect waves-green btn-flat">Checkout</a>
				<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/index.js"></script>
</html>
<?php
$user = new Users($conn);
if(isset($_POST['signUp']))
{

$isSignUp=$user->isSignUp($_POST['firstName'],$_POST['lastName'],$_POST['userName'],$_POST['password'],$_POST['phoneNumber']);
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
elseif ($isSignuUp == "Username already exists") {
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
		header('location:index.php');
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
?>