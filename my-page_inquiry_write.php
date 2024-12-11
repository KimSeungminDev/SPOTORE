<?php
require_once("pay.import.php");

// 사용자가 로그인한 경우에만 처리
if (!isset($_SESSION['member_id'])) {
    // 로그인되지 않은 경우 로그인 페이지로 리다이렉트 또는 처리
    header("Location: login.php");
    exit();
}

// 로그인한 사용자의 아이디 가져오기
$user_id = $_SESSION['member_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPOTORE</title>
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
                    <span class="title"> 문의 글 쓰기 </span>
                </section>

                <form action="my-page_inquiry_write_post.php" method="post">
                    <label for="title">제목:</label>
                    <input type="text" id="title" name="title">

                    <label for="writer">작성자:</label>
                    <input type="text" id="writer" name="writer" value="<?php echo $user_id; ?>" readonly>

                    <label for="type">분류:</label>
                    <select name="type" id="type">
                        <option value="교환">교환</option> 
                        <option value="반품">반품</option>
                    </select>

                    <label for="content">내용:</label>
                    <textarea id="content" name="content" rows="6" cols="50"></textarea>

                    <input type="submit" value="글 작성">
                </form>
            </section>
        </header>
    </main>
</body>

</html>
