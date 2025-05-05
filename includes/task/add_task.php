<?php 
// connect to database 
$database = connectToDB();

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

    header("Location: /");
    exit;
}

