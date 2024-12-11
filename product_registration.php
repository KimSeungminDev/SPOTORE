<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>관리자 페이지-공지사항</title>
</head>

<body id="manager_body">
    <main class="manager_wrapper registration">
        <div class="main_menu_wrapper">
            <a href="manager_home.php">
                <div class="menu"> 홈 </div>
            </a>
            <a href="manager_notice.php">
                <div class="menu"> 공지사항 관리 </div>
            </a>
            <a href="manager_product.php">
                <div class="menu" style="background-color:  rgb(74 173 255);"> 상품 관리 </div>
            </a>
            <a href="manager_event.php">
                <div class="menu"> 이벤트 관리 </div>
            </a>
            <a href="manager_inquiry.php">
                <div class="menu"> 고객 문의 관리 </div>
            </a>
        </div>

        <div class="main_registration">
            <header>
                <div class="title_and_registration">
                    <span class="title">상품 등록</span>
                </div>
            </header>
            <section class="contents">
                
                <article class="scroller">
                    <form action="contents_insert.php" method="POST">
                        <section class="board product">
                            <div class="point_img">
                                <div class="img_insert_header">
                                    <div class="point_title"> 대표 이미지 </div>
                                </div>
                                <section class="img_thumbnail">
                                    <input class="input_css" name="content_img" type="text" placeholder="썸네일에 들어갈 이미지주소를 입력해주세요." value="img/contents/content1.jpg"/>
                                </section>
                                <div class="img_insert_header">
                                    <div class="point_title"> 추가 이미지 </div>
                                </div>
                                <section class="img_more">
                                    <input class="input_css" type="text" name="content_img1" placeholder="추가할 이미지 1">
                                    <input class="input_css" type="text" name="content_img2" placeholder="추가할 이미지 2">
                                    <input class="input_css" type="text" name="content_img3" placeholder="추가할 이미지 3">
                                    <input class="input_css" type="text" name="content_img4" placeholder="추가할 이미지 4">
                                </section>
                                <div class="img_insert_header">
                                    <div class="point_title"> 상품 정보 </div>
                                </div>
                                <div class="product_detail">
                                    <div class="product_board_three">
                                        <div class="product_code"> 상품코드 : <input type="text" name="product_code" class="text_product_code"></div>
                                        <div class="product_name"> 상품명 : <input type="text" name="product_name" class="text_product_name"></div>
                                        <div class="product_cost"> 상품 원가 : <input type="text" name="content_cost" class="text_product_cost">원</div>
                                        <div class="product_price"> 상품 가격 : <input type="text" name="product_price" class="text_product_price">원</div>
                                    </div>
                                    <div class="product_board_two">
                                        <div class="product_category"> 
                                            상품 대분류 :
                                            <select name="category_large" >
                                                <option value="no_select"> 선택해주세요. </option>
                                                <option name="soccer" value="soccer"> 축구 </option>
                                                <option name="base" value="base"> 야구 </option>
                                                <option name="basket" value="basket"> 농구 </option>
                                                <option name="valley" value="valley"> 배구 </option>
                                                <option name="nfl" value="nfl"> 미식축구 </option>
                                                <option name="nhl" value="nhl"> 하키 </option>
                                                <option name="ufc" value="ufc"> UFC </option>
                                                <option name="esports" value="esports">E스포츠 </option>
                                                <option name="goods" value="goods"> 굿즈 </option>
                                            </select>
                                        </div>
                                        <div class="product_category"> 
                                            상품 소분류 :
                                            <select id="category_small" name="category_small">
                                                <option value="no_select"> 선택해주세요. </option>
                                                <option name="pl" value="pl"> 프리미어리그 </option>
                                                <option name="la" value="la"> 라리가 </option>
                                                <option name="bundes" value="bundes"> 분데스리가 </option>
                                                <option name="seria" value="seria"> 세리에 </option>
                                                <option name="natsoccer" value="natsoccer"> 국대 축구 </option>
                                                <option name="kbo" value="kbo"> KBO </option>
                                                <option name="mlb" value="mlb"> mlb </option>
                                                <option name="natbase" value="natbase"> 국대 야구 </option>
                                                <option name="kbl" value="kbl"> KBL </option>
                                                <option name="nba" value="nba"> NBA </option>
                                                <option name="natbasket" value="natbasker"> 국대 농구 </option>
                                                <option name="vleauge" value="vleauge"> V-리그 </option>
                                                <option name="natvally" value="natvally"> 국대 배구 </option>
                                            </select>
                                        </div>
                                        <div class="product_discount_rate"> 할인율 : <input type="text" name="product_discount_rate"class="text_product_discount" /> %</div>
                                        <div class="is_deliv_today"> 오늘배송 :
                                            <select name="is_deliv_today" class = "deliv_today_choice">
                                                <option> N </option>
                                                <option> Y </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="img_insert_header">
                                    <div class="point_title"> 상품 색상 등록 </div>
                                </div>
                                
                                <div class="pro_sign_up_colors">
                                    <input class="input_color_css content_color1" type="color" name="content_color1" value="#fffff">
                                    <input class="input_color_css" type="color" name="content_color2">
                                    <input class="input_color_css" type="color" name="content_color3">
                                    <input class="input_color_css" type="color" name="content_color4">
                                </div>
                                
                                    
                                <div class="submit_wrapper">
                                    <label class="input-submit-button" for="input-submit">
                                            확인
                                    </label>
                                    <input type="submit" id="input-submit" style="display: none;">
                                </div>
                            </div>
                        </section>
                    </section>
                    </form>
                    
                </article>
            </section>
            
        </div>
    </main>

    <script src="js/app.js"></script>
</body>

</html>