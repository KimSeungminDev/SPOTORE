<?php
    require_once("inc/session.php"); 
// 체크된 상품만 배열에 넣는 로직
// 1. 장바구니에 들어있는 상품 개수 파악 (cart.php에서 count값을 세션 변수에 저장)
// 2. 그 개수만큼 반복문을 돌린다. (count-- 하다가 0이되면 멈추는 반복문)
// 3. 반복문의 내용은 해당 고유번호의 체크박스가 체크되어 있는지 확인한다.
    require_once("inc/session.php");
    $cart_count=$_SESSION['cart_count']; //장바구니에 들어있는 상품 개수
    $content=[]; //선택된 상품의 정보(content_code, content_amount)가 담긴 배열
    $shopping_cart=[]; //선택된 상품들을 모아놓은 배열(배열인 $content가 1개이상 담겨져 있음)
    $count=1;
    $user_id =$_SESSION['member_id'];

    while($cart_count > 0){
        //해당고유번호의 체크박스가 체크되어 있다면
        if ( isset($_POST['check_box'.$count]) ){
            $content['content_code']=$_POST['content_code'.$count]; //상품코드들을 넣을 배열에 해당 상품코드를 넣는다.
            $content['content_amount']=$_POST['content_amount'.$count];
            $content['content_options']=$_POST['content_options'.$count];
            $content['user_id']=$user_id;
            $shopping_cart[]=$content;
        }
        $count++;
        $cart_count--;
    }

    var_dump($shopping_cart); //체크한 상품들의 상품코드들이 들어있는 배열완성. 
    $_SESSION['shopping_cart']=$shopping_cart; //세션변수에 저장.

    require_once("inc/db.php");
	
	

if($_SESSION['deletecart'] == 'Y'){	 
	    //주문한 상품 장바구니 비우기
    //로직 :
        // cart db에서, 세션변수에 저장했던 shopping_cart에 들어있는 상품코드와 일치하는 상품을 제거
    foreach($_SESSION['shopping_cart'] as $r){
        var_dump($r['content_code']);
        db_update_delete("delete from cart where content_code= ?" , array($r['content_code']));
    }
    unset($_SESSION['shopping_cart']); //shopping_cart에 들었던거 없애기
	header("Location: cart.php");
}	
else if($_SESSION['deletecart'] == 'N'){	
    foreach($shopping_cart as $r){ 
        //해당 상품코드에 대한 상품정보 불러오기
        $result =db_select("select * from contents where content_code= ?", array($r['content_code']));
        // var_dump($result);
        // echo "<br/>";
    }
    header("Location: pay.php");
}
?>