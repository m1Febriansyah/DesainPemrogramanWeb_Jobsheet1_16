<?php
$pattern = '/[a-z]/';
$text = 'This is a sample text.';
if (preg_match($pattern, $text)) {
    echo "Huruf kecil ditemukan.";
} else {
    echo "Tidak ada huruf kecil.";
}
?>