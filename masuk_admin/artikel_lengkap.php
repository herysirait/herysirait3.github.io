<?php

include"header.php";
include"sidebar.php";
$sql = "SELECT id,judul,isi,kategori FROM news WHERE id='".$_GET['id']."' ";
$result = mysql_query($sql);
?>

 <?php
 echo "<div id='bgartikel'>";
while ($row = mysql_fetch_array($result))
        {


                echo"<h5> Kategoti &raquo;".$row['kategori']."</h5>";
                echo"<h1 align='center'>".$row['judul']."</h1>";
                echo"".$row['isi']."";



}
echo "</div>";

include"footer.php";
?>
