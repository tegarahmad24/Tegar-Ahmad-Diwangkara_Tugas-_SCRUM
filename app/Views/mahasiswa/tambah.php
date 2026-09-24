<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Mahasiswa</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, Helvetica, sans-serif; color: #fff; background: #10131c; }
        .page { min-height: 100vh; background: linear-gradient(180deg, #10131c 0%, #1c2233 100%); padding-bottom: 40px; }
        .navbar { padding: 18px 40px; }
        .navbar a { display: inline-block; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.14); color: #fff; text-decoration: none; padding: 10px 18px; border-radius: 8px; font-size: 16px; font-weight: bold; }
        .navbar a:hover { background: #292f40; }
        .container { max-width: 500px; margin: 40px auto; padding: 30px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.14); border-radius: 12px; }
        h1 { color: #fff; margin-bottom: 25px; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 7px; font-weight: bold; color: #fff; }
        input[type="text"] { width: 100%; padding: 11px; background: #292f40; color: #fff; border: 1px solid #444b5c; border-radius: 7px; font-size: 14px; }
        input[type="text"]:focus { outline: none; border-color: #00c2ff; }
        .error-text { color: #ff9ca7; font-size: 12px; margin-top: 6px; }
        .tombol-group { margin-top: 25px; display: flex; gap: 10px; }
        .btn-simpan { background: linear-gradient(90deg, #00c2ff, #a86bff); color: #fff; border: none; padding: 10px 18px; border-radius: 7px; font-weight: bold; cursor: pointer; font-size: 14px; }
        .btn-simpan:hover { opacity: 0.85; }
        .btn-kembali { background: #292f40; color: #fff; border: 1px solid #444b5c; text-decoration: none; padding: 10px 18px; border-radius: 7px; font-weight: bold; font-size: 14px; }
        .btn-kembali:hover { background: #3a4255; }
    </style>
</head>
<body>
<div class="page">
    <div class="navbar">
        <a href="<?= base_url('mahasiswa') ?>">Data Mahasiswa</a>
    </div>

    <div class="container">
        <h1>Tambah Data Mahasiswa</h1>

        <form action="<?= site_url('mahasiswa/simpan') ?>" method="post">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?= old('nama') ?>" required>
                <?php if (isset($validation) && $validation->hasError('nama')) : ?>
                    <div class="error-text"><?= esc($validation->getError('nama')) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="<?= old('nim') ?>" required>
                <?php if (isset($validation) && $validation->hasError('nim')) : ?>
                    <div class="error-text"><?= esc($validation->getError('nim')) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" id="kelas" name="kelas" value="<?= old('kelas') ?>" required>
                <?php if (isset($validation) && $validation->hasError('kelas')) : ?>
                    <div class="error-text"><?= esc($validation->getError('kelas')) ?></div>
                <?php endif; ?>
            </div>

            <div class="tombol-group">
                <button type="submit" class="btn-simpan">Simpan</button>
                <a href="<?= base_url('mahasiswa') ?>" class="btn-kembali">Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
