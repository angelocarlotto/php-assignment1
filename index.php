<?php


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRUD in PDO PHP | Create/Update</title>
	<meta name="description" content="This week we will be using OOP PHP to create and read with our CRUD application">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/style.css">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php">
					<svg width="64" height="64" fill="currentColor" class="bi bi-controller">
						<use href="sprintes.svg#bi-controller"></use>
					</svg> Task Logger</a>
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
	<section class="masthead">
		<div>
			<h1>Employee portal that tracks hours worked and other employee information</h1>
		</div>
	</section>
	<main class="container">
		<section class="form-row row justify-content-center">

			<?php
			include("add.php");
			?>
			
			<form method="post" class="form-horizontal col-md-6 col-md-offset-3">
				<?php
				if (array_key_exists("task_id", $_GET)) {
				?>
					<input type='hidden' value='<?php echo $_GET['task_id'] ?>' name='task_id' />
				<?php
				}

				?>

				<h2>Create/Update Task</h2>
				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">
						<svg width="16" height="16" fill="currentColor" class="bi bi-card-heading">
							<use href="sprintes.svg#bi-card-heading"></use>
						</svg>
						Task Title</label>
					<div class="col-sm-10">
						<input required type="text" name="title" class="form-control" id="input1" value="<?php echo array_key_exists("title", $_POST) ? $title : ($taskToUpdate != null ? $taskToUpdate["title"] : "") ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="input4" class="col-sm-2 control-label">
						<svg width="16" height="16" fill="currentColor" class="bi bi-person-plus">
							<use href="sprintes.svg#bi-person-plus"></use>
						</svg>

						Creator</label>
					<div class="col-sm-10">
						<select name="employee_id_creation" class="form-select"  >
							<option value="">Who is creating this task:</option>
							<?php foreach ($employees as $row) { ?>
								<option value="<?php echo $row['employee_id'] ?>" <?php echo   array_key_exists("employee_id_creation", $_POST) &&  $row['employee_id'] == $_POST["employee_id_creation"] ? "selected" : ($taskToUpdate != null && $row['employee_id'] == $taskToUpdate["employee_id_creation"] ? "selected" : "") ?>><?php echo $row['full_name'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="input4" class="col-sm-2 control-label">

						<svg width="16" height="16" fill="currentColor" class="bi bi-person-gear">
							<use href="sprintes.svg#bi-person-gear"></use>
						</svg>

						Doer</label>
					<div class="col-sm-10">

						<select name="employee_id_assigned" class="form-select"  required="required">
							<option value="">Assigned this task to:</option>
							<?php foreach ($employees as $row) { ?>
								<option value="<?php echo $row['employee_id'] ?>" <?php echo array_key_exists("employee_id_assigned", $_POST) &&  $row['employee_id'] == $_POST["employee_id_assigned"] ? "selected" : ($taskToUpdate != null && $row['employee_id'] == $taskToUpdate["employee_id_assigned"] ? "selected" : "") ?>><?php echo $row['full_name'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="input2" class="col-sm-4 control-label">


						<svg width="16" height="16" fill="currentColor" class="bi bi-calendar2">
							<use href="sprintes.svg#bi-calendar2"></use>
						</svg>

						Start Date</label>
					<div class="col-sm-10">
						<input required type="datetime-local" name="start_date" class="form-control" id="input2" value="<?php echo array_key_exists("start_date", $_POST) ? $start_date : ($taskToUpdate != null ? $taskToUpdate["start_date"] : "") ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="input3" class="col-sm-4 control-label">

						<svg width="16" height="16" fill="currentColor" class="bi bi-calendar2-check">
							<use href="sprintes.svg#bi-calendar2-check"></use>
						</svg>

						End Date</label>
					<div class="col-sm-10">
						<input required type="datetime-local" name="end_date" class="form-control" id="input3" value="<?php echo  array_key_exists("end_date", $_POST) ? $end_date : ($taskToUpdate != null ? $taskToUpdate["end_date"] : "") ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="input4" class="col-sm-2 control-label">

						<svg width="16" height="16" fill="currentColor" class="bi bi-cup-hot">
							<use href="sprintes.svg#bi-cup-hot"></use>
						</svg>
						Status</label>
					<div class="col-sm-10">
						<select name="task_status_id" class="form-select"  required="required">
							<option value="">Select Task status:</option>
							<?php while ($row = $taskStatus->fetch()) { ?>
								<option value="<?php echo $row['task_status_id']  ?>" <?php echo  array_key_exists("task_status_id", $_POST) &&  $row['task_status_id'] == $_POST["task_status_id"] ? "selected" : ($taskToUpdate != null && $row['task_status_id'] == $taskToUpdate["task_status_id"] ? "selected" : "") ?>><?php echo $row['description'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="input3" class="col-sm-4 control-label">

						<svg width="16" height="16" fill="currentColor" class="bi bi-list-ol">
							<use href="sprintes.svg#bi-list-ol"></use>
						</svg>

						Description</label>
					<div class="col-sm-10">
						<textarea required name="description" class="form-control" id="input4"><?php echo  array_key_exists("description", $_POST) ? $description : ($taskToUpdate != null ? $taskToUpdate["description"] : "") ?></textarea>
					</div>
				</div>
				<?php
				if (array_key_exists("task_id", $_GET)) {
				?>
					<div class="form-group">
						<label for="input3" class="col-sm-2 control-label">
							<svg width="16" height="16" fill="currentColor" class="bi bi-card-checklist">
								<use href="sprintes.svg#bi-card-checklist"></use>
							</svg>
							Solution</label>
						<div class="col-sm-10">
							<textarea required name="solution" class="form-control" id="input4"><?php echo $taskToUpdate != null ? $taskToUpdate["solution"] : "" ?></textarea>
						</div>
					</div>
				<?php
				}

				?>
				<div class="form-group">
					<input type="submit" name="Submit" value="Add" class="btn btn-success col-md-2 col-md-offset-10" value="<?php echo array_key_exists("task_id", $_GET) ? "Update" : "Insert" ?>">
				</div>
			</form>

		</section>
	</main>
	<script type="module" defer>
		let end_date = document.getElementsByName("end_date")[0];
		let start_date = document.getElementsByName("start_date")[0];
		end_date.addEventListener("change", (e) => {

			start_date["max"] = e.target["value"];
		})

		start_date.addEventListener("change", (e) => {

			end_date["min"] = e.target["value"];
		})
	</script>
</body>

</html>