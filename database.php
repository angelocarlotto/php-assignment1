
<?php
class Database
{

    private $connection;
    private $password = "";
    private $username = "root";

    private $dsn = "mysql:host=localhost;dbname=worklogdb";

    function __construct()
    {
        $this->connect_db();
    }
    public function connect_db()
    {
        $this->connection = new PDO($this->dsn, $this->username, $this->password);
    }

    public function createTask($title,$employee_id_creation, $employee_id_assigned, $start_date, $end_date,$task_status_id,$description)
    {
        $sql = "INSERT into tasks(title,employee_id_creation,employee_id_assigned,start_date, end_date,task_status_id, description) values('$title',$employee_id_creation,$employee_id_assigned,'$start_date','$end_date',$task_status_id,'$description')";
        if ($this->connection->exec($sql)) {
            $id = $this->connection->lastInsertId();
            return $id;
        }
        return -1;
    }

    public function updateTask($task_id,$title,$employee_id_creation, $employee_id_assigned, $start_date, $end_date,$task_status_id,$description,$solution)
    {
        $sql = "update tasks set 
        title='$title',
         employee_id_creation=$employee_id_creation,
         employee_id_assigned=$employee_id_assigned,
         start_date='$start_date', 
         end_date='$end_date',
         task_status_id=$task_status_id, 
         description='$description', 
         solution='$solution'
        where task_id=$task_id ";

        if ($this->connection->exec($sql)) {
            return $task_id;
        }
        return -1;
    }


    public function deleteTask($task_id)
    {
        $sql = "delete from tasks where task_id=$task_id ";
        if ($this->connection->exec($sql)) {
            return true;
        }
        return false;
    }

    public function getTask()
    {
        $sql = "select a.*,b.full_name creator,c.full_name responsable,d.description status from tasks a inner join employees b on b.employee_id=a.employee_id_creation inner join employees c on c.employee_id=a.employee_id_assigned inner join task_status d on d.task_status_id=a.task_status_id";
        $stmt = $this->connection->query( $sql);
        return $stmt;
    }

    public function getTaskById($taskID)
    {
        $stmt = $this->connection->prepare("SELECT * FROM tasks WHERE task_id=?");
        $stmt->execute([$taskID]); 
        $taks = $stmt->fetch();
        return $taks;
    }

    public function getEmployees()
    {
        $sql = "select * from employees";
        $stmt = $this->connection->query( $sql)->fetchAll();
        return $stmt;
    }

    public function getStatus()
    {
        $sql = "select * from task_status";
        $stmt = $this->connection->query( $sql);
        return $stmt;
    }

}


?>