<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>簡単なゲーム</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('game.jpg'); /* 设置背景图片路径 */
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
            background-color: #28a745; /* 修改按钮颜色为绿色 */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838; /* 按钮悬停时的颜色 */
        }

        #score {
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>簡単なゲーム</h1>
        <button onclick="startGame()">ゲーム開始</button>
        <div id="score">スコア: 0</div>
        <button onclick="saveScore()">スコアを保存</button>
        <br>
        <button style="background: cadetblue;" onclick="window.location.href='scores.php'">保存されたスコアを見る</button>
        <br>
        <button style="background: red;" onclick="window.location.href='login.php'">ログインページへ</button>
    </div>

    <script>
        let score = 0;

        function startGame() {
            score = Math.floor(Math.random() * 100);
            document.getElementById('score').innerText = "スコア: " + score;
        }

        function saveScore() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "save_score.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("スコアが保存されました！");
                }
            };
            xhr.send("score=" + score);
        }
    </script>
</body>
</html>
