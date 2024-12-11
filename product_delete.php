<?php
$content_code=$_REQUEST["content_code"];

    $db = new PDO("mysql:host=localhost;port=3306;dbname=spotore_php", "root", "mariadb");
    $stmt = $db->prepare("DELETE FROM contents WHERE content_code = :content_code");
    $stmt->bindParam(':content_code', $content_code);
    $stmt->execute();
    
    if ($stmt->errorCode() != '00000') {
        print_r($stmt->errorInfo()); // 에러 정보 출력
    } else {
        echo '<script>';
        echo 'alert("글을 성공적으로 삭제했습니다.");';
        echo 'location.href="manager_product.php";';
        echo '</script>';
        exit;
    }
?>