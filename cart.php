<?php require_once("inc/session.php"); ?>
<?php require_once("cart.import.php");?>

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

    <main class="main_wrapper cart">
        <section class="cart_header">
            <span class="cart_title">장바구니</span>
            <div class="delete_buttons">
                <button type="button" onclick="handleAction('deleteAll')">전체 상품 삭제하기</button>
                <button type="button" onclick="handleAction('deleteSelected')">선택 상품 삭제하기</button>
            </div>
        </section>
        <form action="pay.submit.php" method="POST" name="cart_form">
            <section class="table">
                <table>
                    <tr class="table_header">
                        <td class="check"><input class="check_all" type="checkbox" onchange="checkAll()"></td>
                        <td>이미지</td>
                        <td>상품정보</td>
                        <td>가격</td>
                        <td>수량</td>
                        <td>배송비</td>
                        <td>합계</td>
                    </tr>
                    <!-- $count는 체크박스와 상품코드 name에 고유 번호를 주기 위해 만든 변수 -->
                    <?php $count=1; ?> 
                    <?php $total_price=0;  ?>
                    <?php foreach($result as $r){?>
                        <?php $a =db_select("select * from contents where content_code= ?", array($r["content_code"]));?>
                    <tr>
                        <td class="check"><input type="checkbox" onchange="check_all_check()" name="<?php echo "check_box".$count ?>"></td>
                        <td><div class="img_wrapper"><img src="<?php echo $a[0]['content_img']?>" alt=""/></div></td>
                        <td class="content_info">
                            <span class="content_options"><?php echo $r['content_options']?></span>
                            <input type="hidden" name="<?php echo "content_code".$count ?>" value="<?php echo $a[0]['content_code']?>"/>
                            <span class="content_name"><?php echo $a[0]['content_name']?></span>
                            <input type="hidden" name="<?php echo "content_options".$count ?>" value="<?php echo $r['content_options']?>"/>
                        </td>
                        <td>
                            <?php echo number_format($a[0]['content_price']);?>원
                            <?php $price=$a[0]['content_price']; ?>
                        </td>
                        <td class="content_info">
                            <input type="hidden" name="<?php echo "content_amount".$count?>" value="<?php echo $r['content_amount']?>"/>
                            <?php echo $r['content_amount']?>개
                            <?php $amount=$r['content_amount']; ?>
                            <?php $id=$r['user_id']; ?>
                            <?php $id=$r['cart_id']; ?>
                        </td>
                        <td>무료배송</td>
                        <td>
                            <?php $total=$price*$amount ?>
                            <?php echo number_format($total) ?>원
                        </td>
                    </tr>
                    <?php $total_price=$total_price+$total?>
                    <?php $_SESSION['cart_count']=$count ?>
                    <?php $count++; ?>
                    <?php } ?>
                    <tr class="order_receipt">
                        <td class="title font_weight">합계</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <span class="total_price">
                                <?php echo number_format($total_price)?>원
                            </span>
                        </td>
                    </tr>
                </table>
            </section>
            <section class="purchase_buttons">
                <button class="purchase_total" <?php $_SESSION['deletecart'] = 'N'; ?> onclick="select_all()">전체 상품 주문하기</button></a>
                <button type="button" <?php $_SESSION['deletecart'] = 'N'; ?>onclick="CheckSelected()">선택 상품 주문하기</button>
            </section>
        </form>
        
        
        
    </main>

    <?php require_once("inc/fast_move.php"); ?>
    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="js/hot_issue.js"></script>
    <script src="js/member.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
