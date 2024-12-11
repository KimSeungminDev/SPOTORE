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

    <main class="main_wrapper sign_up">
        <span class="join_us_title">회원 정보 입력</span>
        <div class="join_box">
            <form name="member_form" method="POST" action="member_insert.php" class="member_form">
                <div class="member_form_col">
                    <div class="ref">필수입력</div>
                    <div class="member_form_row row1">
                        <div class="form id">
                            <div class="col1">아이디</div>
                            <div class="col2">
                                <input type="text" name="id">
                            </div>
                        </div>
                        <div class="clear"></div>

                        <div class="form">
                            <div class="col1">비밀번호</div>
                            <div class="col2">
                                <input type="password" name="pass">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">비밀번호 확인</div>
                            <div class="col2">
                                <input type="password" name="pass_confirm">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">이름</div>
                            <div class="col2">
                                <input type="text" name="name">
                            </div>
                        </div>
                        <div class="form">
                            <div class="col1">휴대전화</div>
                            <div class="col2">
                                <input type="text" name="phone">
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="ref">선택입력</div>
                    <div class="member_form_row row2">
                        <div class="form">
                            <div class="col1">생년월일</div>
                            <div class="col2">
                                <input type="text" name="birth">
                            </div>
                        </div>
                        <div class="form email">
                            <div class="col1">이메일</div>
                            <div class="col2">
                                <input type="text" name="email1">@<input type="text" name="email2">
                            </div>
                        </div>
                        <div class="form">
                            <div class="col1">추천인아이디</div>
                            <div class="col2">
                                <input type="text" name="refferer">
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
        <section>
            <button class="button_join" onclick="check_input()">가입</button>
            <a href="login.php"><button class="button_cancel">취소</button></a>
        </section>

    </main>





    <script src="js/member.js"></script>
</body>

</html>