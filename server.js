const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const cors = require('cors'); // Import CORS

const app = express();
const port = 3000;

app.use(bodyParser.json());

app.use(cors());

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'dbjscoba',
});

connection.connect((err) => {
    if (err) {
        console.error('Error koneksi database:', err);
        return;
    }
    console.log('Terhubung ke database MySQL');
});

app.post('/addBarang', (req, res) => {
    const { nama, harga } = req.body;
    const query = `INSERT INTO barang (nama, harga) VALUES (?, ?)`;
    connection.query(query, [nama, harga], (err, result) => {
        if (err) {
            console.error('Error saat menyimpan data:', err);
            res.status(500).send('Gagal menyimpan data');
            return;
        }
        console.log('Data berhasil disimpan!');
        res.status(200).send('Data berhasil disimpan');
    });
});

app.get('/getBarang', (req, res) => {
    const query = `SELECT * FROM barang`;
    connection.query(query, (err, rows) => {
        if (err) {
            console.error('Error saat mengambil data:', err);
            res.status(500).send('Gagal mengambil data');
            return;
        }
        res.status(200).json(rows);
    });
});

app.listen(port, () => {
    console.log(`Server berjalan di http://localhost:${port}`);
});
