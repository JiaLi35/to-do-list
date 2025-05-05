<?php 
// connect to database 
$database = connectToDB();

$task_id = $_POST["task_id"];
$task_completed = $_POST["task_completed"];

if ($task_completed === "0") {
    $sql = "UPDATE todos SET completed = 1 WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
        "id" => $task_id
    ]);

    header("Location: /");
    exit;

} else {

    $sql = "UPDATE todos SET completed = 0 WHERE id = :id";

    $query = $database->prepare($sql);

    $query->execute([
    "id" => $task_id
    ]);

    header("Location: /");
    exit;

}
