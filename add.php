    <?php
    include('validate.php');
    require_once("database.php");
    $database = new Database();
    $valid = new validate();

    $employees = $database->getEmployees();
    $taskStatus = $database->getStatus();

    $taskToUpdate = null;
    if (!empty($_POST['Submit'])) {
      // using our escape_string function

      $title = $_POST["title"];
      $employee_id_creation = $_POST["employee_id_creation"];
      $employee_id_assigned = $_POST["employee_id_assigned"];
      $start_date = $_POST["start_date"];
      $end_date = $_POST["end_date"];
      $task_status_id = $_POST["task_status_id"];
      $description = $_POST["description"];

      $msg = $valid->checkEmpty($_POST);

      $check_employee_id_creation = $valid->validOnlyDigits($employee_id_creation);
      $check_employee_id_assigned = $valid->validOnlyDigits($employee_id_assigned);
      $check_start_date = $valid->validateDate($start_date);
      $check_end_date = $valid->validateDate($end_date);
      $check_date_interval = $valid->validateDateInterval($start_date, $end_date);
      $check_task_status_id = $valid->validOnlyDigits($task_status_id);

      // now handle any empty fields
      if ($msg != null) {
        echo $msg;
        //link to the previous page
        //echo "<a href='javascript:self.history.back();'>Go Back</a>";
      } elseif (!$check_employee_id_creation) {
        echo '<p  class="alert alert-warning" role="alert">Please provide a valid check_employee_id_creation.</p>';
        //echo "<a href='javascript:self.history.back();'>Go Back</a>";
      } elseif (!$check_employee_id_assigned) {
        echo '<p  class="alert alert-warning" role="alert">Please provide a valid check_employee_id_assigned.</p>';
        //echo "<a href='javascript:self.history.back();'>Go Back</a>";
      } elseif (!$check_start_date) {
        echo '<p  class="alert alert-warning" role="alert">Please provide a valid check_start_date.</p>';
        //echo "<a href='javascript:self.history.back();'>Go Back</a>";
      } elseif (!$check_end_date) {
        echo '<p  class="alert alert-warning" role="alert">Please provide a valid check_end_date.</p>';
        //echo "<a href='javascript:self.history.back();'>Go Back</a>";
      } elseif (!$check_date_interval) {
        echo '<p  class="alert alert-warning" role="alert">Please provide a valid check_date_interval.' . $check_date_interval . '</p>';
        //echo "<a href='javascript:self.history.back();'>Go Back</a>";
      } elseif (!$check_task_status_id) {
        echo '<p  class="alert alert-warning" role="alert">Please provide a valid check_task_status_id.</p>';
        //echo "<a href='javascript:self.history.back();'>Go Back</a>";
      } else {


        if (array_key_exists("task_id", $_GET)) {
          $task_id = $_POST["task_id"];
          $solution = $_POST["solution"];
          $database->updateTask($task_id, $title, $employee_id_creation, $employee_id_assigned, $start_date, $end_date, $task_status_id, $description, $solution);
          header("HTTP/1.1 301 Moved Permanently");
          header("Location: index.php?task_id=$task_id&updated=1");
          exit();
        } else {

          $successfulAdded=$database->createTask($title, $employee_id_creation, $employee_id_assigned, $start_date, $end_date, $task_status_id, $description);
          header("HTTP/1.1 301 Moved Permanently");
          header("Location: index.php?task_id=$successfulAdded&added=1");
          exit();
        }
      }
    }

    if (array_key_exists("added", $_GET) && $_GET["added"] == "1") {
      echo '<div class="alert alert-success" role="alert">';
      echo 'Record successfully inserted';
      echo '</div>';
    }


    if (array_key_exists("updated", $_GET) && $_GET["updated"] == "1") {
      echo '<div class="alert alert-success" role="alert">';
      echo 'Record successfully updated';
      echo '</div>';
    }

    if (array_key_exists("task_id", $_GET)) {
      $taskToUpdate = $database->getTaskById($_GET["task_id"]);
    }
    ?>