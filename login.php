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
    <?php require_once("inc/header.php"); ?>

    <main class="login_wrapper member">
        <div class="login_start">
            <span class="login_title"> 로그인 </span>
        </div>
        <div class="login_sns_wrapper">
            <a href="">
                <div class="kakao_login">
                    <span class="kakao_login_title"> 카카오톡 ID 로그인 / 회원가입 </span>
                </div>
            </a>
            <a href="">
                <div class="naver_login">
                    <span class="naver_login_title"> 네이버 로그인 </span>
                </div>
            </a>
        </div>
        <div class="login_or">
            <span class="login_or_title"> ------------------------------------------------- 또는
                ------------------------------------------------- </span>
        </div>
        <div class="login_member_wrapper">
            <div class="member_login">
                <span class="member_login_title"> 회원 </span>
            </div>
            <a href="login_nonmember.php">
                <div class="non_member_login">
                    <span class="non_member_login_title"> 비회원 </span>
                </div>
            </a>
        </div>

        <form name="login_form" method="POST" action="login.post.php">
            <div class="ID_wrapper">
                <fieldset class="ID_field-container">
                    <input type="text" placeholder="아이디를 입력하세요." class="ID_field_text" name="id" />
                </fieldset>
            </div>
            <div class="FW_wrapper">
                <fieldset class="FW_field-container">
                    <input type="password" placeholder="비밀번호를 입력하세요." class="FW_field_text" name="pass" />
                </fieldset>
            </div>
            <div class="login_keep_wrapper">
                <div class="ID_keep_check">
                    <input type="checkbox" class="input_ID_keep">
                    <lavel for="ID_keep" class="ID_keep_text"> 아이디 저장 </lavel>
                </div>
                <div class="all_keep_check">
                    <input type="checkbox" class="input_all_keep">
                    <lavel for="all_keep" class="all_keep_text"> 로그인 상태 유지 </lavel>
                </div>
            </div>
            <div class="finish_login_wrapper">
                <button class="finish_login" onclick="login()">
                    <span class="finish_login_title"> 로그인 </span>
                </button>
            </div>
        </form>

        <div class="find_wrapper">
            <ul>
                <a href="sign_up.php">
                    <li> <span>회원가입</span>
                    </li>
                </a>
                <a href="find_id.php">
                    <li> <span>아이디 찾기</span> </li>
                </a>
                <a href="find_password.php">
                    <li class="none_border"> <span>비밀번호 찾기</span> </li>
                </a>
            </ul>
        </div>

        <!-- class="find_text" -->

        <div class="login_member_non_member"></div>

    </main>

    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="../js/hot_issue.js"></script>
    <script src="js/member.js"></script>
</body>

</html>