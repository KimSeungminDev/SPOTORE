<?php require_once("notice.import.php");

if (isset($_GET['num'])) {
    $num = $_GET['num'];

    // 해당 글 정보 가져오기
    $query = "SELECT * FROM notice WHERE num = ?";
    $param = array($num);
    $result = db_select($query, $param);
    if ($result && count($result) > 0) {
        $notice = $result[0];
        //조회수 증가 코드
        $updateQuery = "UPDATE notice SET hits = hits + 1 WHERE num = ?";
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
    <link rel="stylesheet" href="css/style.css">
    <style>
        .contents {
            margin-top: 20px;
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
            margin-bottom: 20px; /* 변경: 컨테이너와 다른 구성요소 간의 간격 조절 */
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
            margin-top: -5px; /* 변경: 버튼과 이전 컨테이너 간의 간격 조절 */
            
        }

        input[type="button"] {
            background-color: #004B58;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            flex: 1; /* 변경: 버튼을 동일한 너비로 설정 */
            margin-right: 10px; /* 변경: 버튼 간의 간격 조절 */
            
        }

        input[type="button"]:last-child {
            margin-right: 0;
        }

        input[type="button"]:hover {
            background-color: #c7efdf;
            color: black;
        }

        .title {
            font-size: 36px; /* 변경: 큰 폰트 사이즈 */
            font-weight: bold;
            color: black; /* 변경: 폰트 색상 */
            margin-bottom: 20px; /* 변경: 간격 조절 */
            text-align: center; /* 변경: 가운데 정렬 */
            text-transform: uppercase; /* 변경: 대문자로 변환 */
            letter-spacing: 2px; /* 변경: 글자 간격 조절 */
            background-color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            
        }
        .content-text-container {
            background-color: #f9f9f9; /* 변경: 배경색 추가 */
            padding: 15px; /* 변경: 내용과 테두리 간격 조절 */
            border: 1px solid #ddd; /* 변경: 테두리 추가 */
            border-radius: 8px; /* 변경: 모서리를 둥글게 */
            margin-bottom: 15px; /* 변경: 전체 간격 조절 */
            max-height: 200px; /* 변경: 최대 높이 지정 */
            overflow-y: auto; /* 변경: 스크롤 가능하도록 설정 */
        }

        .table_col {
            margin-bottom: 10px;
        }

        .content {
            white-space: pre-line;
        }
        
    </style>

    <title>공지사항</title>
</head>

<body id="manager_body">
    <main class="manager_wrapper home">
        <div class="main_menu_wrapper">

            <a href="manager_home.php">
                <div class="menu"> 홈 </div>
            </a>
            <a href="manager_notice.php">
                <div class="menu"style="background-color: #c7efdf;"> 공지사항 관리 </div>
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
                <!--11.20 코드추가 -->
                <a href="logout.php"><button class="logout"> logout </button></a>
                <!--여기까지 -->
            </header>
            <section class="contents">
            <div class="title"><?php echo $notice['title']; ?></div>
            <div class="content-container">
                <div class="table_col writer">글쓴이: <?php echo $notice['writer']; ?> </div>
                <div class="table_col date">조회수: <?php echo $notice['hits']; ?></div>
                <div class="table_col date">날짜: <?php echo $notice['regtime']; ?></div>
                <div class="content-text-container">
                <div class="table_col content"><?php echo $notice['content']; ?></div> <!-- 본문 -->
                </div>
            </div>
            <div class="button-container">
                <input type="button" value="수정" onclick="location.href='notice_update.php?num=<?=$num?>'">
                <input type="button" value="삭제" onclick="location.href='notice_delete.php?num=<?=$num?>'">
            </div>
        </section>
    </main>
</body>

</html>