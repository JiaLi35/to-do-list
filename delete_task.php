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

    // SQL command (recipe)
    $sql = "DELETE FROM todos WHERE id = :id";
    // prepare
    $query = $database->prepare($sql);
    // execute (cooking)
    $query->execute([
        "id" => $task_id
    ]);

    header("Location: index.php");
    exit;
