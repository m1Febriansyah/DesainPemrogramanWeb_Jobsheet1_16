<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Aman PHP</title>
</head>
<body>

    <h2>Uji htmlspecialchars()</h2>
    
    <?php
    // Inisialisasi variabel
    $input_aman = "";
    
    // LANGKAH PENTING: Periksa apakah ada data yang dikirim melalui metode POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Cek apakah 'input' ada di array $_POST
        if (isset($_POST['input'])) {
            
            // 1. Ambil data dari formulir
            $input_mentah = $_POST['input'];
            
            $input_aman = htmlspecialchars($input_mentah, ENT_QUOTES, 'UTF-8');
            
            // 3. Tampilkan hasil
            echo "<h3>Hasil Pembersihan:</h3>";
            echo "<p>Input yang Anda masukkan: <strong>" . $input_mentah . "</strong></p>";
            echo "<p>Input yang aman: <strong>" . $input_aman . "</strong></p>";
            
            // Contoh untuk menguji XSS: Coba masukkan <script>alert('XSS')</script>
            
        } else {
            // Ini terjadi jika formulir disubmit tanpa adanya input field 'input'
            echo "<p style='color: orange;'>Peringatan: Variabel 'input' tidak ditemukan dalam data POST.</p>";
        }
        
    }

    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="input_text">Masukkan teks (Coba masukkan tag HTML):</label><br>
        <input type="text" id="input_text" name="input" size="50" required 
               placeholder="Contoh: <b>Tebal</b> atau <script>alert(1)</script>"><br><br>
        <input type="submit" value="Proses Input">
    </form>

</body>
</html>