<?php
// inquiry.import.php 파일은 미포함이므로, 필요하면 해당 내용을 적절히 추가하세요.
require_once("inquiry.import.php");

// num 값이 없으면 잘못된 접근으로 간주
if (!isset($_GET['num'])) {
    echo "잘못된 접근입니다.";
    exit;
}

$num = $_GET['num'];

// 해당 글 정보 가져오기
$query = "SELECT * FROM inquiry WHERE num = ?";
$param = array($num);
$result = db_select($query, $param);

if (!$result || count($result) === 0) {
    // 해당 번호의 글이 없을 경우 처리
    echo "해당하는 글을 찾을 수 없습니다.";
    exit;
}

$notice = $result[0];

// 조회수 증가 코드
$updateQuery = "UPDATE inquiry SET hits = hits + 1 WHERE num = ?";
$updateParam = array($num);
db_update_delete($updateQuery, $updateParam);

// 이 부분은 관리자가 사용자에게 응답하는 부분입니다.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['response'])) {
        $responseContent = $_POST['response'];

        // 응답 내용을 DB에 저장하거나 다른 처리를 수행할 수 있습니다.
        // 예시로 inquiry 테이블에 response 컬럼이 있다고 가정하고 UPDATE 쿼리를 사용합니다.
        $updateResponseQuery = "UPDATE inquiry SET response = ? WHERE num = ?";
        $updateResponseParam = array($responseContent, $num);
        db_update_delete($updateResponseQuery, $updateResponseParam);

        // 성공적으로 응답을 저장했다면 JavaScript로 알림을 띄우고 응답 내용을 추가합니다.
        echo "<script>";
        echo "alert('응답이 성공적으로 저장되었습니다.');";
        echo "document.getElementById('responseContainer').innerHTML = '<div class=\"response\">' + '관리자 응답: ' + '$responseContent' + '</div>';";
        echo "</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* 기존 CSS 코드 */
        .contents {
            margin-top: -10px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .table_col {
            margin-bottom: 10px;
        }

        .content-container {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow-y: scroll;
        }

        .content {
            white-space: pre-line;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: -5px;
        }

        input[type="button"] {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            flex: 1;
            margin-right: 10px;
        }

        input[type="button"]:last-child {
            margin-right: 0;
        }

        input[type="button"]:hover {
            background-color: #2980b9;
        }

        .title {
            font-size: 36px;
            font-weight: bold;
            color: black;
            margin-bottom: 20px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            background-color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
        }

        .content-text-container {
            background-color: #f9f9f9;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            max-height: 200px;
            overflow-y: auto;
        }

        .table_col {
            margin-bottom: 10px;
        }

        .content {
            white-space: pre-line;
        }

        /* 응답 입력 폼 스타일 */
        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        textarea {
            width: 100%;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #004B58;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #FD9F28;
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

    <title>공지사항</title>
</head>

<body id="manager_body">
    <main class="manager_wrapper home">
        <div class="main_menu_wrapper">
            <a href="manager_notice.php">
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
                <div class="menu" style="background-color: #c7efdf;"> 고객 문의 관리 </div>
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
                <span class="title"><?php echo $notice['title']; ?></span>
                <div class="content-container">
                    <div class="table_col date">분류: <?php echo $notice['type']; ?></div>
                    <div class="table_col writer">글쓴이: <?php echo $notice['writer']; ?> </div>
                    <div class="table_col date">조회수: <?php echo $notice['hits']; ?></div>
                    <div class="table_col date">날짜: <?php echo $notice['regtime']; ?></div>
                    <div class="content-text-container">
                        <div class="table_col content"><?php echo $notice['content']; ?></div>
                    </div>
                        <!-- 댓글 영역 -->
                        <div class="response-container" id="responseContainer" >
                        <?php
                        // 만약 응답이 존재한다면 출력
                        if (!empty($notice['response'])) {
                            echo '<div class="response">' . $notice['response'] . '</div>';
                        }
                        ?>
                    </div>

                    <!-- 관리자 응답을 입력할 폼 추가 -->
                    <form method="post" action="">
                        <label for="response">답변쓰기:</label>
                        <div><br></div>
                        <textarea name="response" id="response" rows="4" cols="50"></textarea>
                        <input type="submit" value="답변 저장">
                    </form>


                </div>
            </section>
        </div>
    </main>
</body>
</html>
