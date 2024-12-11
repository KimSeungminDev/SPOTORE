<?php require_once("inc/db.php");?>
<?php ini_set('display_errors', '0'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
    .contents_header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .event_control {
        display: flex;
        align-items: center;
    }

    .title {
        font-size: 24px;
        font-weight: bold;
        margin-right: 20px;
    }

    .event_co_wrapper {
        display: flex;
        margin-right: 20px;
    }

    .event_co_one,
    .event_co_two {
        display: flex;
        margin-right: 20px;
    }

    .event_co_one div,
    .event_co_two div {
        padding: 8px;
        cursor: pointer;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 5px;
    }

    .event_co_one div:hover,
    .event_co_two div:hover {
        background-color: #f4f4f4;
    }

    .event_registration,
    .event_check {
        cursor: pointer;
    }

    .search_event {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 10px;
    }

    .regist_event,
    .delete_event {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-top: -5px;
    }

    .regist_event:hover,
    .delete_event:hover {
        background-color: #2980b9;
    }

    .table_header {
        display: flex;
        background-color: #3498db;
        color: white;
        font-weight: bold;
        padding: 12px;
        font-size: 18px;
    }

    .table_row {
        display: flex;
        border-bottom: 1px solid #ddd;
        padding: 16px;
        transition: background-color 0.3s;
    }

    .table_row:hover {
        background-color: #f4f4f4;
    }

    .table_col {
        flex: 1;
        padding: 16px;
        font:32px;
    }
    
    .table_col.class {
        flex: 0.5;
        font-size: 12px;
    }
    .table_col.title {
        font-size: 12px;
        
    }
    .table_col.writer {
        font-size: 12px;
        
    }

    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        color: #3498db;
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin: 0 4px;
        cursor: pointer;
    }

    .pagination a:hover {
        background-color: #f4f4f4;
    }

    .pagination .active {
        background-color: #3498db;
        color: white;
    }
</style>

    <title>SPOTORE</title>
</head>

</head>
<body>
<?php require_once("inc/header.php"); ?>

        <div class="main_display">
            <header>
            </header>
            <section class="contents">

                <section class="contents_header">
                    <div class="title_and_order">
                    <a href="event.php"><span class="title">이벤트</span></a>
                    </div>
					<form method="POST">
                        <input type="text" class="search_event" name="search">
                        <a href="event_search.php?"><button class="regist_event"> 검색 </button></a>
						</form>
						<?php $search = $_POST['search'];?>

                </section>
                    <form action="" method="INQUIRY">
                        <section class="board event">
                            <div class="table_header">
                                <div class="table_col class">카테고리</div>
                                <div class="table_col title">제목</div>
                                <div class="table_col writer">글쓴이</div>
                                <div class="table_col views">조회수</div>
                                <div class="table_col date">날짜</div>
                            </div>
                            <!-- 페이지네이션 -->
                            <?php
                            $page = $_GET["page"] ?? 1; 
                            $listSize = 5;
                            $start = ($page - 1) * $listSize;

                            $db = new PDO("mysql:host=localhost;port=3306;dbname=spotore_php", "root", "mariadb");
                            $stmt = $db->prepare("SELECT * FROM event ORDER BY num DESC LIMIT :start, :listSize");
                            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
                            $stmt->bindParam(':listSize', $listSize, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <!-- 페이지네이션 여기까지 -->
                            <?php foreach ($result as $r) { ?>
                                <?php
                                if(strpos($r['title'], $search) !== false){
                                    ?>
                            <a href="event_index_view.php?num=<?php echo $r['num']; ?>">  
                            <div class="table_row">
                                <div class="table_col class"><?php echo $r['category']; ?></div>
                                <div class="table_col title"><?php echo $r['title']; ?></div>
                                <div class="table_col writer"><?php echo $r['writer']; ?></div>
                                <div class="table_col views"><?php echo $r['hits']; ?></div>
                                <div class="table_col date"><?php echo $r['regtime']; ?></div>
                            </div>
                            <?php }} ?>
                        </section>
                          <!-- 페이지네이션 -->  
                          <br>          
                        <div style="width: 680px; text-align: center;">
                            <?php
                            $paginationSize = 3;
                            $firstLink = floor(($page - 1) / $paginationSize) * $paginationSize + 1;
                            $lastLink = $firstLink + $paginationSize - 1;
                            $numRecords = $db->query("SELECT COUNT(*) FROM event")->fetchColumn();
                            $numPages = ceil($numRecords / $listSize);

                            if ($lastLink > $numPages) {
                                $lastLink = $numPages;
                            }

                            if ($firstLink > 1) {
                                $link = $firstLink - 1;
                                echo "<a href='event.php?page=$link'>&lt 이전</a> ";
                            }

                            for ($i = $firstLink; $i <= $lastLink; $i++) {
                                $underline = ($i == $page) ? "text-decoration:underline" : "";
                                echo "<a href='event.php?page=$i' style='$underline'>$i</a> ";
                            }

                            if ($lastLink < $numPages) {
                                $link = $lastLink + 1;
                                echo "<a href='event.php?page=$link'>다음 &gt</a>";
                            }
                            ?>
                    </form>  
            </section>
        </div>
    </main>
    <?php require_once("inc/fast_move.php"); ?>
    <?php require_once("inc/footer.php"); ?>
</body>

</html>