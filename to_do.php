<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="to_do_folder/bootstrap.css"/>
    <link rel="stylesheet" href="css/to_do_styles.css">
</head>
<body>
<?php require_once 'layout/to_do_header.php' ?>

<div class="do">
		    <center>
				<form method="POST" class="form-inline" action="add_query.php" >
					<input type="text" class="form-control" name="task" required placeholder="Напишите задачу"/>
					<button class="btn btn-primary form-control" name="add">Добавить</button>
				</form>
			</center>
            <br /><br /><br />
		<table class="table">
			<thead>
				<tr>
					<th>Номер</th>
					<th>Задача</th>
					<th>Состояние</th>
					<th>Действие</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require 'conn.php';
                    $id = $_SESSION['user']['id'];
					$query = $conn->query("SELECT * FROM `task` WHERE registered_users_id = $id ORDER BY `id` DESC");
					$count = 1;
					while($fetch = $query->fetch_array()){
				?>
				<tr>
					<td><?php echo $count++?></td>
					<td><?php echo $fetch['task']?></td>
					<td><?php echo $fetch['status']?></td>
					<td colspan="2">
						<center>
							<?php
								if($fetch['status'] != "Выполнено"){
									echo 
									'<a href="update_task.php?id='.$fetch['id'].'" class="btn btn-success">Выполнено</a> | ';
								}
							?>
<a href="delete_query.php?id=<?php echo $fetch['id']?>" class="btn btn-danger">Удалить</a>
						</center>
					</td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
        </div>
</body>
</html>