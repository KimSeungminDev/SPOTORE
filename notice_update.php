<?php require_once("notice.import.php");
// 폼이 제출되었는지 확인
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 입력 데이터를 필터링 및 유효성 검사
    $num = filter_input(INPUT_POST, 'num', FILTER_SANITIZE_NUMBER_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

    // 필수 필드가 모두 비어 있지 않은지 확인
    if (!empty($title) && !empty($num) && !empty($content)) {
        // 데이터베이스에서 이벤트를 업데이트하는 함수가 있다고 가정
        $query = "UPDATE notice SET title = ?, content = ? WHERE num = ?";
        $param = array($category, $content, $num);
        $result = db_update_delete($query, $param);

        if ($result) {
            // 성공적으로 업데이트된 경우 이벤트 관리 페이지로 리디렉션
            header("Location: manager_notice.php");
            exit;
        } else {
            echo "이벤트를 업데이트하는 중 오류가 발생했습니다.";
        }
    } else {
        echo "모든 필드가 필요합니다.";
    }
}

// 이벤트 ID에 해당하는 이벤트 세부 정보를 가져오는 함수가 있다고 가정
if (isset($_GET['num'])) {
    $num = $_GET['num'];

    // 이벤트 세부 정보를 가져옴
    $query = "SELECT * FROM notice WHERE num = ?";
    $param = array($num);
    $result = db_select($query, $param);

    if ($result && count($result) > 0) {
        $event = $result[0];
    } else {
        echo "해당 글을 찾을 수 없습니다.";
        exit;
    }
} else {
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
    <title>공지사항 글 수정</title>
    <style>
        body {
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .manager_wrapper {
            border: 2px solid #000000;
            padding: 50px; 
            max-width: 550px; 
            width: 100%; 
            box-sizing: border-box; 
        }

        .title {
            font-size: 28px; 
            font-weight: bold;
            margin-bottom: 20px; 
        }

        form {
            margin-top: 20px;
        }

        label,
        input,
        textarea,
        select {
            display: block;
            margin-bottom: 15px; 
        }

        input[type="text"],
        textarea,
        select {
            width: calc(100% - 20px); 
            padding: 10px; 
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 16px; 
        }

        input[type="submit"] {
            padding: 10px 24px; 
            border: none;
            border-radius: 5px;
            background-color: #004B58;
            color: #ffffff;
            cursor: pointer;
            font-size: 16px; 
        }

        input[type="submit"]:hover {
            background-color: #FD9F28;
        }
    </style>
</head>

<body id="manager_body">
    <main class="manager_wrapper notice">
        <header>
            <section class="contents">
                <section class="contents_header">
                    <span class="title"> 공지사항 글 수정 </span>
                </section>

                <form action="notice_update_post.php" method="post">
                    <!-- 이벤트 ID를 저장할 숨은 입력란 추가 -->
                    <input type="hidden" name="num" value="<?php echo $event['num']; ?>">
                    <label for="title">제목:</label>
                    <input type="text" id="title" name="title" value ="<?php echo $event['title']; ?>">
                    <label for="writer">작성자:</label>
                    <input type="text" id="writer" name="writer" value="<?php echo $event['writer']; ?>" readonly>
                    <!-- <label for="category">분류:</label> -->

                    <label for="content">내용:</label>
                    <textarea id="content" name="content" rows="6" cols="50"><?php echo $event['content']; ?></textarea>

                    <input type="submit" value="글 수정">
                </form>
            </section>
        </header>
    </main>
</body>

</html>
