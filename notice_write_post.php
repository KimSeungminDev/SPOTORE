<?php
$title = $_REQUEST["title"];
$writer = $_REQUEST["writer"];
$content = $_REQUEST["content"];

if ($title != "" && $writer != "" && $content != "") {
    $regtime =date("Y-m-d");// YYYY-mm-dd 형식

    $db = new PDO("mysql:host=localhost;port=3306;dbname=spotore_php", "root", "mariadb");
    $db->exec("insert into notice (writer, title, content, regtime, hits) 
                values ('$writer', '$title', '$content', '$regtime', 0)");
        echo '<script>';
        echo 'alert("글을 성공적으로 작성하였습니다.");';
        echo 'location.href="manager_notice.php";';
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