<?php
session_start();
require_once("inc/db.php");

// 모든 상품 삭제 로직

// 로그인한 사용자의 user_id
$userId = $_SESSION['member_id'];

// 모든 상품 삭제 로직 (user_id가 현재 로그인한 사용자와 일치하는 경우에만)
db_update_delete("DELETE FROM cart WHERE user_id = ?", array($userId));

// db_update_delete("DELETE FROM cart");

header("Location: cart.php");
exit();
?>
