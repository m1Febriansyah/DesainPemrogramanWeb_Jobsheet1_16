<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Validasi Formulir Minimalis</title>
</head>
<body>

    <h2>Formulir Input Sederhana</h2>
    
    <?php
    $nama = "";
    $email = "";
    $pesan_sukses = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        if (!empty($_POST["nama"])) {
          
            $nama = htmlspecialchars($_POST["nama"], ENT_QUOTES, 'UTF-8');
        }

        if (!empty($_POST["email"])) {
            $email_mentah = $_POST['email'];
        
            if (filter_var($email_mentah, FILTER_VALIDATE_EMAIL)) {
            
                $email = htmlspecialchars($email_mentah, ENT_QUOTES, 'UTF-8');
            }
       
        }
        
        if (!empty($nama) && !empty($email)) {
            $pesan_sukses = "<p style='color: green;'> **Data berhasil disimpan!**</p>";
            
            echo $pesan_sukses;
            echo "<p>Nama yang tersimpan: **" . $nama . "**</p>";
            echo "<p>Email yang tersimpan: **" . $email . "**</p>";
            
            $nama = $email = "";
        } else {
             echo "<p style='color: orange;'>Perhatian: Pastikan semua field terisi dan format email benar.</p>";
        }
    }
    ?>

    <h3>Formulir Pendaftaran</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        
        <label for="nama">Nama:</label><br>
        <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
        <br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required 
               placeholder="contoh@domain.com">
        <br><br>

        <input type="submit" name="submit" value="Daftar">
    </form>

</body>
</html>