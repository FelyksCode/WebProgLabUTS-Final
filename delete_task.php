<?php
include_once('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    $deleteSql = "DELETE FROM todolist WHERE id = :id AND task_id = :task_id";
    $deleteStmt = $db->prepare($deleteSql);
    $deleteStmt->bindParam(':id', $_SESSION['user_id']);
    $deleteStmt->bindParam(':task_id', $task_id);
    $deleteStmt->execute();
    header('Location: home.php');
    exit;
} else {
    echo "Failed to delete data.";
}
