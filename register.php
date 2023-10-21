<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('location: home.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
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
                <a class="navbar-brand text-center active" href="index.php">
                    Register
                </a>
                <a class="navbar-brand text-center inactive" href="login.php">
                    Login
                </a>

            </div>
        </nav>
        <div class="container " style="padding-inline: 15%;">
            <br />
            <h1 class="text-center">Sign Up</h1>
            <div id="error" class="text-danger"></div>
            <form method="post" action="register_process.php" onsubmit="return validasiPassword()">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password2" name="password2" required>
                </div>
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary">
                        Sign Up
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        function validasiPassword() {
            var password = document.getElementById('password').value;
            var password2 = document.getElementById('password2').value;
            var errorMessage = document.getElementById('error');

            if (password != password2) {
                message = `<p class="text-center p-2">Incorrect Password</p>`;
                errorMessage.innerHTML = message;
                return false;
            } else {
                errorMessage.innerHTML = "";
                return true;
            }
        }
    </script>
</body>

</html>