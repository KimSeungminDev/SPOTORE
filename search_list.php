<?php
require_once("inc/db.php");

// 세션 시작
session_start();

// 페이지네이션 관련 변수
$itemsPerPage = 20;
$page = $_GET["page"] ?? 1;
$start = ($page - 1) * $itemsPerPage;

// 정렬 매개변수
$sort = $_REQUEST["sort"] ?? "SUBSTRING(content_code,1,6)";
$dir = $_REQUEST["dir"] ?? "desc";
$btn = $_REQUEST["btn"] ?? "1";
$orderPhrase = " ORDER BY $sort $dir";

// 검색어가 입력되었다면 세션에 저장
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $_SESSION['searchTerm'] = $searchTerm;
} elseif (isset($_SESSION['searchTerm'])) {
    $searchTerm = $_SESSION['searchTerm'];
}

// 만약 검색어가 입력되었다면
if(isset($searchTerm)) {
    // 데이터베이스에서 항목 가져오기
    $result = db_select("SELECT * FROM contents WHERE content_name LIKE '%" . $searchTerm . "%'" . $orderPhrase . " LIMIT $start, $itemsPerPage");

    // 페이지 링크를 만들기 위한 전체 항목 개수 계산
    $totalItems = db_select("SELECT COUNT(*) as count FROM contents WHERE content_name LIKE '%" . $searchTerm . "%'")[0]['count'];
} else {
    // 검색어가 없는 경우 전체 항목 가져오기
    $result = db_select("SELECT * FROM contents" . $orderPhrase . " LIMIT $start, $itemsPerPage");

    // 페이지 링크를 만들기 위한 전체 항목 개수 계산
    $totalItems = db_select("SELECT COUNT(*) as count FROM contents")[0]['count'];
}

// 전체 페이지 수 계산
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

    <style>
/* 스타일링 */
#populertextindex{
    /* color: #FD9F28;
    background-color: #004B58; */
    font-size: 16px;
    font-family: var(--jua-font);
}
#popularSearchList {
    display: flex;
    gap: 10px; /* 각 아이템 사이의 간격 조절 */
    padding: 0;
    list-style: none;
}

.popularSearchItem {
    display: inline-block; /* 인라인 요소를 블록 요소로 변환하여 상자로 감싸기 */
    padding: 10px; /* 선택적으로 안쪽 여백 추가 */
    border: 1px solid #FD9F28; /* 선택적으로 테두리 추가 */
    text-decoration: none; /* 링크의 기본 텍스트 장식 제거 */
    color: #333; /* 링크의 색상 설정 */
    font-family: var(--black-han-font);
}

    </style>

    <script>
        // 페이지가 로드될 때 실행되는 함수
        document.addEventListener("DOMContentLoaded", function() {
            // 인기 검색어 목록을 가져와서 표시
            displayPopularSearchTerms();
        });

        function displayPopularSearchTerms() {
    var popularSearchList = document.getElementById("popularSearchList");

    // 각 검색어에 대한 링크를 생성하여 추가
    var popularSearchTerms = ["토트넘", "파리", "T1", "골든스테이트", "대한민국"];
    for (var i = 0; i < popularSearchTerms.length; i++) {
        var searchTerm = popularSearchTerms[i];
        var link = document.createElement("a");

        // 링크 속성 설정
        link.href = "search_list.php?search=" + encodeURIComponent(searchTerm);
        link.textContent = searchTerm;
        
        // 클래스 추가
        link.classList.add("popularSearchItem");

        // 링크를 popularSearchList에 추가
        popularSearchList.appendChild(link);
    }
}
    </script>

<body>
    <!--    <div class="adv_main">상 단 광 고</div>   -->
    <?php require_once("inc/header.php"); ?>
    <div><br></div>
    <div><br></div>
    <div><br></div>
    <div><br></div>
    <div><br></div>
    <div class="picked_category">
        <span class="category_index">입력된 검색어 : <?=$searchTerm?></span>
    </div>
    <div><br></div>
    <div><br></div>
    <div><br></div>
    <div><br></div>
    <div><br></div>

    <div id="populertextindex">SPOTORE 인기 검색어</div>
        <div><br></div>
    <div id="popularSearchList"></div>

    <div><br></div>
    <div><br></div>
    <div><br></div>
    <div><br></div>
    <div><br></div>
    <!-- <div class="large_top_image">
        <ul><img src="img/검색결과.png"></ul>
    </div> -->

    <main class="main_wrapper">
        
        <div class="recommend_main_wrapper">
            <div class="recommend_main_header">
                <span class="recomend_main_title"><?=$searchTerm?> 키워드로 검색된 상품</span>
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
                    location.href = 'search_list.php?sort=SUBSTRING(content_code,1,6)&dir=desc&btn=1'
                });
                //가나다순으로 정렬
                SortKor.addEventListener('click', function() {
                    location.href = 'search_list.php?sort=content_name&dir=asc&btn=2'
                });
                //높은가격순으로 정렬
                SortHighPrice.addEventListener('click', function() {
                    location.href = 'search_list.php?sort=content_price&dir=desc&btn=3'
                });
                //낮은가격순으로 정렬
                SortLowPrice.addEventListener('click', function() {
                    location.href = 'search_list.php?sort=content_price&dir=asc&btn=4'
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
            <a href="search_list.php?sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&btn=<?php echo $btn; ?>&page=<?php echo $i; ?>"
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