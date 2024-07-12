<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT user_id, score FROM scores WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($user_id, $score);

$scores = [];
while ($stmt->fetch()) {
    $scores[] = array("user_id" => $user_id, "score" => $score);
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>保存されたスコア</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('scores.jpg');
            background-size: cover;
            background-position: center;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: red;
        }

        #score {
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>保存されたスコア</h1>
        <?php if (count($scores) > 0): ?>
            <ul>
                <?php foreach ($scores as $score): ?>
                    <li><?php echo "User ID: " . htmlspecialchars($score['user_id']) . ", Score: " . htmlspecialchars($score['score']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>スコアがありません。</p>
        <?php endif; ?>
        <button style="" onclick="window.location.href='game.php'">ゲームページへ戻る</button>
    </div>
</body>
</html>
