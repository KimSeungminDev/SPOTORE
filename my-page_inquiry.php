<?php require_once("inc/session.php");

// 로그인 세션을 통해 사용자 아이디 가져오기
$user_id = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : null;

if (!$user_id) {
    // 로그인되지 않은 경우에 대한 처리 (예를 들면 로그인 페이지로 리다이렉트)
    header("Location: login.php");
    exit();
}

require_once("inc/db.php");
// 사용자가 작성한 글들 가져오기
$result = db_select("SELECT * FROM inquiry WHERE writer = ?", array($user_id));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* 글 목록 스타일 */
        .board {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table_header {
            background-color: #ced4da;
            display: flex;
            justify-content: space-between;
            padding: 12px;
            font-weight: bold;
        }

        .table_col {
            flex: 1;
            text-align: center;
            padding: 8px;
            border: 1px solid #dee2e6;
            box-sizing: border-box;
        }

        .table_col.class {
            flex-basis: 10%;
        }

        .table_col.title {
            flex-basis: 40%;
        }

        .table_col.writer {
            flex-basis: 15%;
        }

        .table_col.views,
        .table_col.date {
            flex-basis: 10%;
        }

        .table_row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f9fa;
            margin-top: 4px;
            border: 1px solid #dee2e6;
            box-sizing: border-box;
            transition: background-color 0.3s;
        }

        .table_row:hover {
            background-color: #e9ecef;
        }

        /* 페이지네이션 스타일 */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #007bff;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            margin: 0 4px;
            border: 1px solid #007bff;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: white;
        }

        .pagination a.active {
            background-color: #0056b3;
            color: white;
        }

        /* 글 작성 버튼 스타일 */
        .write-button {
            background-color: #FD9F28;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid gray;
            border-radius: 4px;
            transition: background-color .3s;
            position: relative;
            bottom: -230px;
            left: 810px;

        }

        .write-button:hover {
            background-color: #004B58;
        }
    </style>

    <title>SPOTORE</title>
</head>

<body>
<div class="adv_main">
        <img class = "ad_img" src="img/ad_img.png" alt="광고 이미지">
    </div>
    <?php require_once("inc/header.php"); ?>

    <main class="main_wrapper my-page">
        <section class="menus">
            <div class="my-page_title"><span>MY PAGE</span></div>
            <ul class="navs">
                <a href="my-page_member_pwd.php"><li class="nav" style="width: 165px;"><span>회원정보 수정</span></li></a>
                <a href="my-page_order.php"><li class="nav" style="width: 165px;"><span>주문배송</span></li></a>
                <li class="nav"><span>쿠폰/적립금</span></li>
                <a href="my-page_inquiry.php"><li class="nav" style="background-color: #FD9F28; width: 165px;"><span>교환/반품</span></li></a>
                <li class="nav"><span>좋아요</span></li>
                <li class="nav"><span>최근 본 상품</span></li>
                <a href="my-page_delete_member.php"><li class="nav" style="width: 165px;"><span>회원탈퇴</span></li></a>
            </ul>
        </section>
        <section class="view">
            <form method="post" action="">
                <article class="scroller">
                    <form action="" method="GET">
                        <section class="board event">
                            <div class="table_header">
                                <div class="table_col class">분류</div>
                                <div class="table_col title">제목</div>
                                <div class="table_col writer">글쓴이</div>
                                <div class="table_col views">조회수</div>
                                <div class="table_col date">날짜</div>
                            </div>

                            <?php foreach ($result as $r) { ?>
                                <a href="my-page_inquiry_view.php?num=<?php echo $r['num']; ?>">
                                    <div class="table_row">
                                        <div class="table_col class"><?php echo $r['type']; ?></div>
                                        <div class="table_col title"><?php echo $r['title']; ?></div>
                                        <div class="table_col writer"><?php echo $r['writer']; ?></div>
                                        <div class="table_col views"><?php echo $r['hits']; ?></div>
                                        <div class="table_col date"><?php echo $r['regtime']; ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                            <a href="my-page_inquiry_write.php" class="write-button" style=>글 작성</a>
                        </section>
                        <br>
                        <div style="width: 680px; text-align: center;">
                        </div>
                    </form>
                </article>
            </form>
        </section>
    </main>

    <?php require_once("inc/fast_move.php"); ?>
    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js
