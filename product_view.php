<?php
require_once("inc/db.php");

$content_code=$_REQUEST["content_code"];

$result = db_select("select * from contents where content_code= ?", array("$content_code"));

$review =db_select("select * from review where content_code= ? ", array("$content_code"));

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>상품 보기</title>
    <style>
         .contents {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product_container {
            display: flex;
            align-items: center;
            border: 1px solid #000000;
            padding: 10px;
            width: 100%;
            max-width: 90%; 
            height: 120%;
            background-color: #ffffff;
        }

        .product_image img {
            max-height: 350px;
            border: 1px solid black;
            border-radius: 5px; /* 둥근 테두리 적용 */
            padding: 5px; /* 여백 추가 */
        }

        .product_info {
        margin-left: calc(10% + 5px); /* 왼쪽으로 10% 이동한 후 5px 더 이동 */
        flex-grow: 0; /* 자동 확장 금지 */
        padding-left: 20px; /* 간격 추가 */
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    
    .product_info p {
        margin-bottom: 5px; /* 항목 간격 조정 */
        font-size: calc(22px); /* 기존 18px에 5px 더 추가 */
    }
    </style>
</head>

    <body id="manager_body">
        <main class="manager_wrapper home">
            <div class="main_menu_wrapper">

                <a href="manager_home.php">
                    <div class="menu"> 홈 </div>
                </a>
                <a href="manager_notice.php">
                    <div class="menu"> 공지사항 관리 </div>
                </a>
                <a href="manager_product.php">
                    <div class="menu" style="background-color: #c7efdf;"> 상품 관리 </div>
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
                <div class="product_container">
                    <div class="product_image">
                    <div class="main_img"><img src="<?php print_r($result[0]["content_img"])?>" alt="상품이미지"/></div>
                    </div>
                    <div class="product_info">
                        <div class="content_info">
                            <div>상품이름 : <?php print_r($result[0]["content_name"])?></div>
                            <div><br></div>
                            <div>오늘 배송 : <?php print_r($result[0]["deliv_today"]) ?></div>
                            <div><br></div>
                            <div>상품원가 : <?php print_r($result[0]["content_cost"])?></div>
                            <div><br></div>
                            <div>할인율 : <?php print_r($result[0]["discount_rate"])?>%</div>
                            <div><br></div>
                            <div>가격 : <?php print_r($result[0]["content_price"])?></div>                           
                        </div>
                        <div><br></div>
                        <div class="content_button">
                           <div>
                            <!-- <a href="product_delete.php?content_code=<?php echo $result[0]['content_code']; ?>">
                                <input type="button" value="삭제">
                            </a> -->
                            <a>
                            <input type="button" value="글 삭제" 
                                    onclick="location.href='product_delete.php?content_code=<?=$content_code?>'">
                            </a>
                           </div>                          
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </main>
</body>

</html>
