<?php
session_start();
	require_once 'conn.php';
	if(ISSET($_POST['add'])){
		if($_POST['task'] != ""){
			$task = $_POST['task'];
			$id = $_SESSION['user']['id'];
			
			$conn->query("INSERT INTO `task` (task,status,registered_users_id) VALUES('$task', '',$id)");
			header('location:to_do.php');
		}
	}
?>