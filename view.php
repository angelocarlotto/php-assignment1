<?php
require_once('database.php');
$database = new Database();



if ($_SERVER["REQUEST_METHOD"] == "GET") {

	if (array_key_exists("task_id", $_GET)) {
		$task_id = $_GET["task_id"];
		$res = $database->deleteTask($task_id);

		if ($res) {
			echo "Record successfully deleted";
		}
	}
}

$res = $database->getTask();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRUD in PDO PHP | Read/Edit/Delete</title>
	<meta name="description" content="This week we will be using OOP PHP to create our CRUD application">
	<meta name="robots" content="noindex, nofollow">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/style.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
	<header>
		<nav class="navbar navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php"><img src="./img/php-logo.png" alt="header logo"></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a>
						</li>
						<li class="nav-item"><a class="nav-link" href="view.php">View</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<div class="container">
		<div class="row">
			<table class="table">
				<tr>
					<th>#</th>
					<th>title</th>
					<th>Creator</th>
					<th>Doer</th>
					<th>Created</th>
					<th>Start</th>
					<th>End</th>
					<th>Status</th>
					<th>Description</th>
					<th>Solution</th>
					<th>Action</th>
				</tr>
				<?php while ($row = $res->fetch()) { ?>
					<tr>
						<td><?php echo $row['task_id']; ?></td>
						<td><?php echo $row['title']; ?></td>
						<td><?php echo  $row['creator']; ?></td>
						<td><?php echo  $row['responsable']; ?></td>
						<td><?php echo  $row['creation_date']; ?></td>
						<td><?php echo  $row['start_date']; ?></td>
						<td><?php echo  $row['end_date']; ?></td>
						<td><?php echo  $row['status']; ?></td>
						<td><?php echo  $row['description']; ?></td>
						<td><?php echo  $row['solution']; ?></td>
						<td><a href="index.php?task_id=<?php echo  $row['task_id']; ?>" class="btn edit">Edit</a> <a class="btn delete" href="view.php?task_id=<?php echo  $row['task_id']; ?>">Delete</a></td>

					</tr>
				<?php } ?>
			</table>
		</div>
	</div>


	<script type="module" defer>
		let btn = document.getElementsByClassName("btn");
		for (let i = 0; i < btn.length; i++) {
			btn.item(i).onclick = (e) => {
				e.preventDefault();
				let res=confirm("Do you confirm delete this item?");
				console.log(res)
				if(res){
					window.location.href = e.target["href"];

				}
			}
		}
	</script>
</body>

</html>