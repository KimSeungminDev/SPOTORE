<?php require_once("inc/session.php"); ?>
<?php
    $content_code = $_POST["content_code"];
    $content_options = $_POST["content_options"];
    $option2_amount = $_POST["option2_amount"];
    $cart_id = date("YmdHis");
    echo "$content_code";
    echo "$content_options";
    echo "$option2_amount";

    require_once("inc/db.php");
    
    //로그인 되어 있는 사용자의 아이디 가져오기
    $user_id = $_SESSION['member_id'];

    // 데이터 저장
    db_insert("insert into cart (cart_id, content_code, content_options, content_amount, user_id) values (:cart_id, :content_code, :content_options, :content_amount, :user_id)",
        array(
            'cart_id' => $cart_id,
            'content_code' => $content_code,
            'content_options' => $content_options,
            'content_amount' => $option2_amount,
            'user_id' => $user_id,
        )
    );

    $content=[]; //선택된 상품의 정보(content_code, content_amount)가 담긴 배열
    $shopping_cart=[]; //선택된 상품들을 모아놓은 배열(배열인 $content가 1개이상 담겨져 있음)
    
    $content['content_code'] = $content_code; //상품코드들을 넣을 배열에 해당 상품코드를 넣는다.
    $content['content_amount'] = $option2_amount;
    $content['content_options'] = $content_options;
    $content['user_id'] = $user_id;
    $shopping_cart[] = $content;
    
    var_dump($shopping_cart); // 상품들의 상품코드들이 들어있는 배열 완성. 
    $_SESSION['shopping_cart'] = $shopping_cart; // 세션변수에 저장.

    foreach ($shopping_cart as $r) { 
        // 해당 상품코드에 대한 상품정보 불러오기
        $result = db_select("select * from contents where content_code= ?", $content_code);
    }
    header("Location: paydirect.php");
    // $prevPage = $_SERVER['HTTP_REFERER'];
    // // 변수에 이전페이지 정보를 저장
    // header('location:'.$prevPage);
?>