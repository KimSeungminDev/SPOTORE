<?php
$type = $_REQUEST["type"];
$title = $_REQUEST["title"];
$writer = $_REQUEST["writer"];
$content = $_REQUEST["content"];

if ($title != "" && $writer != "" && $content != "") {
    $regtime =date("Y-m-d");// YYYY-mm-dd 형식

    $db = new PDO("mysql:host=localhost;port=3306;dbname=spotore_php", "root", "mariadb");
    $db->exec("insert into inquiry (type,writer, title, content, regtime, hits,response) 
                values ('$type','$writer', '$title', '$content', '$regtime', 0,'관리자가 아직 답변하지 않았습니다.')");
        echo '<script>';
        echo 'alert("글을 성공적으로 작성하였습니다.");';
        echo 'location.href="my-page_inquiry.php";';
        echo '</script>';
        exit;
   

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>

    <script>
        alert('모든 항목이 빈칸 없이 입력되어야 합니다.');
        history.back();
    </script>

</body>

</html>