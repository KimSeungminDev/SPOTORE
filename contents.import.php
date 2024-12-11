<?php

// require_once("inc/db.php");

// $sort = $_REQUEST["sort"] ?? "";
// $dir = $_REQUEST["dir"] ?? "";
// $btn = $_REQUEST["btn"] ?? "";

// $order_phrase = "";

// if (!empty($sort)) {
//     $order_phrase = " order by $sort $dir";
// }

// $result =db_select("select * from contents" . $order_phrase);




require_once("inc/db.php");

$result =db_select("SELECT * FROM contents ORDER BY content_code desc");
// // $result =db_select("select * from contents");

// $result_price_H = db_select("select * from contents order by content_price desc"); //높은가격
// $result_price_L = db_select("select * from contents order by content_price "); //낮은가격


?>