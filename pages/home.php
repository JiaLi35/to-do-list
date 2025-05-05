<?php
    // Connect to database
    $database = connectToDB();

    // 3. get the students data from the database
    // 3.1 - SQL command (recipe) *the only thing that will change (the rest will stay the same)
    $sql = "SELECT * FROM todos";
    // 3.2 - prepare SQL query (prepare your material)
    $query = $database->prepare($sql);
    // 3.3 - execute the SQL query (cook it)
    $query->execute();
    // 3.4 - fetch all the results from the query (eat)
    $tasks = $query->fetchAll();
?>
<?php require "parts/header.php";?>
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
                      <form method="POST" action="/task/complete">
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
                      <form method="POST" action="/task/delete">
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
            action="/task/add"
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
        <a href="/logout" class="d-flex justify-content-center">Logout</a>
      </div>
    <?php else : ?>
      <div class="d-flex gap-3">
        <a href="/login">Login</a>
        <a href="/signup">Sign up</a>
      </div>
    <?php endif; ?>
<?php require "parts/footer.php"; ?>
