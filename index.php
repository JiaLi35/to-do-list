<?php
    // put backend code before rendering html elements
    session_start();

    // Connect to database
    // 1. database info 

    $host = "127.0.0.1";
    $database_name = "todolist";
    $database_user = "root";
    $database_password = "";

    // 2. connect PHP with the MySQL database
    // PDO (PHP Database Object)
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user,
        $database_password
    );

    // var_dump($database);

    // 3. get the students data from the database
    // 3.1 - SQL command (recipe) *the only thing that will change (the rest will stay the same)
    $sql = "SELECT * FROM todos";
    // 3.2 - prepare SQL query (prepare your material)
    $query = $database->prepare($sql);
    // 3.3 - execute the SQL query (cook it)
    $query->execute();
    // 3.4 - fetch all the results from the query (eat)
    $tasks = $query->fetchAll();

    // var_dump($students);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <?php if (isset($_SESSION["user"])) : ?>
          <ul class="list-group">
          <?php foreach ($tasks as $index => $task) { ?>
              <li
              class="list-group-item d-flex justify-content-between align-items-center"
              >
                  <div>
                      <form method="POST" action="completed_task.php">
                          <input type="hidden" name="task_id" value="<?= $task["id"]?>" />
                          <input type="hidden" name="task_completed" value="<?= $task["completed"]?>" />

                          <?php if ($task["completed"] === 0) { ?>
                          <button class="btn btn-sm btn-light">
                              <i class="bi bi-square"></i>
                          </button>
                          <span class="ms-2"><?= $task["label"]?></span>

                          <?php } else { ?>
                              <button class="btn btn-sm btn-success">
                                  <i class="bi bi-check-square"></i>
                              </button>
                              <span class="ms-2 text-decoration-line-through"><?= $task["label"]?></span>
                          <?php } ?>

                      </form>
                  </div>

                  <div>
                      <!-- delete button -->
                      <form method="POST" action="delete_task.php">
                          <input type="hidden" name="task_id" value="<?= $task["id"]?>" />
                          <button class="btn btn-sm btn-danger">
                              <i class="bi bi-trash"></i>
                          </button>
                      </form>
                  </div>
              </li>

          <?php } ?>
          </ul>
          <div class="mt-4">
            <form 
            class="d-flex justify-content-between align-items-center"
            method="POST"
            action="add_task.php"
            >
              <input
                type="text"
                class="form-control"
                name="task_name"
                placeholder="Add new item..."
              />
              <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
            </form>
          </div>
        </div>
      </div>
      
      <div>
        <a href="logout.php" class="d-flex justify-content-center">Logout</a>
      </div>
    <?php else : ?>
      <div class="d-flex gap-3">
        <a href="login.php">Login</a>
        <a href="signup.php">Sign up</a>
      </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
