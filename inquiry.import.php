<?php

require_once("inc/db.php");
 
$result =db_select("SELECT * FROM inquiry ORDER BY num desc");

?>