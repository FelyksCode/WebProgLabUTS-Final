<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Todo list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<style>
    .navbar-brand.active {
        color: white;
    }

    .navbar-brand.inactive {
        color: #777777;
    }

    #error {
        background-color: #f2809b;
        border-radius: 5px;
    }
</style>

<body>
    <div class="container-fluid m-0 p-0">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid d-flex justify-content-center">
                <a class="navbar-brand text-center inactive" href="home.php">
                    Todo List
                </a><a class="navbar-brand text-center active" href="form_todolist.php">Add Todo List</a>
                <a class="navbar-brand text-center inactive" href="logout.php">Log Out</a>
        </nav>
        <div class="container " style="padding-inline: 15%;">
            <br />
            <h1 class="text-center">Add Something Todo</h1>
            <div id="error" class="text-danger"></div>
            <form method="post" action="todolist_process.php">
                <div class="mb-3">
                    <label for="task" class="form-label">Task</label>
                    <input type="text" class="form-control" id="task" name="task" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>

                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

</html>