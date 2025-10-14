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
echo "<br>";
$pattern = '/apple/';
$replacement = 'banana';
$text = 'I like apple pie.';
$new_text = preg_replace($pattern, $replacement, $text);
echo $new_text;
echo "<br>";
$pattern = '/go*d/';
$text = 'god is good';
if (preg_match($pattern, $text, $matches)) {
    echo "Cocokkan: " . $matches[0];
} else {
    echo "Tidak ada yang cocok.";
}
echo "<br>";
$pattern = '/h?lo/';
$text = 'hello hi lo';
if (preg_match_all($pattern, $text, $matches)) {
    echo "Cocokkan: " . implode(", ", $matches[0]);
} else {
    echo "Tidak ada yang cocok.";
}
?>