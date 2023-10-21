<?php
require_once('db.php');

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

$en_pass = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO ms_user (name, username, password, create_date) VALUES (?, ?, ?, now())";

$result = $db->prepare($sql);
$result->execute([$nama, $username, $en_pass]);

header('location: login.php');
