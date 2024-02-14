<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contoh CRUD JavaScript</title>
</head>

<body>
    <h1>Daftar Barang</h1>
    <ul id="list-barang"></ul>
    <form id="form-barang" method="POST">
        <input type="text" name="nama" placeholder="Nama Barang">
        <input type="number" name="harga" placeholder="Harga Barang">
        <button type="submit">Tambah Barang</button>
    </form>

    <script>
        function addBarang(nama, harga) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost:3000/addBarang', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Data berhasil disimpan!');
                        // Panggil renderBarang setelah data berhasil disimpan
                        renderBarang();
                    } else {
                        console.error('Gagal menyimpan data:', xhr.responseText);
                    }
                }
            };
            const data = JSON.stringify({ nama: nama, harga: harga });
            xhr.send(data);
        }


        function getBarang() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://localhost:3000/getBarang', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        renderList(response);
                    } else {
                        console.error('Gagal mengambil data:', xhr.responseText);
                    }
                }
            };
            xhr.send();
        }

        function renderBarang() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://localhost:3000/getBarang', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        renderList(response);
                    } else {
                        console.error('Gagal mengambil data:', xhr.responseText);
                    }
                }
            };
            xhr.send();
        }


        document.getElementById('form-barang').addEventListener('submit', function (e) {
            e.preventDefault();
            const nama = e.target.nama.value;
            const harga = e.target.harga.value;
            addBarang(nama, harga);
            e.target.reset();
        });

        window.onload = function () {
            getBarang();
        };
    </script>
</body>

</html>
