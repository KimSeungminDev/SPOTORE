<?php
require_once("pay.import.php");

// DB 연결 및 회원 확인
$db_host = "localhost";
$db_user = "root";
$db_pass = "mariadb";
$db_name = "spotore_php";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// POST로 전송된 폼 데이터를 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 사용자가 입력한 비밀번호
    $enteredPassword = $_POST["pass_member"];
    $enteredId = $_POST["id"];

    // 데이터베이스에서 저장된 해시된 비밀번호 가져오기
    $sql = "SELECT * FROM members WHERE id = '$enteredId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["pass"]; // 데이터베이스에서 가져온 해시된 비밀번호

        // 비밀번호 검증
        if (password_verify($enteredPassword, $hashedPassword)) {
            // 비밀번호가 일치하는 경우에만 정보 수정 페이지로 이동
            header("Location: my-page_mem_info.php");
            exit();
        } else 
            // 비밀번호가 일치하지 않는 경우 메시지를 표시하거나 다른 조치를 취할 수 있음
            echo '<script>alert("비밀번호가 일치하지 않습니다.");</script>';
        } else {
            // 사용자가 입력한 아이디가 틀렸을 경우 메시지를 표시
            echo '<script>alert("아이디가 틀렸습니다.");</script>';
        }
    }


// 데이터베이스 연결 종료
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>SPOTORE</title>
</head>

<body>
<div class="adv_main">
        <img class = "ad_img" src="img/ad_img.png" alt="광고 이미지">
    </div>
    <?php require_once("inc/header.php"); ?>

    <main class="main_wrapper my-page">
        <section class="menus">
            <div class="my-page_title"><span>MY PAGE</span></div>
            <ul class="navs">
                <a href="my-page_member_pwd.php"><li class="nav" style="background-color: #FD9F28; width: 165px;"><span>회원정보 수정</span></li></a>
                <a href="my-page_order.php"><li class="nav" style="width: 165px;"><span>주문배송</span></li></a>
                <li class="nav"><span>쿠폰/적립금</span></li>
                <a href="my-page_inquiry.php"><li class="nav" style="width: 165px;"><span>교환/반품</span></li></a>
                <li class="nav"><span>좋아요</span></li>
                <li class="nav"><span>최근 본 상품</span></li>
                <a href="my-page_delete_member.php"><li class="nav" style="width: 165px;"><span>회원탈퇴</span></li></a>
            </ul>
        </section>
        <section class="view">
            <div class="member_pwd_title"><span>회원 정보 수정</span></div>
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <section class="table member">
                <table>
                <div class="form">
                    <form action="" method="post">
                    <div class="pwd_col1">아이디 입력<br><br></div>
                        <div class="pwd_col2">
                            <input type="text" name="id" required><br><br><br>
                        </div>
                        <div class="pwd_col1">비밀번호 입력<br><br></div>
                        <div class="pwd_col2">
                            <input type="password" name="pass_member"required><br><br><br>
                        </div>
                        <button type="submit">확인</button>
                    </form>
                </div>
                </table>
            </section>
        </section>
    </main>

    <?php require_once("inc/fast_move.php"); ?>
    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="js/hot_issue.js"></script>
    <script src="js/member.js"></script>

</body>

</html>