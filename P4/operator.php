<?php
$kursi = 45;
$diduduki = 28;

$kosong = $kursi - $diduduki;
$persen_kosong = ($kosong / $kursi) * 100;
echo "Jumlah kursi: $kursi <br>";
echo "Jumlah kursi yang diduduki: $diduduki <br>";
echo "Jumlah kursi yang kosong: $kosong <br>";
echo "Persentase kursi yang kosong: $persen_kosong % <br>";
?>