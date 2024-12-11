<?php require_once("contents.import.php");?>
<?php require_once("inc/db.php"); ?>

<?php
$content_code = $_REQUEST["content_code"];

$db = new PDO("mysql:host=localhost;port=3306;dbname=spotore_php", "root", "mariadb");
$db -> exec("delete from contents where content_code = $content_code");

header("Location:product_search.php");
?>