<?php
require_once('db.php');

// Ensure this script is accessed via a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST data and decode it as JSON
    $post_data = json_decode(file_get_contents("php://input"), true);

    // Check if the required fields are present
    if (isset($post_data['taskID'], $post_data['taskName'], $post_data['deskripsi'], $post_data['tanggal'])) {
        $taskID = $post_data['taskID'];
        $taskName = $post_data['taskName'];
        $deskripsi = $post_data['deskripsi'];
        $tanggal = $post_data['tanggal'];

        // Prepare and execute an SQL update statement
        $sql = "UPDATE todolist SET task = ?, deskripsi = ?, tanggal = ? WHERE task_id = ?";
        $stmt = $db->prepare($sql);
        if ($stmt->execute([$taskName, $deskripsi, $tanggal, $taskID])) {
            // Update successful
            $response = array('success' => true);
            echo json_encode($response);
        } else {
            // Update failed
            $response = array('success' => false, 'message' => 'Update failed');
            echo json_encode($response);
        }
    } else {
        // Invalid or missing data
        $response = array('success' => false, 'message' => 'Invalid data');
        echo json_encode($response);
    }
} else {
    // If not a POST request, return an error
    http_response_code(405); // Method Not Allowed
    exit;
}
