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
		<nav class="navbar  navbar-expand-lg  navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-controller" viewBox="0 0 16 16">
						<path d="M11.5 6.027a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m2.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m-6.5-3h1v1h1v1h-1v1h-1v-1h-1v-1h1z" />
						<path d="M3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .62.39c.655-.079 1.35-.117 2.043-.117.72 0 1.443.041 2.12.126a.5.5 0 0 1 .622-.399l1.932.518a.5.5 0 0 1 .306.729q.211.136.373.297c.408.408.78 1.05 1.095 1.772.32.733.599 1.591.805 2.466s.34 1.78.364 2.606c.024.816-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773-.245-.232-.496-.526-.739-.808-.126-.148-.25-.292-.368-.423-.728-.804-1.597-1.527-3.224-1.527s-2.496.723-3.224 1.527c-.119.131-.242.275-.368.423-.243.282-.494.575-.739.808-.398.38-.877.706-1.513.773a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772a2.3 2.3 0 0 1 .433-.335l-.028-.079zm2.036.412c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a14 14 0 0 0-.748 2.295 12.4 12.4 0 0 0-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 0 0 .426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.504C4.861 9.969 5.978 9.027 8 9.027s3.139.942 3.965 1.855c.164.181.307.348.44.504.214.251.403.472.615.674.318.303.601.468.929.503a.42.42 0 0 0 .426-.241c.18-.408.265-1.02.243-1.776a12.4 12.4 0 0 0-.339-2.406 14 14 0 0 0-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27s-2.063.091-2.913.27" />
					</svg>Task Logger</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">Home</a>
						</li>
						<li class="nav-item"><a class="nav-link active" href="view.php">View</a></li>
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
					<th><svg width="16" height="16" fill="currentColor" class="bi bi-card-heading">
							<use href="sprintes.svg#bi-card-heading"></use>
						</svg>title</th>
					<th><svg width="16" height="16" fill="currentColor" class="bi bi-person-plus">
							<use href="sprintes.svg#bi-person-plus"></use>
						</svg>Creator</th>
					<th><svg width="16" height="16" fill="currentColor" class="bi bi-person-gear">
							<use href="sprintes.svg#bi-person-gear"></use>
						</svg>Doer</th>
					<th>

						<svg width="16" height="16" fill="currentColor" class="bi bi-calendar-event">
							<use href="sprintes.svg#bi-calendar-event"></use>
						</svg>
						Created
					</th>
					<th><svg width="16" height="16" fill="currentColor" class="bi bi-calendar2">
							<use href="sprintes.svg#bi-calendar2"></use>
						</svg>Start</th>
					<th><svg width="16" height="16" fill="currentColor" class="bi bi-calendar2-check">
							<use href="sprintes.svg#bi-calendar2-check"></use>
						</svg>End</th>
					<th><svg width="16" height="16" fill="currentColor" class="bi bi-cup-hot">
							<use href="sprintes.svg#bi-cup-hot"></use>
						</svg>Status</th>
					<th>
						<svg width="16" height="16" fill="currentColor" class="bi bi-list-ol">
							<use href="sprintes.svg#bi-list-ol"></use>
						</svg>

						Description
					</th>
					<th>

						<svg width="16" height="16" fill="currentColor" class="bi bi-card-checklist">
							<use href="sprintes.svg#bi-card-checklist"></use>
						</svg>
						Solution
					</th>
					<th>

						<svg width="16" height="16" fill="currentColor" class="bi  bi-filetype-exe">
							<use href="sprintes.svg#bi-filetype-exe"></use>
						</svg>

						Action
					</th>
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
						<td>
							<div class="btn-group" role="group" aria-label="Basic example">
								<a href="index.php?task_id=<?php echo  $row['task_id']; ?>" class="btn btn-warning edit">

									<svg width="16" height="16" fill="currentColor" class="bi bi-pencil">
										<use href="sprintes.svg#bi-pencil"></use>
									</svg>

									Edit</a>

								<a class="btn btn-danger delete" href="view.php?task_id=<?php echo  $row['task_id']; ?>">
									<svg width="16" height="16" fill="currentColor" class="bi  bi-tras">
										<use href="sprintes.svg#bi-trash"></use>
									</svg>

									Delete</a>
						</td>
		</div>
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
				let res = confirm("Do you confirm delete this item?");
				console.log(res)
				if (res) {
					window.location.href = e.target["href"];

				}
			}
		}
	</script>
</body>

</html>