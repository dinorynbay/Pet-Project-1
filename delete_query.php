<?php
	require_once 'conn.php';
	
	if($_GET['id']){
		$task_id = $_GET['id'];
		
		$conn->query("DELETE FROM `task` WHERE `id` = $task_id") or die(mysqli_error($conn));
		header("location: to_do.php");
	}	
?>