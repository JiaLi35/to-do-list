<?php 
// connect to database 
$host = "127.0.0.1";
$database_name = "todolist";
$database_user = "root";
$database_password = "";

$database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
);

$task_id = $_POST["task_id"];
$task_completed = $_POST["task_completed"];

if ($task_completed === "0") {
    $sql = "UPDATE todos SET completed = 1 WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $task_id
    ]);

    header("Location: index.php");
    exit;

} else {

    $sql = "UPDATE todos SET completed = 0 WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
    "id" => $task_id
    ]);

    header("Location: index.php");
    exit;

}
