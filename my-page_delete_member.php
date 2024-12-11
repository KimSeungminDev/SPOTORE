<?php
require_once("pay.import.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 폼에서 전송된 데이터 수신
    $name = $_POST["name"];
    $id = $_POST["id"];
    $password = $_POST["password"];

    // 입력값이 모두 채워져 있는지 확인
    if (empty($name) || empty($id) || empty($password)) {
        echo '<script>alert("빈 칸을 모두 채워주세요.");</script>';
    } else {
        // DB 연결 및 회원 확인
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "mariadb";
        $db_name = "spotore_php";

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // 입력받은 정보로 회원 확인
        $sql = "SELECT * FROM members WHERE name = '$name' AND id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $member_data = $result->fetch_assoc();
            
            // 암호화된 비밀번호를 확인
            $hashed_password = $member_data['pass'];
            
            // 입력한 비밀번호와 암호화된 비밀번호를 비교
            if (password_verify($password, $hashed_password)) {
                // 일치하는 회원이 있으면 삭제
                $delete_sql = "DELETE FROM members WHERE name = '$name' AND id = '$id'";
                
                // 현재 세션 종료

                session_destroy();

                if ($conn->query($delete_sql) === TRUE) {
                    echo '<script>
                            if (confirm("회원 정보가 성공적으로 삭제되었습니다.\\n자동으로 로그아웃됩니다.")) {
                                window.location.href = "index.php";
                            } else {
                                window.location.href = "my-page_delete_member.php";
                            }
                          </script>';
                    exit();
                } else {
                    echo '<script>alert("삭제 중 오류가 발생했습니다.");</script>';
                }
            } else {
                echo '<script>alert("입력한 비밀번호가 일치하지 않습니다.");</script>';
            }
        } else {
            echo '<script>alert("입력한 정보와 일치하는 회원이 없습니다.");</script>';
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* 추가된 CSS 스타일 */
        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
        }


    </style>
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
                <a href="my-page_member_pwd.php"><li class="nav" style="width: 165px;"><span>회원정보 수정</span></li></a>
                <a href="my-page_order.php"><li class="nav" style="width: 165px;"><span>주문배송</span></li></a>
                <li class="nav"><span>쿠폰/적립금</span></li>
                <a href="my-page_inquiry.php"><li class="nav" style="width: 165px;"><span>교환/반품</span></li></a>
                <li class="nav"><span>좋아요</span></li>
                <li class="nav"><span>최근 본 상품</span></li>
                <a href="my-page_delete_member.php"><li class="nav" style="background-color: #FD9F28; width: 165px;"><span>회원탈퇴</span></li></a>
            </ul>
        </section>
        <section class="view">
        <div class="member_pwd_title"><span>회원 정보 수정</span></div>
        <div><br></div>
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <form method="post" action="">
                <label for="name">이름</label>
                <input type="text" id="name" name="name" required>

                <label for="id">아이디</label>
                <input type="text" id="id" name="id" required>
                <label for="password">비밀번호</label>
                <input type="password" id="password" name="password" required>


                <button type="submit">회원탈퇴</button>
            </form>
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