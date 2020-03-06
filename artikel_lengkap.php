<?php

include"header.php";
include"left.php";
include"right.php";


$query = "UPDATE news SET views = views + 1  WHERE id='".$_GET['id']."'";
mysql_query($query);

$idArtikel = $_GET['id'];
if ($_GET['act'] == "submit")
{
   // membaca data komentar dari form
   $nama = strip_tags($_POST['nama']);
   $url = strip_tags($_POST['url']);
   $komentar = $_POST['komentar'];
   $isi = strip_tags($_POST['komentar']);
   $idArtikel = $_POST['idArtikel'];
   $tglKomentar = date("Y-m-d");
   
$cek = mysql_query("SELECT * FROM komentar WHERE idArtikel ='".$idArtikel."'");
while ($row=mysql_fetch_array($cek)){
if($row['komentar']==$isi)
  {
  echo'<script>alert("Anda Sudah Mengisi Komentar, Terima Kasih");window.location="blog.php";</script>';
     exit;
    }
}

  if (empty($nama)) $err['nama']="<span class=\"err\">Silahkan Isi Nama Anda</span>\n";
    if (empty($url)) $err['url']="<span class=\"err\">Silahkan Isi URL Anda</span>\n";
    if (empty($isi)) $err['komentar']="<span class=\"err\">Silahkan Isi Komentar Anda.</span>\n";


    if(count($err)>0){ // *** if submit error
        echo "<div id='notif2'>Data Yang Anda Masukkan Masih Ada Yang Salah, Silahkan Perbaiki, Terima Kasih</div>";
    }

else{
   $query = "INSERT INTO komentar (idArtikel,pengirim, url, komentar, tanggal)
           VALUES ($idArtikel,'$nama', '$url', '$isi', '$tglKomentar')";
   $hasil = mysql_query($query);



  echo'<script>alert("Terima Kasih Saudara '.$_POST['nama'].'  Atas Kesedaiannya Memberikan Komentar!!")</script>';



}
}


// proses menampilkan detail artikel berdasarkan id artikel
$query = "SELECT * FROM news WHERE id = '$idArtikel'";
$hasil = mysql_query($query);
$row  = mysql_fetch_array($hasil);


echo"<div id='bgartikel'>";

       echo"<table border='0'>";
       echo"<div id='posted'>";
       echo"<ul>";

       echo"<li><a href='index.php'>Home</a></li>";
       echo"<li>&nbsp;&nbsp;&nbsp;&raquo;#".$row['kategori']."</li>";
       echo"<li>&raquo;Posted By : &nbsp;".$row['author']."</li>";
       echo"<li>&raquo;".$row['tanggal']."</li>";
       echo"<li>&raquo;Dibaca : ".$row['views']."Kali</li>";
       echo"</ul>";
      echo"</div>";
       echo"<div class='cleared'></div>";

        include"share.php";

      echo"<tr>";
      echo"<h1>".$row['judul']."</h1>";

      echo"<td>".$row['isi']."</td>";
      echo"</tr>";
 echo"</table><br>";
?>

Ada &nbsp; [<?php
$jumlahkomentar = mysql_num_rows(mysql_query("SELECT * FROM komentar WHERE idArtikel = '$idArtikel' ")); ?> <?php echo"".$jumlahkomentar.""?> ] Komentar Dalam Postingan ini
<h3>Komentar</h3>


<?php

$query = "SELECT * FROM komentar WHERE idArtikel = '$idArtikel'";
$hasil = mysql_query($query);
if (mysql_num_rows($hasil) > 0)
{

   // jika ada komentar (jumlah data hasil query > 0), maka tampilkan komentarnya
   while ($data = mysql_fetch_array($hasil))
   {
       //echo"<table>";
     // echo"<tr>";
      echo"<div id='comment'>";

      echo"<p>&raquo;".$data['tanggal']."</small></p>";
      echo "<p><img src='images/stats.png'>&nbsp;".$data['pengirim']." &nbsp; &raquo;<a href='".$data['url']."'>".$data['url']."</a>&laquo;</p>";
      echo "<p>&raquo;".$data['komentar']."</p>";
     // echo"</tr>";
     // echo"</table>";
     //echo"<a href='reply.php'>Reply</a>";
     echo"</div>";
   }

}

// jika tidak ada komentar (jumlah data hasil query = 0), tampilkan keterangan belum ada komentar
//else if (mysql_num_rows($hasil) == 0) echo "<p>Belum ada komentar.</p>";
//else if (mysql_num_rows($hasil) > 0) echo "".$hasil."";


// menampilkan form pengisian komentar

echo"<div id='formcomment'>";

echo "<form method='post' action='".$_SERVER['PHP_SELF']."?idArtikel=".$id."&act=submit'>";
echo "<table>";
?>
<?php
echo'
<tr><td>&laquo;&nbsp;Nama Anda</td><td>:</td><td>
<input  name="nama" size="35" class="texbox" maxlength="30" value="'.$_POST['nama'].'"><br>'.$err['nama'].' </td></tr>

<tr><td>&laquo;&nbsp;URL Anda</td><td>:</td><td>
<input name="url" size="50" class="texbox" value="'.$_POST['url'].'"><br>'.$err['url'].'</td></tr>

<tr><td>&laquo;&nbsp;Komentar</td><td>:</td><td>
<textarea class="texarea" name="komentar" cols="50" rows="7" value="'.$_POST['komentar'].'"></textarea><br>'.$err['komentar'].'</td></tr>';
?>
<?php
echo "<tr><td></td><td></td><td><input type='submit' name='submit' value='Kirim' class='btn'><input type='hidden' name='idArtikel' value='".$idArtikel."'></td></tr>";
echo"</table>";
echo"</div>";
echo"</div>";
 echo"<div class='cleared'></div>";

include"footer.php";
?>
