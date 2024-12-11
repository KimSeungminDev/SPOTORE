<!DOCTYPE html>
<head>
<meta charset="utf-8">
<style>
h3 {
   padding-left: 5px;
   border-left: solid 5px #edbf07;
}
#close {
   margin:20px 0 0 80px;
   cursor:pointer;
}
</style>
<script>
// 페이지 로드 후 3초 뒤에 로그인 페이지로 이동
window.onload = function() {
    setTimeout(function() {
        window.location.href = "login.php"; // 로그인 페이지 경로로 수정
    }, 3000);
};
</script>
</head>
<body>
<h3>입력 성공</h3>
<p>
<h3>회원 가입에 성공 했습니다. 3초 후에 자동으로 로그인 화면으로 이동합니다.</h3>
</p>

</body>
</html>
