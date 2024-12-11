<?php
// DB 연결 설정
$servername = "localhost";
$username = "root";
$password = "mariadb";
$dbname = "spotore_php";

// POST로 받아온 새로운 비밀번호 값
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['newPassword'];
    $userID = $_POST['userID'];

    // DB 연결
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 연결 확인
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 새로운 비밀번호를 DB에 업데이트
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE members SET pass = '$hashedPassword' WHERE id = '$userID'";
    $result = $conn->query($sql);

    if ($result !== false) {
        $message = "비밀번호가 성공적으로 변경되었습니다.";
        $redirectToLogin = true;
    } else {
        $message = "비밀번호 변경에 실패하였습니다.";
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
    <title>비밀번호 변경</title>
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
        <h2>비밀번호 변경</h2>
        <?php if (isset($message)): ?>
            <p class="message"><?php echo $message; ?></p>
            <?php if (isset($redirectToLogin) && $redirectToLogin): ?>
                <p class="redirect-message">3초 후에 자동으로 로그인 화면으로 이동합니다.</p>
                <script>
                    setTimeout(function () {
                        window.location.href = "login.php";
                    }, 3000);
                </script>
            <?php endif; ?>
        <?php else: ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="userID" value="<?php echo $_GET['userID']; ?>">
                <label for="newPassword">새로운 비밀번호:</label>
                <input type="password" name="newPassword" required>
                <button type="submit">비밀번호 변경</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>