<?php
$nilaiNumerik= 92;

if($nilaiNumerik >= 90 && $nilaiNumerik <= 100){
    echo "Nilai huruf : A";
} elseif($nilaiNumerik >= 80 && $nilaiNumerik < 90){
    echo "Nilai huruf : B";
} elseif($nilaiNumerik >= 70 && $nilaiNumerik < 80){
    echo "Nilai huruf : C";
} elseif($nilaiNumerik < 70){
    echo "Nilai huruf : D";
} 

echo "<br>";
$jarakSaatIni = 0;
$jarakTarget = 500;
$peningkatanHarian = 30;
$hari = 0;

while($jarakSaatIni < $jarakTarget){
    $jarakSaatIni += $peningkatanHarian;
    $hari++;
}
echo "Atlet tersebut memerlukan $hari hari untuk mencapai jarak 500 kilometer <br>";  
echo "<br>";
$jumlahLahan = 10;
$tanamanPerLahan = 5;
$buahPerTanaman = 10;
$jumlahBuah = 0;

for($i = 1; $i <= $jumlahLahan; $i++){
    $jumlahBuah += $tanamanPerLahan * $buahPerTanaman;
}
echo "Jumlah buah yang akan dipanen adalah $jumlahBuah ";
echo "<br>";
$skorUjian = [85, 92, 78, 96, 88];
$totalSkor = 0;

foreach($skorUjian as $skor){
    $totalSkor += $skor;
}

echo "Total skor ujian adalah $totalSkor";
echo "<br>";
$nilaiSiswa = [85, 92, 58, 64, 90, 55, 88, 79, 70, 96];

foreach ($nilaiSiswa as $nilai) {
    if ($nilai >= 60) {
        echo "Nilai $nilai: (Tidak Lulus) <br>";
        continue;       
    } 
    echo "Nilai $nilai: (Lulus) <br>";
}
echo "<br>";
$nilai = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
for($i = 0; $i < count($nilai); $i++){
    for($j = $i+1; $j < count($nilai); $j++){
        if($nilai[$i] > $nilai[$j]){
            $temp = $nilai[$i];
            $nilai[$i] = $nilai[$j];
            $nilai[$j] = $temp;
        }
    }
}
$total = 0;
$hitung = 0;
foreach($nilai as $index => $n){
    if($index >= 2 && $index < count($nilai) - 2){ 
        $total += $n;
        $hitung++;
    }
}
$rata = $total / $hitung;
echo "Total nilai setelah buang 2 tertinggi & 2 terendah: $total <br>";

?>