<?php

header("Content-Type: application/json");
include "db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Only POST requests are allowed."
    ]);
    exit;
}

if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Post ID is required."
    ]);
    exit;
}

$id = intval($_POST['id']);

$update = $conn->prepare("UPDATE posts SET likes = likes + 1 WHERE id = ?");
$update->bind_param("i", $id);
$update->execute();

$get = $conn->prepare("SELECT likes FROM posts WHERE id = ?");
$get->bind_param("i", $id);
$get->execute();

$result = $get->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        "status" => "success",
        "likes" => (int)$row['likes']
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Post not found."
    ]);
}

$conn->close();
?>