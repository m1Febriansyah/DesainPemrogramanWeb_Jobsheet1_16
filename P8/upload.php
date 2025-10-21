<?php

if(isset($_POST["submit"])){
    $targetdir = "uploads/"; // Direktori tujuan untuk menyimpan file
    $targetfile = $targetdir . basename($_FILES["myfile"]["name"]);
    $fileType = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));

    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $maxsize = 5 * 1024 * 1024; // 5MB

    if (in_array($fileType, $allowedExtensions) && $_FILES["myfile"]["size"] <= $maxsize) {

        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $targetfile)) {
            echo "File berhasil diunggah.";

            // --- Bagian Penambahan Kode untuk Thumbnail ---

            // 1. Tentukan ukuran thumbnail
            $newWidth = 200;
            $thumbnailFile = $targetdir . "thumb_" . basename($_FILES["myfile"]["name"]);

            // 2. Ambil informasi gambar
            list($width, $height) = getimagesize($targetfile);
            $newHeight = floor($height * ($newWidth / $width)); // Hitung tinggi otomatis

            // 3. Buat image resource berdasarkan tipe file
            if ($fileType == "jpg" || $fileType == "jpeg") {
                $sourceImage = imagecreatefromjpeg($targetfile);
            } elseif ($fileType == "png") {
                $sourceImage = imagecreatefrompng($targetfile);
            } elseif ($fileType == "gif") {
                $sourceImage = imagecreatefromgif($targetfile);
            }

            // 4. Buat gambar thumbnail kosong
            $destinationImage = imagecreatetruecolor($newWidth, $newHeight);

            // 5. Salin dan ubah ukuran gambar ke thumbnail
            imagecopyresampled($destinationImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // 6. Simpan gambar thumbnail ke direktori
            if ($fileType == "jpg" || $fileType == "jpeg") {
                imagejpeg($destinationImage, $thumbnailFile, 90); // 90 adalah kualitas
            } elseif ($fileType == "png") {
                imagepng($destinationImage, $thumbnailFile);
            } elseif ($fileType == "gif") {
                imagegif($destinationImage, $thumbnailFile);
            }

            // 7. Bersihkan memori
            imagedestroy($sourceImage);
            imagedestroy($destinationImage);

            // 8. Tampilkan gambar thumbnail di browser
            echo "<br>Thumbnail gambar:";
            echo "<br><img src='$thumbnailFile' alt='Thumbnail' style='border: 1px solid #ccc;'>";

            // --- Akhir Bagian Penambahan Kode ---

        }
        else {
            echo "Gagal mengunggah file.";
        }
    }
    else {
        echo "File tidak valid atau melebihi ukuran maksimum yang diizinkan";
    }
}

?>