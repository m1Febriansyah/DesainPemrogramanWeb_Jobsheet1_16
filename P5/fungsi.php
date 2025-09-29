<?php
function hitungUmur($thn_lahir,$thn_sekarang){
        $umur = $thn_sekarang - $thn_lahir;
        return $umur;
}

echo "Umur saya adalah ". hitungUmur(2007,2025). " tahun"

?>