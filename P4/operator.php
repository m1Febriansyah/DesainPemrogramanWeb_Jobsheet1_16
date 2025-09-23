<?php
$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;
echo "Hasil Penjumlahan $a + $b = $hasilTambah <br>";
echo "Hasil Pengurangan $a - $b = $hasilKurang <br>";
echo "Hasil Perkalian $a * $b = $hasilKali <br>";
echo "Hasil Pembagian $a / $b = $hasilBagi <br>";
echo "Hasil Sisa Bagi $a % $b = $sisaBagi <br>";
echo "Hasil Pangkat $a ** $b = $pangkat <br>"; 
echo "<br>";
$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;
echo "Hasil Sama $a == $b = ";
var_dump($hasilSama); echo "<br>";
echo "Hasil Tidak Sama $a != $b = ";
var_dump($hasilTidakSama); echo "<br>";
echo "Hasil Lebih Kecil $a < $b = ";
var_dump($hasilLebihKecil); echo "<br>";
echo "Hasil Lebih Besar $a > $b = ";
var_dump($hasilLebihBesar); echo "<br>";
echo "Hasil Lebih Kecil Sama $a <= $b = ";
var_dump($hasilLebihKecilSama); echo "<br>";
echo "Hasil Lebih Besar Sama $a >= $b = ";
var_dump($hasilLebihBesarSama); echo "<br>";
?>