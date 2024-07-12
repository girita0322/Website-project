<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$user_id = $_SESSION['user_id'];
$score = $_POST['score'];

if ($score) {
    $stmt = $conn->prepare("INSERT INTO scores (user_id, score) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $score);

    if ($stmt->execute()) {
        echo "スコアが保存されました";
    } else {
        echo "スコアの保存に失敗しました";
    }

    $stmt->close();
}

$conn->close();
?>
