<?php
	$conn = new mysqli("localhost", "root", "", "diploma");
	
	if(!$conn){
		die("Error: Cannot connect to the database");
	}
?>