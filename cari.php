<?php
// *** LOAD PAGE HEADER
include "header.php";
// QUERY TABLE php_shop_products n record per page
$sql = "SELECT *id,category, name, description, price FROM php_shop_products ".$qry_t." ORDER BY id DESC LIMIT $recno,$rowperpage;";

//echo $sql;
$result = mysql_query($sql);
$ada = @mysql_num_rows($result);
$no=0;


include "footer.php";

?>

