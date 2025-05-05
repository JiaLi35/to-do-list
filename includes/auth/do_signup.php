<?php
// connect to database 
$database = connectToDB();

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

if ( empty($name) || empty($email) || empty($password) || empty($confirm_password) ) {
    echo "Please fill up all the fields";
} else if ($password !== $confirm_password) {
    echo "Your password does not match";
} else {
    // check and make sure the email provided does not already exist
    // get the user data by email
    // sql command
    $sql = "SELECT * FROM users WHERE email = :email";

    // prepare
    $query = $database->prepare($sql);

    // execute
    $query->execute([
        "email" => $email
    ]);

    // fetching data 
    $user = $query->fetch();

    if ($user){
        echo"The email provided already exists in our system.";
    } else {
        $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)";

        $query = $database->prepare($sql);

        $query->execute([
            "name" => $name,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ]);

        header("Location: /login");
        exit;
    }
}

