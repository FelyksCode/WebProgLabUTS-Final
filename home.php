<?php
require_once('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}

$sql = "SELECT id, task_id, task, done, progress, deskripsi, DATE_FORMAT(tanggal,'%d %M %Y') as tanggal FROM todolist WHERE id = ? ORDER BY done ASC, tanggal ASC";

$stmt = $db->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$count = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>TODO LIST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<style>
    .navbar-brand.active {
        color: white;
    }

    .navbar-brand.inactive {
        color: #777777;
    }

    .red-color {
        color: red;
    }

    .green-color {
        color: green;
    }
</style>

<body>

    <div class="container-fluid m-0 p-0">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid d-flex justify-content-center">
                <a class="navbar-brand text-center active" href="home.php">
                    Todo List
                </a><a class="navbar-brand text-center inactive" href="form_todolist.php">Add Todo List</a>
                <a class="navbar-brand text-center inactive" href="logout.php">Log Out</a>

        </nav>

        <div class="container">
            <br />
            <h1 style="text-align: center;">To Do List</h1>
            <p style="font-style: italic;">Add any to do's that are on your list for the wedding.</p>
            <table class="table table-bordered">

                <tbody>

                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Edit</th>
                            <th class="text-center" scope="col">Task</th>
                            <th class="text-center" scope="col">
                                <input type="checkbox" id="headerCheckbox" aria-label="Checkbox for following text input">
                                Done
                            <th class="text-center" scope="col">Progress</th>
                            <th class="text-center" scope="col">Tanggal</th>
                            <th class="text-center" scope="col">Delete</th>
                        </tr>
                    </thead>

                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr class="task-row" data-task-id="<?php echo $row['task_id']; ?>">
                            <td class="text-center">
                                <a href="#" class="edit-link" data-task-id="<?php echo $row['task_id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                    </svg>
                                </a>
                            </td>

                            <td>
                                <b>
                                    <h6 class="task-name" data-task-id="<?php echo $row['task_id']; ?>">
                                        <?php echo $row["task"] ?>
                                    </h6>
                                </b>
                                <p class="deskripsi" data-task-id="<?php echo $row['task_id']; ?>">
                                    <?php echo $row['deskripsi']; ?>
                                </p>
                            </td>

                            <td class="text-center">
                                <input type="checkbox" id="done_<?php echo $row['task_id']; ?>" name="done" aria-label="Checkbox for following text input" data-task-id='<?php echo $row['task_id']; ?>' <?php if ($row["done"] == 1) echo "checked"; ?>>
                            </td>

                            <td class="text-center">
                                <select class="form-select" aria-label="Default select example" name="progress" id="progress_<?php echo $row['task_id']; ?>" data-task-id='<?php echo $row['task_id']; ?>'>
                                    <option value="<?php echo $row['progress']; ?>" hidden><?php echo $row['progress']; ?></option>
                                    <option value="Not yet started">Not yet started</option>
                                    <option value="In progress">In progress</option>
                                    <option value="Waiting on">Waiting on</option>
                                    <option value="etc...">etc...</option>
                                </select>
                            </td>

                            <td class="text-center">
                                <span class="tanggal" data-task-id="<?php echo $row['task_id']; ?>">
                                    <?php echo $row['tanggal']; ?>
                                </span>
                            </td>

                            <td class="text-center">
                                <a href='delete_task.php?task_id=<?php echo $row['task_id']; ?>'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash red-color" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                    </svg>
                                </a>
                            </td>

                        </tr>
                    <?php
                        $count++;
                    }
                    ?>

                </tbody>
            </table>
            <p class="text-center">Count: <b><?php echo $count; ?></b></p>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="functions.js">

        </script>
</body>

</html>