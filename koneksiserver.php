<?php
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$dbname2 = "db_restaurant2";

	// Create connection
	$connServer = new mysqli($servername2, $username2, $password2, $dbname2);
	// Check connection
	if ($connServer->connect_error) {
	    die("Connection failed: " . $connServer->connect_error);
	}
?>