<?php
include_once('db.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $taskID = isset($_POST["task_id"]) ? intval($_POST["task_id"]) : 0;
    $progress = isset($_POST["progress"]) ? $_POST["progress"] : "";

    // Update the "progress" status of the task in your database
    try {
        $stmt = $db->prepare("UPDATE todolist SET progress = :progress WHERE task_id = :task_id");
        $stmt->bindParam(':progress', $progress);
        $stmt->bindParam(':task_id', $taskID);
        $stmt->execute();
        // You can return a success response if needed
        echo "Progress updated successfully!";
    } catch (PDOException $e) {
        // Handle database errors
        echo "Database Error: " . $e->getMessage();
    }
}
