<?php require_once("inc/db.php");

$result =db_select("SELECT * FROM contents ORDER BY RAND() LIMIT 20");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.7.1.min.js"></script> <!-- jQuery 스크립트 경로 수정 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css"> <!-- BXSlider 스타일 시트 추가 -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="js/jquery.bxslider.css"> <!-- 스타일 시트 경로 수정 -->
    <script src="js/jquery.bxslider.min.js"></script> <!-- 라이브러리 스크립트 경로 수정 -->
    <title>SPOTORE</title>
    <style>
        #id {
            background-color: yellow;
        }
    </style>
</head>

<body>
    <!--    <div class="adv_main">상 단 광 고</div>   -->
    <?php require_once("inc/manager_header.php"); ?>

    <main class="main_wrapper">
        <ul class="banner_main bxslider">
            <li><a href="nbaden.php"><img src="img/main.jpg" alt="Banner 1"></a></li>
            <li><a href="mlbtex.php"><img src="img/mlbmain.jpg" alt="Banner 2"></a></li>
            <li><a href="ligue1psg.php"><img src="img/soccermain.jpg" alt="Banner 3"></a></li>
            <!-- <li><a href="/esports"><img src="img/esportsmain.jpg" alt="Banner 4"></a></li> -->
        </ul>
        
        <div class="recommend_main_wrapper">
            <div class="recommend_main_header">
                <span class="recomend_main_title">SPOTORE에서 판매하는 다양한 상품들을 만나보세요!</span>                
            </div>
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <div class="recommend_main_content_wrapper">
                <ul class="recommend_main_contents">
                    <?php foreach ($result as $r) { ?>
                        <a href="contents_detail.php?content_code=<?php echo "$r[content_code]" ?>">
                            <li class="recommend_main_content">
                                <div class="content_img_wrapper"> <img src="<?php echo "$r[content_img]" ?>" alt="" /></div>
                                <div class="content_text_wrapper">
                                    <div class="content_name_wrapper">
                                        <span class="content_name"><?php echo "$r[content_name]" ?></span>
                                    </div>
                                    <div class="content_price_wrapper">
                                        <span class="discount_rate"><?php echo "$r[discount_rate]" ?>%</span>
                                        <span class="content_price"><?php echo number_format($r['content_price']) ?>원</span>
                                    </div>
                                    <div class="delivery_today_mark_wrapper">
                                        <?php if ("$r[deliv_today]" === "Y") { ?>
                                            <i class="fas fa-bolt"></i>
                                            <span>오늘 출발</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>
                        </a>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </main>

    <div class="picked_category">
            <span class="category_index">더 많은 상품을 지금, SPOTORE에서 만나보세요!</span>
    </div>

    <?php require_once("inc/fast_move.php"); ?>
    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script> <!-- BXSlider 스크립트 추가 -->
    <script src="js/hot_issue.js"></script>
    <script src="js/member.js"></script>
    <script src="js/sort.js"></script>

    <script>
    $(document).ready(function () {
    var slider = $('.banner_main').bxSlider({
      mode: 'horizontal',  // 슬라이드 방향을 수평으로 변경
      auto: true,
      pause: 5000,
      captions: true,
      controls: true,
      touchEnabled: (navigator.maxTouchPoints > 0),
      infiniteLoop: true,  // 무한 루프 활성화
      speed: 1000,          // 슬라이드 전환 속도 (밀리초)
    });

    // var autoInterval = 5000; // 자동 슬라이딩 간격 (5초)

    // // 초기 자동 슬라이딩 시작
    // var autoSlide = setInterval(function() {
    //     slider.goToNextSlide();
    // }, autoInterval);

    var autoSlide; // 자동 슬라이딩을 제어할 변수

function startAutoSlide() {
    autoSlide = setInterval(function() {
        slider.goToNextSlide();
    }, autoInterval);
}

function stopAutoSlide() {
    clearInterval(autoSlide);
}

// 페이지 로드 후 자동 슬라이딩 시작
$(document).ready(function () {
    var slider = $('.banner_main').bxSlider({
        mode: 'fade',
        auto: false, // 자동 슬라이딩을 중지합니다.
        pause: 5000,
        captions: true,
        controls: true,
        touchEnabled: (navigator.maxTouchPoints > 0)
    });

    startAutoSlide(); // 자동 슬라이딩 시작
});

});
</script>

</body>

</html>