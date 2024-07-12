<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "登録が成功しました。";
    } else {
        echo "登録に失敗しました: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('register.jpg'); /* 设置背景图片路径 */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        .register-container {
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
    <div class="register-container">
        <h1>ユーザー登録</h1>
        <form method="post" action="">
            ユーザー名: <input type="text" name="username" required><br>
            パスワード: <input type="password" name="password" required><br>
            <input type="submit" value="登録">
        </form>
        <button onclick="window.location.href='login.php'">ログインページへ</button>
    </div>
</body>
</html>
