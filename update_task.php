<?php
include_once('db.php');
// AJAX request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $taskID = isset($_POST["task_id"]) ? intval($_POST["task_id"]) : 0;
    $taskDone = isset($_POST["task_done"]) ? intval($_POST["task_done"]) : 0;

    try {
        $stmt = $db->prepare("UPDATE todolist SET done = :done WHERE task_id = :task_id");
        $stmt->bindParam(':done', $taskDone);
        $stmt->bindParam(':task_id', $taskID);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
}
