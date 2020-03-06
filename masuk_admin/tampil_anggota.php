<?php
include "header-admin.php";
echo"<div id='bganggota'>";
$sql = "SELECT * FROM anggota";
$result = mysql_query($sql);
echo"<center>";
echo"
    <table border='1'  cellspacing='0' cellpadding='0'>
    <tr><td colspan=6><h3 align='center'>Data Anggota</h3></td></tr>

    <tr bgcolor=#2E8B57>
    <td><b>Nama Anggota</b></td>
    <td><b>Alamat</b></td>
    <td><b>Email</b></td>
    <td><b>Telephone</b></td>
    <td><b>Jenis Kelamin</b></td>
    <td><b>Password</b></td>
    </tr>";

while ($row = mysql_fetch_array($result))
        {

             echo"<tr>";
             echo"<td>".$row['nama']."</td>";
             echo"<td>".$row['alamat']."</td>";
             echo"<td>".$row['email']."</td>";
             echo"<td>".$row['telephone']."</td>";
             echo"<td>".$row['jenis_kelamin']."</td>";
             echo"<td>".$row['password']."</td>";
             echo"</tr>";

}
echo"</table>";
echo"</center>";
echo"</div>";
?>
