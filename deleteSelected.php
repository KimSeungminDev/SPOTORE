<?php
session_start();
require_once("inc/db.php");

// $cart_id=date("YmdHis");

if (isset($_POST['selectedItems'])) {
    $selectedItems = json_decode($_POST['selectedItems'], true);

    // 선택된 상품들 삭제 로직
    foreach ($selectedItems as $item) {
        // content_code와 user_id를 함께 비교하여 삭제
        // db_update_delete("DELETE FROM cart WHERE cart_id = ? And content_code = ? And content_options = ? And content_amount = ? AND user_id = ?", array($item['cart_id'], $item['content_code'], $item['content_options'], $item['content_amount'], $_SESSION['member_id']));
        db_update_delete("DELETE FROM cart WHERE content_code = ? And content_options = ? AND user_id = ? And content_amount = ?", array($item['content_code'], $item['content_options'], $_SESSION['member_id'], $item['content_amount']));
        // db_update_delete("DELETE FROM cart WHERE cart_id = ?", array($cart_id));
    }
}

header("Location: cart.php");
exit();
?>
