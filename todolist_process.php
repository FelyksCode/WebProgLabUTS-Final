<?php
require_once('db.php');
session_start();
$id = $_SESSION['user_id'];
$task = $_POST['task'];
$done = 0;
$progress = 'Not yet started';
$deskripsi = $_POST['deskripsi'];
$tanggal = $_POST['tanggal'];

$sql = "INSERT INTO todolist (id, task, done, progress, deskripsi, tanggal, create_date) VALUES (?, ?, ?, ?, ?, ?, now())";

$result = $db->prepare($sql);
$result->execute([$id, $task, $done, $progress, $deskripsi, $tanggal]);

header('location: home.php');
