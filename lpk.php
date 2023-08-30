<form method="POST" action="">
    <table>
        <td><td>Pemasukan</td></td> :<input type="text" name="masuk"></td></tr>
        <td><td>Penguaran</td></td> :<input type="text" name="keluar"></td></tr>
    </table>
    <input type="submit" value="check">
    <input type="reset" value="reset">
</form>
<?php
include '../../config/config.php';
// menyimpan data kedalam variabel
echo "Saldo = Rp. $_POST[masuk]<br>";
echo "Saldo = Rp. $_POST[keluar]<br>";
$saldo=$_POST['masuk'];
$saldo=$_POST['keluar'];
// query SQL untuk insert data
$query="INSERT INTO lpk SET masuk='$saldomu'";
mysqli_query($config, $query);

?>