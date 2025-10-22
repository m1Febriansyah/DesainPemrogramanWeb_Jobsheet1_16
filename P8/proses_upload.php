<?php

// Lokasi penyimpanan file yang diunggah
$targetDirectory = "upload";

// Batasan untuk gambar
$allowedExtensions = array("jpg", "jpeg", "png", "gif");
$maxsize = 5 * 1024 * 1024; // 5MB per gambar

// Periksa apakah direktori penyimpanan ada, jika tidak maka buat
if (!file_exists($targetDirectory)) {
    // Membuat direktori secara rekursif dengan izin penuh (0777)
    if (!mkdir($targetDirectory, 0777, true)) {
        die("Gagal membuat direktori: $targetDirectory. Pastikan server memiliki izin.");
    }
}

// Pastikan input file menggunakan nama 'gambar[]' sesuai HTML sebelumnya
if (isset($_FILES['gambar']['name'][0])) {
    $totalFiles = count($_FILES['gambar']['name']);
    $uploadedCount = 0;

    echo "<h2>Hasil Unggah:</h2>";

    // Loop melalui semua file yang diunggah
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['gambar']['name'][$i];
        $fileTmpName = $_FILES['gambar']['tmp_name'][$i];
        $fileSize = $_FILES['gambar']['size'][$i];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $targetFile = $targetDirectory . $fileName;

        // Validasi: Periksa ekstensi file dan ukuran file
        if (in_array($fileType, $allowedExtensions) && $fileSize <= $maxsize) {
            
            // Pindahkan file yang diunggah ke direktori penyimpanan
            if (move_uploaded_file($fileTmpName, $targetFile)) {
                echo "File <b>$fileName</b> berhasil diunggah.<br>";
                echo "<img src='$targetFile' width='150px' alt='$fileName'><br>"; // Pratinjau gambar
                $uploadedCount++;
            } else {
                echo "Gagal mengunggah file <b>$fileName</b> (Error server saat memindahkan).<br>";
            }
        } else {
            $errorMessage = "File <b>$fileName</b> gagal diunggah: ";
            if (!in_array($fileType, $allowedExtensions)) {
                $errorMessage .= "Tipe file tidak valid (hanya JPG, PNG, GIF).";
            } else if ($fileSize > $maxsize) {
                $errorMessage .= "Ukuran file melebihi batas 5MB.";
            }
            echo "$errorMessage<br>";
        }
    }
    echo "<br>Total $uploadedCount dari $totalFiles gambar berhasil diunggah.";

} else {
    echo "Tidak ada file yang diunggah.";
}

?>