<!DOCTYPE html>
<html>
<head>
    <title>Form Input dengan Validasi & AJAX</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .error {
            color: red;
            font-weight: bold;
        }
        #hasil-server {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Form Input dengan Validasi (AJAX)</h1>
    
    <form id="myForm" method="post" action="#">
        
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">
        <span id="nama-error" class="error"></span><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <span id="email-error" class="error"></span><br><br>

        <label for="password">Password (Min. 8 Karakter):</label>
        <input type="password" id="password" name="password">
        <span id="password-error" class="error"></span><br><br>

        <input type="submit" value="Submit">
    </form>
    
    <div id="hasil-server">
        Menunggu pengiriman data...
    </div>

    <script>
    $(document).ready(function() {
        $("#myForm").submit(function(event) {
            
            event.preventDefault(); 
            
            // 1. Validasi Sisi Klien (jQuery)
            var nama = $("#nama").val().trim();
            var email = $("#email").val().trim();
            var password = $("#password").val(); // Ambil nilai password
            var valid = true;
            
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 

            // Validasi Nama
            if (nama === "") {
                $("#nama-error").text("Nama harus diisi.");
                valid = false;
            } else {
                $("#nama-error").text("");
            }

            // Validasi Email
            if (email === "") {
                $("#email-error").text("Email harus diisi.");
                valid = false;
            } else if (!emailRegex.test(email)) {
                $("#email-error").text("Format email tidak valid.");
                valid = false;
            } else {
                $("#email-error").text("");
            }

            // Validasi Password (BARU: Min. 8 Karakter)
            if (password === "") {
                $("#password-error").text("Password harus diisi.");
                valid = false;
            } else if (password.length < 8) {
                $("#password-error").text("Password minimal 8 karakter.");
                valid = false;
            } else {
                $("#password-error").text("");
            }

            // 2. Kirim dengan AJAX jika validasi Klien berhasil
            if (valid) {
                var formData = $("#myForm").serialize();
                
                $("#hasil-server").html("Sedang memproses..."); // Umpan balik

                $.ajax({
                    url: "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $("#hasil-server").html(response);
                    },
                    error: function() {
                         $("#hasil-server").html("<span class='error'>Terjadi kesalahan saat menghubungi server.</span>");
                    }
                });
            }
        });
    });
    </script>
</body>
</html>

<?php
// Blok PHP (Validasi Sisi Server)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Header penting untuk AJAX
    header('Content-Type: text/html'); 
    
    // Ambil dan bersihkan data
    $nama = trim(htmlspecialchars($_POST['nama'] ?? '', ENT_QUOTES, 'UTF-8'));
    $email = trim(htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'));
    $password = $_POST['password'] ?? ''; // Ambil password mentah
    $errors = array();

    // ------------------------------------------------
    // Validasi Nama & Email (Seperti sebelumnya)
    // ------------------------------------------------
    if (empty($nama)) { $errors[] = "Nama harus diisi."; }
    if (empty($email)) { 
        $errors[] = "Email harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    // ------------------------------------------------
    // Validasi Password (BARU: Sisi Server)
    // ------------------------------------------------
    if (empty($password)) {
        $errors[] = "Password harus diisi.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter.";
    }
    // CATATAN: Password TIDAK perlu di-htmlspecialchars() di sini,
    // karena tujuannya adalah untuk di-hash (misalnya dengan password_hash())

    // Output Hasil Validasi Server
    if (!empty($errors)) {
        echo "<span class='error'>❌ Kesalahan Validasi Server:</span><br>";
        foreach ($errors as $error) {
            echo "<span class='error'>" . $error . "</span><br>";
        }
    } else {
        // Data bersih, siap diproses. 
        // Lakukan hashing password di sini sebelum disimpan ke database!
        
        // Simulasikan hasil:
        echo "✅ **Data Berhasil Divalidasi dan Diproses Server!**<br>";
        echo "Nama: " . $nama . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Password: (OK, siap di-hash)";
    }
    
    // Hentikan eksekusi script setelah AJAX response selesai
    exit; 
}
?>