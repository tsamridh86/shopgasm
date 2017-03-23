<?php
require '../config/connection.php';
require '../config/classes.php';
session_start();
if(isset($_GET['start']))
{
	echo $_GET['start'];
$admin = new Admin($conn);
$allProducts=$admin->getAllProducts($_GET['start']);
echo $allProducts;		
}
?>