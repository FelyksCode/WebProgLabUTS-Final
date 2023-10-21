<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('location: home.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Log In</title>
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
                <a class="navbar-brand text-center inactive" href="index.php">
                    Register
                </a>
                <a class="navbar-brand text-center active" href="login.php">
                    Login
                </a>


            </div>
        </nav>
        <div class="container " style="padding-inline: 15%;">
            <br />
            <h1 class="text-center">Sign In</h1>
            <div id="error" class="text-danger">
                <?php
                if (isset($_GET['warning'])) {
                    echo '<p class="text-center p-2">' . $_GET['warning'] . '</p>';
                }
                ?>
            </div>
            <form method="post" action="login_process.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" value="" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" value="" required>
                </div>
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>