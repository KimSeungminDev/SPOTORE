<?php
require_once("inc/db.php");
require_once("inc/session.php"); 

$content_code=$_GET["content_code"];

$result = db_select("select * from contents where content_code= ?", array("$content_code"));

$review =db_select("select * from review where content_code= ? ", array("$content_code"));

$photo_review = db_select("select * from review where content_code= ? and photo IS NOT NULL ", array("content_code")); //사진이 있는 리뷰
$review_date =db_select("SELECT DATE_FORMAT(SUBSTRING(review_id, 1, 8), '%Y-%m-%d') AS formatted_date FROM review");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>SPOTORE</title>
</head>

<body>
    <div class="adv_main">
        <img class = "ad_img" src="img/ad_img.png" alt="광고 이미지">
    </div>
    <?php require_once("inc/header.php"); ?>

    <main class="main_wrapper contents_detail">
    <form class="top" action="cart_insert.php?content_code=<?php echo "$content_code"?>" name="contents_form" method="POST" onsubmit="return payNowCheckSelected();">
            <section class="top_left">
                <div class="category_info"><?php print_r($result[0]["category_large"])?> > <?php print_r($result[0]["category_small"])?></div>
                <div class="main_img"><img src="<?php print_r($result[0]["content_img"])?>" alt=""/></div>
                <div class="imgs">
                    <div class="img"><img src="<?php print_r($result[0]["content_img1"])?>" alt=""/></div>
                    <div class="img"><img src="<?php print_r($result[0]["content_img2"])?>" alt=""/></div>
                    <div class="img"><img src="<?php print_r($result[0]["content_img3"])?>" alt=""/></div>
                    <div class="img"><img src="<?php print_r($result[0]["content_img4"])?>" alt=""/></div>
                </div>
            </section>
            <section class="top_right">
                <div class="contents_infos">
                    <div class="delivery_today_mark_wrapper">
                        <?php if($result[0]["deliv_today"]==="Y"){ ?>
                            <i class="fas fa-bolt"></i>
                            <span>오늘 출발 상품</span>
                        <?php
                        }
                        ?>
                    </div>
                    <div><hr></div>
                    <div>
                        <span class="content_title"><?php print_r($result[0]["content_name"])?></span>
                    </div>
                    <div><hr></div>
                    <div class="row">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="review_count">상품 리뷰 +<?php echo (count($review)); ?>개</div>
                    </div>
                    <div class="row">
                        <span class="price_original">판매가 <?php print_r($result[0]["content_cost"])?></span>
                    </div>
                    <div class="row">
                        <span class="sale_percent"><?php print_r($result[0]["discount_rate"])?>%&nbsp;</span>
                        <span class="price_final"><?php echo $result[0]["content_price"]?></span>원
                    </div>
                </div>
                <div class="buttons choice">
                    <span class="choice_title">색상선택</span>
                    <div class="choice_color">
                        <div class="color" onclick="SelectOption()">
                            <input type="radio" name="color" value="<?php print_r($result[0]["content_color1"])?>" id="color1" style="background-color:<?php print_r($result[0]["content_color1"])?>">
                            <label for="color1"></label>
                        </div>
                    </div>
                </div>
                <div class="buttons choice">
                    <span class="choice_title">사이즈선택</span>
                    <div class="choice_size">
                        <div class="size" onclick="SelectOption()">
                            <input value="S" type="radio" name="size" id="sSize">
                            <label for="size1" class="size_name">S</label>
                        </div>
                        <div class="size" onclick="SelectOption()">
                            <input value="M" type="radio" name="size" id="mSize">
                            <label for="size2" class="size_name">M</label>
                        </div>
                        <div class="size" onclick="SelectOption()">
                            <input value="L" type="radio" name="size" id="lSize">
                            <label for="size3" class="size_name">L</label>
                        </div>
                        <div class="size" onclick="SelectOption()">
                            <input value="XL" type="radio" name="size" id="xlSize">
                            <label for="size4" class="size_name">XL</label>
                        </div>
                        <div class="size" onclick="SelectOption()">
                            <input value="2XL" type="radio" name="size" id="size1">
                            <label for="size5" class="size_name">2XL</label>
                        </div>
                    </div>
                </div>
                <div class="total_price_wrapper">
                    <span class="total_price_title">총 결제 금액 : </span>
                    <span class="total_price">0</span>원
                </div>
                <div class="insert_contents">
                    <?php $count=1;?>
                    <div class="content <?php echo "content".$count?>">
                        <?php $count++;?>
                        <input type="hidden" name="content_code" value=<?php echo"$content_code"?>>
                        <section class="option1">
                            <span class="color option1_color"></span>
                            <span>&nbsp; / &nbsp;</span>
                            <span class="size option1_size"></span>
                            <input type="hidden" name="content_options" value="none"/>
                        </section>
                        <section class="option2">
                            <input type="number" onchange="AmountChange()" name="option2_amount" min="1" class="amount" value="1">
                        </section>
                        <section class="option3">
                            <span class="option3_price"></span>
                            <span>원</span>
                        </section>
                        <section class="option4">
                            <button type="button" class="delete">X</button>
                        </section>
                    </div>
                </div>
                <div class="buttons purchase">
                    <!-- 버튼에 아이디와 클래스 추가 -->
<button id="purchaseButton" class="purchase" onclick="payNow()"><span>구매하기</span></button>
<button id="cartButton" class="cart" onclick="cart_insert()"><span>장바구니</span></button>
                    <!-- <button class="like"><span>찜</span></button> -->
                </div>
            </section>
        </form>

        <div id="detail_wrapper">
            <div class="detail_title"> 상품 이미지 </div> 
            <div><br></div>
            <div class="imgdiv">
                <div class="imglist"><img class="img" src="<?php print_r($result[0]["content_img"])?>" alt=""/></div>
                <div class="imglist"><img class="img" src="<?php print_r($result[0]["content_img1"])?>" alt=""/></div>
                <div class="imglist"><img class="img" src="<?php print_r($result[0]["content_img2"])?>" alt=""/></div>
                <div class="imglist"><img class="img" src="<?php print_r($result[0]["content_img3"])?>" alt=""/></div>
                <div class="imglist"><img class="img" src="<?php print_r($result[0]["content_img4"])?>" alt=""/></div>
            </div>            
        </div>

        <div id="detail_wrapper">
            <div class="detail_title"> 사이즈 가이드 </div> 
            <div><br></div>
            <div class="imgdiv">
                <div class="imglist"><img class="img" src="img/size.jpg" alt=""/></div>
            </div>            
        </div>

        <div id="detail_wrapper">
            <div class="detail_title"> 상품 결제 정보 </div> 
            <div><br></div>
            <div class="imgdiv">
                <div class="imglist"><img class="img" src="img/상품결제정보.png" alt=""/></div>
            </div>            
        </div>

        <div id="detail_wrapper">
            <div class="detail_title"> 배송 안내 </div> 
            <div><br></div>
            <div class="imgdiv">
                <div class="imglist"><img class="img" src="img/배송안내.png" alt=""/></div>
            </div>            
        </div>

        <div id="detail_wrapper">
            <div class="detail_title"> 교환 및 반품 안내 </div> 
            <div><br></div>
            <div class="imgdiv">
                <div class="imglist"><img class="img" src="img/교환반품환불.png" alt=""/></div>
            </div>            
        </div>

        <form class = "center review_view" action="" method="REVIEW">
            <div class="center_title">
                <div class ="review_click" id="review"> 리뷰(<?php echo (count($review)); ?>) </div>
            </div>
            <div class="review_detail_wrapper">
                <div class="review_title_one"> 상품 후기 </div> 
                <div class="review_title_two"> <?php echo (count($review)); ?> </div> 
            </div>
            
            <div class="review_photos_wrapper">
                <div class="rev_pho_all">
                    <div class="review_photo_one"> 포토(<?php echo (count($photo_review)); ?>) </div>
                </div>
                <div class="photos_wrapper">
                    <div class="photos">
                        <?php foreach($photo_review as $r){?>
                            <?php var_dump($photo_review) ; ?>
                            <div class="photo"><img src="" alt=""/></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="review_gather_wrapper">
                <div class = "gather_look">
                    <!-- <select name="review_gather" id="review_gather_look">
                        <option name="latest" value=""> 최신순 </option>
                        <option name="Recommend" value=""> 추천순 </option>
                        <option name="ratings" value=""> 평점순 </option>
                        <option name="photo_review" value=""> 포토리뷰순 </option>
                    </select> -->
                </div>
                <div class="look_wrapper">
                    <?php $review_count=1; ?> <!--각각의 리뷰에 고유번호를 주기위한 변수-->
                    <?php foreach($review as $r){
                    $review_code = $r['review_id'];
                    $year = substr($review_code,0,4);
                    $month = substr($review_code,4,2);
                    $day = substr($review_code,6,2);
                    $date = $year.'-'.$month.'-'.$day;?>
                        <div class="look review<?php echo $review_count++ ?>">
                            <section class="look_left">
                                <div class="row">
                                    <div class="stars_count">
                                        <div class="stars">
                                            <i class="fas fa-star score1"></i>
                                            <i class="fas fa-star score2"></i>
                                            <i class="fas fa-star score3"></i>
                                            <i class="fas fa-star score4"></i>
                                            <i class="fas fa-star score5"></i>
                                        </div>
                                        <div class="review_star_count"><?php echo "$r[star]"?> </div>
                                    </div>
                                    <!-- <div class="review_date"><?php echo "$review_date"?></div> -->
                                    <div class="review_date"><?php echo "$date" ?></div>
                                    <div class="help">
                                        <div class="review_help"> 5 </div>
                                        <div class="review_help_last"> 명에게 도움이 되었습니다. </div>
                                    </div>
                                </div>
                            </section>
                            <section class="look_right_first">
                                <div class="row">
                                    <div class="look_name"> <?php echo "$r[writer_id]"?> </div>
                                    <div class="look_detail">
                                        <?php echo "$r[review_contents]"?>
                                    </div>
                                    <div class="look_good">
                                        <div class="good"> 도움이 돼요! </div>
                                    </div>
                                </div>
                            </section>
                            <section class="look_right_last">
                                <div class="row">
                                    <div class="plus_detail"> 전체보기 > </div>
                                    <div class="plus_comments"> 댓글(3) > </div>
                                </div>
                            </section>
                        </div>
                    <?php }?>
                </div>
            </div>
        </form>
        <!-- <div class="view_review_more_wrapper">
            <div class="view_rev_more_btn">더보기</div>
        </div> -->

    </main>
    <?php require_once("inc/fast_move.php"); ?>

    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/55083c7425.js" crossorigin="anonymous"></script>
    <script src="js/hot_issue.js"></script>
    <script src="js/app.js"></script>
    <script src="js/option.js"></script>
    <script src="js/star.js"></script>
</body>

</html> 