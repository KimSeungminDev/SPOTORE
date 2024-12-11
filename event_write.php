<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>이벤트 글 작성</title>
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
    overflow-y: auto;  /* Add this line to enable vertical scrollbar */
    max-height: 70vh;  /* Set a max height for the container */
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
                    <span class="title"> 이벤트 글 쓰기 </span>
                </section>

                <form action="event_write_post.php" method="post">
                    <label for="title">제목:</label>
                    <input type="text" id="title" name="title">

                    <label for="writer">작성자:</label>
                    <input type="text" id="writer" name="writer">

                    <label for="imglink">사진 링크:</label>
                    <input type="text" id="imglink" name="imglink">

                    <label for="pagelink">페이지 링크:</label>
                    <input type="text" id="pagelink" name="pagelink">

                    <label for="type">분류:</label>
                    <select name="category" id="category">
                        <option value="참여">참여</option> 
                        <option value="세일">세일</option>
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
