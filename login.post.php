<?php
echo("<script>alert('login.post.php로 들어옴');</script>");
require_once("inc/db.php");

$login_id = isset($_POST['id']) ? $_POST['id'] : null;
$login_pw = isset($_POST['pass']) ? $_POST['pass'] : null;

// 파라미터 체크
if ($login_id == null || $login_pw == null){    
    echo("<script>alert('모두 입력하여 주세요.');</script>");
    // header("Location: login.php");
    exit();
}

echo ("<script>alert('입력한 아이디 :'+$login_id +'입력한 비번 :'+$login_pw);</script>");

// 회원 데이터
$member_data = db_select("select * from members where id = ?", array($login_id));

// 회원 데이터가 없다면
if ($member_data == null || count($member_data) == 0){
    echo("<script>alert('회원가입을 먼저하세요');</script>");
    exit();
}

// 비밀번호 일치 여부 검증
$is_match_password = password_verify($login_pw, $member_data[0]['pass']);

// 비밀번호 불일치
if ($is_match_password === false){
    header("Location: login.php");
    echo("<script>alert('아이디 혹은 비밀번호가 틀렸습니다!');</script>");
    exit();
}

require_once("inc/session.php");
$_SESSION['member_id'] = $member_data[0]['id'];
$_SESSION['role'] = $member_data[0]['role']; // 사용자 역할(role) 추가

// 회원 정보 변경에 성공한 경우
echo("<script>alert('회원 정보 변경에 성공했습니다.');</script>");

// 역할에 따라 페이지 리다이렉트
if ($_SESSION['role'] === 'USER') {
    header("Location: index.php");
} else if ($_SESSION['role'] === 'ADMIN') {
    header("Location: manager_index.php");
} else {
    // 기타 경우에 대한 처리
    // 예를 들어, 특정 역할이 없는 경우 등
    // header("Location: some_other_page.php");
}
?>