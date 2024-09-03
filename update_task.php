<?php
	require_once 'conn.php';
	
	if($_GET['id'] != ""){
		$task_id = $_GET['id'];
		
		$conn->query("UPDATE `task` SET `status` = 'Выполнено' WHERE `id` = $task_id") or die(mysqli_error($conn));
		header('location: to_do.php');
	}
?>