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

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

if ( empty($name) || empty($email) || empty($password) || empty($confirm_password) ) {
    echo "Please fill up all the fields";
} else if ($password !== $confirm_password) {
    echo "Your password does not match";
} else {
    $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)";

    $query = $database->prepare($sql);

    $query->execute([
        "name" => $name,
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ]);

    header("Location: login.php");
    exit;
}

