<?php
session_start();
include_once 'config/classes.php';
include_once 'config/connection.php';

$user = new Users($conn);
if(isset($_GET['userName']))
{
	$userName=$user->checkUserName($_GET['userName']);
	echo $userName;
}
?>