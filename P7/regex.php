<?php
$pattern = '/[a-z]/';
$text = 'This is a sample text.';
if (preg_match($pattern, $text)) {
    echo "Huruf kecil ditemukan.";
} else {
    echo "Tidak ada huruf kecil.";
}
echo "<br>";
$pattern = '/[0-9]+/';
$text = 'There are 123 apples.';
if (preg_match($pattern, $text, $matches)) {
    echo "Cocokkan: " . $matches[0];
} else {
    echo "Tidak ada yang cocok.";
}
?>