<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>SPOTORE</title>
</head>

<body>
    <?php require_once("inc/header.php"); ?>
    
    <div class="picked_category">
        <span class="category_index">이벤트&기획전</span>
    </div>
    <div><br></div>

<?php
// 데이터베이스 연결 설정
$db = new PDO("mysql:host=localhost;port=3306;dbname=spotore_php", "root", "mariadb");

// 이벤트 데이터 가져오기
$stmt = $db->prepare("SELECT title, content, imglink, pagelink FROM event");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 각 이벤트 데이터를 반복하여 출력
foreach ($events as $event) {
    echo '<main class="main_wrapper_banner">';
    echo '<a href="' . $event['pagelink'] . '" class="main_wrapper_banner">';
    echo '<div class="bannerlist_main">';
    echo '<div class="banner_content">';
    echo '<span class="banner_name">' . $event['title'] . '<hr></span>';
    echo '<p>' . $event['content'] . '</p>';
    echo '</div>';
    echo '<img src="' . $event['imglink'] . '" alt="">';
    echo '</div>';
    echo '</a>';
    echo '</main>';
}
?>

<?php require_once("inc/fast_move.php"); ?>
<?php require_once("inc/footer.php"); ?>

<script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
<script src="js/hot_issue.js"></script>
<script src="js/member.js"></script>
