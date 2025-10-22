// 1. Impor modul yang dibutuhkan
const express = require('express');
const { Pool } = require('pg'); // Modul untuk koneksi ke PostgreSQL
const cors = require('cors');
const bodyParser = require('body-parser');

// 2. Inisialisasi aplikasi express
const app = express();
const port = 3000; // Server akan berjalan di port 3000

// 3. Konfigurasi koneksi ke database PostgreSQL
// Ganti dengan detail koneksi database Anda!
const pool = new Pool({
  user: 'postgres',           // Username pgAdmin/PostgreSQL Anda
  host: 'localhost',
  database: 'siakad_polinema', // Nama database Anda
  password: 'brian927.,.,',    // Password database Anda
  port: 5432,
});

// 4. Konfigurasi Middleware
app.use(cors()); // Mengizinkan request dari domain lain (front-end)
app.use(bodyParser.json()); // Membaca body request sebagai JSON

// 5. Buat API Endpoint untuk Login
app.post('/login', async (req, res) => {
  const { username, password } = req.body; // Ambil username & password dari request

  // Validasi input sederhana
  if (!username || !password) {
    return res.status(400).json({ message: 'Username dan password harus diisi' });
  }

  try {
    // Query ke database untuk mencari user berdasarkan username (NIM)
    // PENTING: Dalam aplikasi nyata, jangan simpan password sebagai plain text. Gunakan hashing (misal: bcrypt).
    const query = 'SELECT * FROM mahasiswa WHERE nim = $1 AND password = $2';
    const result = await pool.query(query, [username, password]);

    if (result.rows.length > 0) {
      // Jika user ditemukan
      console.log('Login berhasil untuk user:', result.rows[0].nama_lengkap);
      res.status(200).json({ message: 'Login berhasil!', user: result.rows[0] });
    } else {
      // Jika user tidak ditemukan atau password salah
      console.log('Login gagal untuk username:', username);
      res.status(401).json({ message: 'Username atau password salah' });
    }
  } catch (error) {
    console.error('Error saat query database:', error);
    res.status(500).json({ message: 'Terjadi kesalahan pada server' });
  }
});

// 6. Jalankan Server
app.listen(port, () => {
  console.log(`Server berjalan di http://localhost:${port}`);
});