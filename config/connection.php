<?php
$conn=new mysqli("localhost","root","","shopgasm");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else{
	// echo "Connected";
}	
?>