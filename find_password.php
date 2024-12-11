<?php
// DB 연결 설정
$servername = "localhost";
$username = "root";
$password = "mariadb";
$dbname = "spotore_php";

// POST로 받아온 아이디와 이름 값
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];
    $userName = $_POST['userName'];

    // DB 연결
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 연결 확인
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 아이디와 이름을 이용하여 해당 유저의 정보 조회
    $sql = "SELECT * FROM members WHERE id = '$userID' AND name = '$userName'";
    $result = $conn->query($sql);

    if ($result !== false && $result->num_rows > 0) {
        // 정보가 일치하는 경우
        header("Location: change_password.php?userID=$userID");
        exit();
    } else {
        // 정보가 일치하지 않는 경우
        $message = "입력하신 정보와 일치하는 계정이 없습니다.";
    }

    // 연결 종료
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>비밀번호 찾기</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 100px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        h2 {
            color: #007bff;
            font-size: 32px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: slideIn 0.5s ease-in-out;
        }

        label {
            margin-bottom: 8px;
            color: #555;
        }

        input {
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 16px;
            color: #555;
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>비밀번호 찾기</h2>
        <?php if (isset($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="userID">아이디:</label>
            <input type="text" name="userID" required>
            <label for="userName">이름:</label>
            <input type="text" name="userName" required>
            <button type="submit">비밀번호 찾기</button>
        </form>
    </div>
</body>
</html>