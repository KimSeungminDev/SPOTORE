<?php require_once("inc/db.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>관리자 페이지-홈</title>
    <style>
    /* style.css 파일에 추가 */
    .board {
  width: 980px;
  height: 408px;
  margin: 15px 0 0 55px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 10px 0;
  box-sizing: border-box;
  background: #ffffff;
}
    /* 보드 스타일링 */
</style>

</head>

<body id="manager_body">
    <main class="manager_wrapper home">
        <div class="main_menu_wrapper">

            <a href="manager_home.php">
                <div class="menu" style="background-color: #c7efdf;"> 홈 </div>
            </a>
            <a href="manager_notice.php">
                <div class="menu"> 공지사항 관리 </div>
            </a>
            <a href="manager_product.php">
                <div class="menu"> 상품 관리 </div>
            </a>
            <a href="manager_event.php">
                <div class="menu"> 이벤트 관리 </div>
            </a>
            <a href="manager_inquiry.php">
                <div class="menu"> 고객 문의 관리 </div>
            </a>
        </div>

        <div class="main_display">
            <header>
                <div class="login_info">
                    <span class="on_id"> 접속 아이디 : admin </span>
                    <span class="on_dep"> 부서 : 서버관리 팀 </span>
                </div>
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <a href="https://business.kakao.com/dashboard/"><button class="kakao"> SPOTORE 카카오톡 채널 관리</button></a>
                <a href="logout.php"><button class="logout"> logout </button></a>
            </header>
            <section class="contents">
                <section class="contents_header">
                    <div class="title_and_order">
                        <span class="title">SPOTORE 관리자 홈 - 판매내역</span>
                        <div class="order_wrapper"></div>
                    </div>
                </section>
                <article class="scroller">
                    <form action="" method="INQUIRY">
                        <section class="board notice">
                            <div class="table_header">
                                <div class="table_col date">회원 ID</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="table_col class">주문 번호</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="table_col writer">전화번호</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="table_col date">주문 상품</div>&nbsp;
                                <div class="table_col date">주문 수량</div>
                            </div>
                            <?php
                            $result = db_select("SELECT * FROM pay ORDER BY order_id DESC");

                            foreach ($result as $r) {
                                $jsonData = $r['order_contents'];
// JSON을 PHP 배열로 변환
$dataArray = json_decode($jsonData, true);

// 필요한 데이터 추출
if (!empty($dataArray)) {
    $contentCode = $dataArray[0]['content_code'];
    $contentAmount = $dataArray[0]['content_amount'];
}
                                ?>
                                <div class="table_row">
                                    <div class="table_col date"><?php echo $r['member_id']; ?></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="table_col class"><?php echo $r['order_id']; ?></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="table_col writer"><?php echo $r['Recipient_phone']; ?></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="table_col date"><?php echo "{$contentCode}"; ?></div>&nbsp;
                                    <div class="table_col date"><?php echo "{$contentAmount}"; ?></div>
                                </div>
                            <?php } ?>
                        </section>
                    </form>
                </article>
            </section>
        </div>
    </main>
</body>

</html>
