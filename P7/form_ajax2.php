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

        <input type="submit" value="Submit">
    </form>
    
    <div id="hasil-server">
        Menunggu pengiriman data...
    </div>

    <script>
    $(document).ready(function() {
        $("#myForm").submit(function(event) {
            
            // 1. Mencegah pengiriman form standar
            event.preventDefault(); 
            
            // 2. Validasi Sisi Klien (jQuery)
            var nama = $("#nama").val().trim();
            var email = $("#email").val().trim();
            var valid = true;
            
            // Regex dasar untuk format email
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

            // 3. Jika validasi Klien berhasil, kirim dengan AJAX
            if (valid) {
                
                // Kumpulkan data formulir
                var formData = $("#myForm").serialize();
                
                // Kirim data menggunakan AJAX
                $.ajax({
                    url: "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", // Kirim ke file ini sendiri
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        // Tampilkan hasil dari PHP di div hasil-server
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
// Blok PHP ini hanya akan dijalankan saat dipanggil oleh AJAX (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Untuk menghindari output HTML/SCRIPT di AJAX
    header('Content-Type: text/html'); 
    
    $nama = trim(htmlspecialchars($_POST['nama'] ?? '', ENT_QUOTES, 'UTF-8'));
    $email = trim(htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'));
    $errors = array();

    // Validasi Nama (Server)
    if (empty($nama)) {
        $errors[] = "Nama harus diisi.";
    }

    // Validasi Email (Server)
    // Walaupun sudah divalidasi JS, ini penting untuk keamanan
    if (empty($email)) {
        $errors[] = "Email harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    // Output Hasil Validasi Server
    if (!empty($errors)) {
        echo "<span class='error'>❌ Kesalahan Validasi Server:</span><br>";
        foreach ($errors as $error) {
            echo "<span class='error'>" . $error . "</span><br>";
        }
    } else {
        // Data bersih, siap diproses (simpan ke DB, kirim email, dll.)
        echo "✅ **Data Berhasil Divalidasi dan Diproses Server!**<br>";
        echo "Nama: " . $nama . "<br>";
        echo "Email: " . $email;
    }
    
    // Hentikan eksekusi script agar tidak menampilkan sisa HTML/JS di AJAX response
    exit; 
}
?>