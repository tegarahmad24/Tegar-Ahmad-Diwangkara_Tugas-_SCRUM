<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Praktikum CodeIgniter 4</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #1b1f2a;
            color: white;
        }

        .page {
            min-height: 100vh;
            background: linear-gradient(180deg, #10131c, #1c2233);
        }

        
        .navbar {
            padding: 18px 40px;
        }

        .navbar a {
            display: inline-block;
            padding: 10px 18px;
            background: #292f40;
            border: 1px solid #444b5c;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .navbar a:hover {
            background: #3a4255;
        }

        
        .container {
            padding: 40px;
        }

        
        .hero-top {
            text-align: center;
            padding: 20px;
        }

        .hero-top h1 {
            font-size: 60px;
            margin-bottom: 10px;
            background: linear-gradient(90deg, #00c2ff, #a86bff);
            -webkit-background-clip: text;
            color: transparent;
        }

        .hero-top h2 {
            font-size: 20px;
            margin-bottom: 18px;
        }

        .hero-top p {
            color: #b8bdc9;
            max-width: 620px;
            margin: auto;
            line-height: 1.6;
        }

        
        .hero {
            display: flex;
            justify-content: center;
            margin-top: 25px;
        }

        .card {
            width: 100%;
            max-width: 800px;
            padding: 30px;
            text-align: center;

            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 12px;
        }

        .card h3 {
            color: #a86bff;
            margin-bottom: 10px;
        }

        .card p {
            color: #b8bdc9;
            line-height: 1.6;
        }
    </style>
</head>

<body>

<div class="page">

    <div class="navbar">
        <a href="<?= session()->get('is_logged_in') ? base_url('mahasiswa') : base_url('login') ?>">
            <?= session()->get('is_logged_in') ? 'Data Mahasiswa' : 'Login' ?>
        </a>
    </div>

    <div class="container">

        <div class="hero-top">

            <h1>WEBSITE TEGAR AHMAD</h1>

            <h2>PENUGASAN MEMBUAT WEBSITE</h2>

            <p>
                Selamat datang di halaman latihan Pemrograman Web Berbasis Framework.
                Pada latihan ini digunakan CodeIgniter 4 untuk mempelajari konsep dasar
                Routing, Controller, Model, View serta proses Read dan Create data mahasiswa.
            </p>

        </div>

        <!-- CARD -->
        <div class="hero">

            <div class="card">

                <h3>Tentang Website</h3>

                <p>
                    Website ini dibuat sebagai tugas Pemrograman Web Berbasis Framework
                    untuk menerapkan konsep MVC dan pengelolaan data mahasiswa
                    menggunakan CodeIgniter 4.
                </p>

            </div>

        </div>

    </div>

</div>

</body>
</html>