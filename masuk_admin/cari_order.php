<div id='wrapper'>
<?php
// *** LOAD ADMIN PAGE HEADER
include "header-admin.php";
 echo"<div id='bgkonten'>";


if (!empty($_GET['page'])) $_SESSION['page']=$_GET['page'];
if (!empty($_SESSION['page'])) $_GET['page']=$_SESSION['page'];


if ( ($_GET['act']=="delete") && !empty($_GET[id]) ){
    @mysql_query("DELETE FROM php_shop_orders WHERE id='".$_GET[id]."'");
    echo"data terhapus";
}


$status=$_POST['status'];
echo"<center>";
echo '<h4 align="center">ADMIN ORDER</h4>'.$msg;

$cari=$_POST['cari'];
$sql = "SELECT * FROM php_shop_orders WHERE kode_order LIKE '%$cari%'";
$result = mysql_query($sql);

?>

       <?php
        if($row = mysql_fetch_array($result)){

        echo'<div id="order">';
echo"<table id='data_pembeli'>";


               if ( ($_GET['act']=="update")){
               $status="Lunas";
}else{
    $status="<q>Baru</q>";

         }
                echo "<tr><td>
            <a href=\"".$_SERVER['PHP_SELF']."?id=".$row['id']."&amp;act=view\"> <input type='button' value='Detail' class='btn'></a> "
            ."<a onclick=\"return confirm('Are you sure to Delete?');\" href=\"".$_SERVER['PHP_SELF']."?id=".$row['id']."&amp;act=delete\">
            <input type='button' value='Hapus' class='btn'></a></td>";
			echo "</tr>";

               echo"<tr><td><a href=\"".$_SERVER['PHP_SELF']."?id=".$row['id']."&amp;act=update\"> <input type='button' value='Lunas' class='btn'></a>


               </td></tr>";

                 $no++;
                echo "<tr><td>&raquo; Status  : ".$status."</td></tr>";
                echo "<tr><td>&raquo; Kode Order  : ".$row['kode_order']."</td></tr>";
				echo "<tr><td>&raquo; Tanggal &nbsp;&nbsp; &nbsp; &nbsp; : ".$row['order_date']."</td></tr>";
                echo "<tr><td>&raquo; Nama  &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;     : ".$row['fullname']."</td></tr>";
                echo "<tr><td>&raquo; Email &nbsp;&nbsp; &nbsp; &nbsp;   &nbsp;&nbsp;   : ".$row['email']."</td></tr>";
                echo "<tr><td>&raquo; Telepon &nbsp;&nbsp; &nbsp;&nbsp;  : ".$row['telp_cell']."</td></tr>";
                echo "<tr><td>&raquo; Alamat &nbsp;&nbsp; &nbsp; &nbsp;     : ".$row['address']."</td></tr>";
            echo"</table>";

           echo"<table id='alamat_order'>";
            if ( ($_GET['act']=="view") && ($_GET['id']==$row['id']) ){
            $orders_info=@mysql_result(@mysql_query("SELECT orders_info FROM php_shop_orders WHERE kode_order='".$_GET['id']."'"),0,0);
            echo '
            <style>
            #tbcheckout {font-size:0.9em; };
            </style>
            ';
			echo "<tr><td colspan=6 style=\"padding:20px\">".$orders_info."</td>";
			echo "</tr>";


            }

    echo'</table></div>
    ';
} else {
    echo "Data Masih Kosong Mas Broh !! ";
}

echo"</center>";
echo"</div>";
echo"<div class='cleared'></div>";
include"footer.php";
?>
</div>
