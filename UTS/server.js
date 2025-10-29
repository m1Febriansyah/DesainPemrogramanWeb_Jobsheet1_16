const express = require('express');
const { Pool } = require('pg'); 
const cors = require('cors');
const bodyParser = require('body-parser');

const app = express();
const port = 3000; 

const pool = new Pool({
  user: 'postgres',           
  host: 'localhost',
  database: 'siakad_polinema', 
  password: 'brian927.,.,',    
  port: 5432,
});

app.use(cors()); 
app.use(bodyParser.json()); 

app.post('/login', async (req, res) => {
  const { username, password } = req.body; // Ambil username & password dari request

  // Validasi input sederhana
  if (!username || !password) {
    return res.status(400).json({ message: 'Username dan password harus diisi' });
  }

  try {
    
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