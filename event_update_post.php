<?php
$num = $_REQUEST["num"];
$category = $_REQUEST["category"];
$title = $_REQUEST["title"];
$imglink = $_REQUEST["imglink"];
$pagelink = $_REQUEST["pagelink"];
$writer = $_REQUEST["writer"];
$content = $_REQUEST["content"];

if ($title != "" && $writer != "" && $content != "" && $imglink !="" && $pagelink !="") {
    $regtime =date("Y-m-d");// YYYY-mm-dd 형식

    $db = new PDO("mysql:host=localhost;port=3306;dbname=spotore_php", "root", "mariadb");
    $db->exec("UPDATE event SET 
            category = '$category',
            writer = '$writer',
            title = '$title',
            imglink = '$imglink',
            pagelink = '$pagelink',
            content = '$content',
            regtime = '$regtime',
            hits = 0
            WHERE num = $num");
        echo '<script>';
        echo 'alert("글을 성공적으로 수정하였습니다.");';
        echo 'location.href="manager_event.php";';
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