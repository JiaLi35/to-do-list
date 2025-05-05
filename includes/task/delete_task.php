<?php 
// connect to database 
$database = connectToDB();

$task_id = $_POST["task_id"];

    // SQL command (recipe)
    $sql = "DELETE FROM todos WHERE id = :id";
    // prepare
    $query = $database->prepare($sql);
    // execute (cooking)
    $query->execute([
        "id" => $task_id
    ]);

    header("Location: /");
    exit;
