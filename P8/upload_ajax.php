<?php
if (isset($_FILES['files'])) {
    $errors = array();
    $uploaded_files = array(); // Untuk menyimpan nama file yang berhasil diunggah
    $target_dir = "uploads/"; // Folder untuk menyimpan file gambar

    // Pastikan folder uploads ada, jika tidak, buat
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    foreach ($_FILES['files']['name'] as $key => $name) {
        $file_name = $_FILES['files']['name'][$key];
        $file_size = $_FILES['files']['size'][$key];
        $file_tmp = $_FILES['files']['tmp_name'][$key];
        $file_type = $_FILES['files']['type'][$key];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Ekstensi file yang diizinkan (khusus gambar)
        $extensions = array("jpeg", "jpg", "png", "gif");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Ekstensi file '$file_name' tidak diizinkan. Hanya JPEG, JPG, PNG, GIF.";
            continue; // Lanjutkan ke file berikutnya
        }

        // Ukuran file tidak boleh lebih dari 5 MB (5 * 1024 * 1024 bytes)
        if ($file_size > 5242880) {
            $errors[] = "Ukuran file '$file_name' terlalu besar (maksimal 5 MB).";
            continue; // Lanjutkan ke file berikutnya
        }

        // Jika tidak ada error untuk file ini, pindahkan
        if (empty($errors)) {
            $target_file = $target_dir . basename($file_name);
            if (move_uploaded_file($file_tmp, $target_file)) {
                $uploaded_files[] = $file_name;
            } else {
                $errors[] = "Gagal mengunggah file '$file_name'.";
            }
        }
    }

    // Tampilkan hasil
    if (!empty($uploaded_files)) {
        echo "File berhasil diunggah:<br>";
        foreach ($uploaded_files as $file) {
            echo "- " . htmlspecialchars($file) . "<br>";
        }
    }

    if (!empty($errors)) {
        echo "<br>Terjadi kesalahan:<br>";
        foreach ($errors as $error) {
            echo "- " . htmlspecialchars($error) . "<br>";
        }
    }

    if (empty($uploaded_files) && empty($errors)) {
        echo "Tidak ada file yang diunggah.";
    }

} else {
    echo "Tidak ada file yang dipilih.";
}
?>