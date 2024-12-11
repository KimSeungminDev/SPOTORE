<?php
$num=$_REQUEST["num"];

    $db = new PDO("mysql:host=localhost;port=3306;dbname=spotore_php", "root", "mariadb");
    $db->exec("delete from notice where num = $num");
    echo '<script>';
    echo 'alert("글을 성공적으로 삭제했습니다.");';
    echo 'location.href="manager_notice.php";';
    echo '</script>';
    exit;
?>