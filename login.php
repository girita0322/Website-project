<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        header("Location: game.php");
        exit();
    } else {
        echo "ログインに失敗しました。";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('login.jpg'); /* 设置背景图片路径 */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.8); /* 设置表单背景色及透明度 */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        h1 {
            text-align: center;
            color: white;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        button {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005f6b;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>ログイン</h1>
        <form method="post" action="">
            ユーザー名: <input type="text" name="username" required><br>
            パスワード: <input type="password" name="password" required><br>
            <input type="submit" value="ログイン">
        </form>
        <button onclick="window.location.href='register.php'">ユーザー登録</button>
    </div>
</body>
</html>
