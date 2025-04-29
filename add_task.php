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

$task_name = $_POST["task_name"];

if (empty($task_name)){
    echo "Please write your task";
} else {
    // SQL command (recipe)
    $sql = "INSERT INTO todos (`label`) VALUES (:name)";
    // prepare
    $query = $database->prepare($sql);
    // execute (cooking)
    $query->execute([
        "name"=>$task_name
    ]);

    header("Location: index.php");
    exit;
}

