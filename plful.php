<?php
require_once("inc/db.php");

// 페이지네이션 관련 변수
$itemsPerPage = 20;
$page = $_GET["page"] ?? 1;
$start = ($page - 1) * $itemsPerPage;

// 정렬 매개변수
$sort = $_REQUEST["sort"] ?? "SUBSTRING(content_code,1,6)";
$dir = $_REQUEST["dir"] ?? "desc";
$btn = $_REQUEST["btn"] ?? "1";
$orderPhrase = " ORDER BY $sort $dir";

// 데이터베이스에서 항목 가져오기
$result = db_select("SELECT * FROM contents WHERE content_code LIKE '%-1120%' $orderPhrase LIMIT $start, $itemsPerPage");

// 페이지 링크를 만들기 위한 전체 항목 개수 계산
$totalItems = db_select("SELECT COUNT(*) as count FROM contents WHERE content_code LIKE '%-1120%'")[0]['count'];
$totalPages = ceil($totalItems / $itemsPerPage);
?>   
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
    <!--    <div class="adv_main">상 단 광 고</div>   -->
    <?php require_once("inc/header.php"); ?>
    
    <div class="picked_category">
        <span class="category_index">풀럼 FC 상품</span>
        <div><br></div>
        <div><br></div>
        <div class="soccer">
            <ul>
                <li>
                    <a href="pl.php">
                        <div class="logobutton">
                            <img src="./img/leauge/pl.png" title="" class="js-smart-img">
                        </div>
                    </a>
                </li>
            </ul>
            <!-- 다른 카테고리 항목들... -->
            <ul>
                <li>
                    <a href="laliga.php">
                        <div class="logobutton">
                            <img src="./img/leauge/la.png" title="" class="js-smart-img">
                        </div>
                    </a>
                </li>
            </ul>
            <!-- 다른 카테고리 항목들... -->
            <ul>
                <li>
                    <a href="bundes.php">
                        <div class="logobutton">
                            <img src="./img/leauge/bundes.png" title="" class="js-smart-img">
                        </div>
                    </a>
                </li>
            </ul>
            <!-- 다른 카테고리 항목들... -->
            <ul>
                <li>
                    <a href="serie.php">
                        <div class="logobutton">
                            <img src="./img/leauge/serie.png" title="" class="js-smart-img">
                        </div>
                    </a>
                </li>
            </ul>
            <!-- 다른 카테고리 항목들... -->
            <ul>
                <li>
                    <a href="ligue1.php">
                        <div class="logobutton">
                            <img src="./img/leauge/ligue1.png" title="" class="js-smart-img">
                        </div>
                    </a>
                </li>
            </ul>
            <!-- 다른 카테고리 항목들... -->
            <ul>
                <li>
                    <a href="kleauge.php">
                        <div class="logobutton">
                            <img src="./img/leauge/kleague.png" title="" class="js-smart-img">
                        </div>
                    </a>
                </li>
            </ul>
            <!-- 다른 카테고리 항목들... -->
            <ul>
                <li>
                    <a href="soccernat.php">
                        <div class="logobutton">
                            <img src="./img/leauge/national.png" title="" class="js-smart-img">
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <br>

    <div class="pl">
        <div class="soccer_pl">
            <ul><li><a href="plnfo.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plnfo.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plnew.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plnew.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="pllut.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/pllut.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plliv.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plliv.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plmci.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plmci.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plmun.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plmun.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plbur.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plbur.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plbou.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plbou.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plbha.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plbha.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plbre.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plbre.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
        </div>
        <div class="soccer_pl">
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plshu.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plshu.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plars.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plars.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plavl.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plavl.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="pleve.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/pleve.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plwol.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plwol.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plwhu.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plwhu.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plche.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plche.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
           <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="pltot.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/pltot.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plcry.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plcry.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
            <!-- 다른 카테고리 항목들... -->
            <ul><li><a href="plful.php">
                        <div class="selectlbtn">
                            <img src="./img/leauge/plful.png" title="" class="js-smart-img">
                        </div>
            </a></li></ul>
        </div>
    </div>

    <main class="main_wrapper">
        <div class="recommend_main_wrapper">
            <div class="recommend_main_header">
                <span class="recomend_main_title">상품 정렬</span>
                <div class="sort_nav_wrapper">
                    <?php
                    $btn = $_REQUEST["btn"] ?? 1;
                    if ($btn == 1) {
                    ?>
                        <div id="select" class="sort_nav01"><span>NEW</span></div>
                    <?php
                    } else {
                    ?>
                        <div class="sort_nav01"><span>NEW</span></div>
                    <?php
                    }
                    if ($btn == 2) {
                    ?>
                        <div id="select" class="sort_nav02"><span>가나다</span></div>
                    <?php
                    } else {
                    ?>
                        <div class="sort_nav02"><span>가나다</span></div>
                    <?php
                    }
                    if ($btn == 3) {
                    ?>
                        <div id="select" class="sort_nav03"><span>높은가격</span></div>
                    <?php
                    } else {
                    ?>
                        <div class="sort_nav03"><span>높은가격</span></div>
                    <?php
                    }
                    if ($btn == 4) {
                    ?>
                        <div id="select" class="sort_nav04"><span>낮은가격</span></div>
                    <?php
                    } else {
                    ?>
                        <div class="sort_nav04"><span>낮은가격</span></div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <script>
                const SortNew = document.querySelector('.sort_nav01'); //최신순 버튼
                const SortKor = document.querySelector('.sort_nav02'); //가나다순 버튼
                const SortHighPrice = document.querySelector('.sort_nav03'); //높은가격순 버튼
                const SortLowPrice = document.querySelector('.sort_nav04'); //낮은가격순 버튼

                //최신순으로 정렬
                SortNew.addEventListener('click', function() {
                    location.href = 'plful.php?sort=SUBSTRING(content_code,1,6)&dir=desc&btn=1'
                });
                //높은가격순으로 정렬
                SortHighPrice.addEventListener('click', function() {
                    location.href = 'plful.php?sort=content_price&dir=desc&btn=3'
                });
                //낮은가격순으로 정렬
                SortLowPrice.addEventListener('click', function() {
                    location.href = 'plful.php?sort=content_price&dir=asc&btn=4'
                });
                //가나다순으로 정렬
                SortKor.addEventListener('click', function() {
                    location.href = 'plful.php?sort=content_name&dir=asc&btn=2'
                });
            </script>
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
        <div class="view_more_wrapper">
        <!-- 페이지네이션 링크 생성 -->
        <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="plful.php?sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&btn=<?php echo $btn; ?>&page=<?php echo $i; ?>"
            <?php echo ($i == $page) ? 'class="active"' : ''; ?>>
            <?php echo $i; ?>
            </a>
        <?php endfor; ?>
        </div>
        </div>
    </main>

    <?php require_once("inc/fast_move.php"); ?>
    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="js/hot_issue.js"></script>
    <script src="js/member.js"></script>
    <script src="js/sort.js"></script>

</body>

</html>
