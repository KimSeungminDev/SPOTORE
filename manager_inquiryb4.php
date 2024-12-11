<?php require_once("inquiry.import.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>

        </style>
    <title>관리자 페이지-고객 문의</title>
</head>

<body id="manager_body">
    <main class="manager_wrapper notice">
        <div class="main_menu_wrapper">
            <a href="manager_home.php">
                <div class="menu"> 홈 </div>
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
                <div class="menu" style="background-color: rgb(74 173 255);"> 고객 문의 관리 </div>
            </a>
        </div>

        <div class="main_display">
            <header>
                <div class="login_info">
                    <span class="on_id"> 접속 아이디 : admin </span>
                    <span class="on_dep"> 부서 : 서버관리 팀 </span>
                </div>
                <a href="index.php"><button class="logout"> logout </button></a>
            </header>
            <section class="contents">
                <section class="contents_header">
                <div class="title_and_order">
                        <span class="title">이벤트 관리</span>
                        <div class="order_wrapper">
                            <div class="order_one">
                                <div class="registration"> 등록순 </div>
                                <div class="check"> 조회순 </div>
                            </div>
                            <div class="order_two">
                                <div class="ascending_order"> 오름차순 </div>
                                <div class="descending_order"> 내림차순 </div>
                            </div>
                        </div>
                    </div>
                    <a href="inquiry_search.php"><button class="regist_event"> 검색 </button></a>
                </section>
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
                            <!-- 1.페이지네이션 -->
                            <?php
                            $page = $_GET["page"] ?? 1; 
                            $listSize = 7;
                            $start = ($page - 1) * $listSize;
                            $db = new PDO("mysql:host=localhost;port=3306;dbname=spotore_php", "root", "mariadb");
                            $stmt = $db->prepare("SELECT * FROM inquiry ORDER BY num DESC LIMIT :start, :listSize");
                            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
                            $stmt->bindParam(':listSize', $listSize, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <!-- 페이지네이션 여기까지 -->
                            <?php foreach ($result as $r) { ?>
                                <a href="inquiry_view.php?num=<?php echo $r['num']; ?>">
                                    <div class="table_row">
                                        <div class="table_col class"><?php echo $r['type']; ?></div>
                                        <div class="table_col title"><?php echo $r['title']; ?></div>
                                        <div class="table_col writer"><?php echo $r['writer']; ?></div>
                                        <div class="table_col views"><?php echo $r['hits']; ?></div>
                                        <div class="table_col date"><?php echo $r['regtime']; ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </section> 

                        <!-- 2.페이지네이션 -->
                        <br>

                        <div style="width: 680px; text-align: center;">
                            <?php
                            $paginationSize = 3;
                            $firstLink = floor(($page - 1) / $paginationSize) * $paginationSize + 1;
                            $lastLink = $firstLink + $paginationSize - 1;
                            $numRecords = $db->query("SELECT COUNT(*) FROM inquiry")->fetchColumn();
                            $numPages = ceil($numRecords / $listSize);

                            if ($lastLink > $numPages) {
                                $lastLink = $numPages;
                            }

                            if ($firstLink > 1) {
                                $link = $firstLink - 1;
                                echo "<a href='manager_inquiry.php?page=$link'>&lt 이전</a> ";
                            }

                            for ($i = $firstLink; $i <= $lastLink; $i++) {
                                $underline = ($i == $page) ? "text-decoration:underline" : "";
                                echo "<a href='manager_inquiry.php?page=$i' style='$underline'>$i</a> ";
                            }

                            if ($lastLink < $numPages) {
                                $link = $lastLink + 1;
                                echo "<a href='manager_inquiry.php?page=$link'>다음 &gt</a>";
                            }
                            ?>
                            <!-- 페이지네이션 여기까지 -->
                        </div>
                    </form>
                </article>
            </section>
        </div>
    </main>
</body>

</html>
