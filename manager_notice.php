<?php require_once("notice.import.php");?>
<?php ini_set('display_errors', '0'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>관리자 페이지-공지사항 관리</title>
</head>

<body id="manager_body">
    <main class="manager_wrapper product">
        <div class="main_menu_wrapper">

            <a href="manager_home.php">
                <div class="menu" > 홈 </div>
            </a>
            <a href="manager_notice.php">
                <div class="menu" style="background-color:  #c7efdf;"> 공지사항 관리 </div>
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
                <a href="logout.php"><button class="logout"> logout </button></a>
            </header>
            <section class="contents">

                <section class="contents_header">
                    <div class="title_and_order">
                        <span class="title">공지사항 관리</span>
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
					<form method="POST">
                        <input type="text" class="search_product" name="search">
                        <!-- <a href="manager_notice.php?"><button class="regist"> 검색 </button></a> -->
                        <button type="submit" formaction="manager_notice.php?" class="regist">검색</button>
                        <button type="submit" formaction="notice_write.php" class="regist">글 등록</button>
                    </form>
                        <!-- <a href="notice_write.php"><button class="regist">글 등록 </button></a>  -->
                        <!-- <a href=""><button class="delete"> 삭제 </button></a> -->
						<?php $search = $_POST['search'];?>

                </section>
                <article class="scroller">
                    <form action="" method="INQUIRY">
                        <section class="board notice">
                            <div class="table_header">
                                <div class="table_col class">번호</div>
                                <div class="table_col title">제목</div>
                                <div class="table_col writer">글쓴이</div>
                                <div class="table_col views">조회수</div>
                                <div class="table_col date">날짜</div>
                            </div>
                            <!-- 페이지네이션 -->
                            
                            <?php foreach ($result as $r) { ?>
                                <?php
                                if(strpos($r['title'], $search) !== false){
                                    ?>
                            <a href="notice_view.php?num=<?php echo $r['num']; ?>">  
                            <div class="table_row">
                                <div class="table_col class"><?php echo $r['num']; ?></div>
                                <div class="table_col title"><?php echo $r['title']; ?></div>
                                <div class="table_col writer"><?php echo $r['writer']; ?></div>
                                <div class="table_col views"><?php echo $r['hits']; ?></div>
                                <div class="table_col date"><?php echo $r['regtime']; ?></div>
                            </div>
                            <?php };} ?>
                        </section>
                    </form>  
                </article>
            </section>
        </div>
    </main>
</body>

</html>