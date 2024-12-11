<?php require_once("inquiry.import.php");

if (isset($_GET['num'])) {
    $num = $_GET['num'];

    // 해당 글 정보 가져오기
    $query = "SELECT * FROM inquiry WHERE num = ?";
    $param = array($num);
    $result = db_select($query, $param);

    if ($result && count($result) > 0) {
        $notice = $result[0];
        //조회수 증가 코드
        $updateQuery = "UPDATE inquiry SET hits = hits + 1 WHERE num = ?";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .notice-container {
            max-width: 1200px;
            margin: 50px auto;
            background-color: #f9f9f9;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .content-container {
            position: relative;
            min-height: 100px; /* 적절한 높이를 부여하세요. 필요에 따라 조절 가능 */
        }

        .back-button {
            position: relative;
            top: -40px;
            left: 1100px;
            padding: 10px 20px;
            background-color: #004B58;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            
        }

        .back-button:hover {
            background-color: #FD9F28;
        }

        .table_col {
            margin-bottom: 10px;
        }

        .content-text-container {
            margin-top: 10px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
                /* 댓글 스타일 */
                .response-container {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .response {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }
    </style>
    <title>SPOTORE</title>
</head>
<body>

<div class="notice-container">
    <div class="title">
        <span><?php echo $notice['title']; ?></span> 
    </div>
    <a href="my-page_inquiry.php" class="back-button">돌아가기</a>
    <div class="content-container">

        <!-- "돌아가기" 버튼 추가 -->
        

        <div class="table_col date">분류: <?php echo $notice['type']; ?></div>
        <div class="table_col writer">글쓴이: <?php echo $notice['writer']; ?> </div>
        <div class="table_col date">조회수: <?php echo $notice['hits']; ?></div>
        <div class="table_col date">날짜: <?php echo $notice['regtime']; ?></div>
        <div class="content-text-container">
            <div class="table_col content"><?php echo $notice['content']; ?></div>
        </div>
        <!-- 댓글 영역 -->
        <div class="response-container" id="responseContainer">
                        <?php
                        // 만약 응답이 존재한다면 출력
                        if (!empty($notice['response'])) {
                            echo '<div class="response">' . $notice['response'] . '</div>';
                        }
                        ?>
                    </div>
    </div>
</div>

</body>
</html>
