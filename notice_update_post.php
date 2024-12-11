<?php
$num = $_REQUEST["num"];
$title = $_REQUEST["title"];
$writer = $_REQUEST["writer"];
$content = $_REQUEST["content"];

if ($title != "" && $writer != "" && $content != "") {

    $db = new PDO("mysql:host=localhost;port=3306;dbname=spotore_php", "root", "mariadb");
    $db->exec("UPDATE notice SET title = '$title', writer = '$writer', content = '$content' WHERE num = '$num'");
        echo '<script>';
        echo 'alert("글을 성공적으로 수정하였습니다.");';
        header("Location: notice_view.php?num=" . $num);
        exit;
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