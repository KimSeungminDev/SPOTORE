<?php require_once("event.import.php");

if (isset($_GET['num'])) {
    $num = $_GET['num'];

    // 해당 글 정보 가져오기
    $query = "SELECT * FROM event WHERE num = ?";
    $param = array($num);
    $result = db_select($query, $param);

    if ($result && count($result) > 0) {
        $notice = $result[0];
        //조회수 증가 코드
        $updateQuery = "UPDATE event SET hits = hits + 1 WHERE num = ?";
        $updateParam = array($num);
        db_update_delete($updateQuery, $updateParam);
    } else {
        // 해당 번호의 글이 없을 경우 처리
        echo "해당하는 글을 찾을 수 없습니다.";
        exit;
    }
} else {
    // num 값이 없을 경우 처리
    echo "잘못된 접근입니다.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .main_display {
            max-width: 1000px; /* 최대 너비를 조절 */
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
            padding: 20px;
        }

        header {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: right;
        }

        .logout {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .logout:hover {
            background-color: #c0392b;
        }

        .contents {
            margin-top: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .content-container {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .table_col {
            margin-bottom: 10px;
            color: #333;
        }

        .content-text-container {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            max-height: 300px; /* 높이를 늘림 */
            overflow-y: auto;
        }

        .content {
            white-space: pre-line;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }
    </style>

    <title>공지사항</title>
</head>

<body>
        <div class="main_display">
            <header>

                <!--11.20 코드추가 -->
                <a href="event.php"><button class="logout"> 글 목록 </button></a>
                <!--여기까지 -->
            </header>
            <section class="contents">
                <span class="title"><?php echo $notice['title']; ?></span>
                <div class="content-container">
                <div class="table_col date">카테고리: <?php echo $notice['category']; ?></div>
                <div class="table_col writer">글쓴이: <?php echo $notice['writer']; ?> </div>
                <div class="table_col date">조회수: <?php echo $notice['hits']; ?></div>
                <div class="table_col date">날짜: <?php echo $notice['regtime']; ?></div>
                <div class="content-text-container">
                <div class="table_col content"> <?php echo $notice['content']; ?></div> <!-- 본문 -->
                </div>
            </section>
        </div>
    </main>
</body>

</html>