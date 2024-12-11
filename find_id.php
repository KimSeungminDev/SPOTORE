<?php
// DB 연결 설정
$servername = "localhost";
$username = "root";
$password = "mariadb";
$dbname = "spotore_php";

// POST로 받아온 이메일 값
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // DB 연결
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 연결 확인
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 이메일을 이용하여 아이디 조회
    $sql = "SELECT id FROM members WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 아이디를 찾았을 경우
        $row = $result->fetch_assoc();
        $found_id = $row['id'];
        $message = "아이디는 $found_id 입니다.";
        $showForm = false; // 아이디를 찾았으므로 폼을 감춤
    } else {
        // 아이디를 찾지 못했을 경우
        $message = "해당 이메일로 등록된 아이디가 없습니다.";
        $showForm = true; // 아이디를 찾지 못했으므로 폼을 표시
    }

    // 연결 종료
    $conn->close();
} else {
    $showForm = true; // 초기 상태에서 폼을 표시
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>아이디 찾기</title>
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
    font-size:32px;
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
        <h2>아이디 찾기</h2>
        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if ($showForm): ?>
            <!-- 아이디를 찾지 못한 경우에만 폼을 표시 -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="email">이메일:</label>
                <input type="email" name="email" required>
                <button type="submit">아이디 찾기</button>
            </form>
        <?php else: ?>
            <!-- 아이디를 찾은 경우에는 돌아가기 버튼 표시 -->
            <button onclick="goBack()">돌아가기</button>
            <script>
                function goBack() {
                    // login.php로 이동
                    window.location.href = 'login.php';
                }
            </script>
        <?php endif; ?>
    </div>
</body>
</html>
