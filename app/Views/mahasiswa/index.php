<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, Helvetica, sans-serif; color: #ffffff; background: #10131c; }
        .page { min-height: 100vh; background: linear-gradient(180deg, #10131c 0%, #1c2233 100%); padding-bottom: 40px; }
        .navbar { padding: 18px 40px; display: flex; justify-content: space-between; gap: 10px; }
        .navbar a { display: inline-block; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.14); color: #fff; text-decoration: none; font-size: 16px; font-weight: bold; padding: 10px 18px; border-radius: 8px; }
        .navbar a:hover { background: #292f40; }
        .container { max-width: 980px; margin: 40px auto; padding: 30px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.14); border-radius: 12px; }
        .header-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        h1 { color: #fff; }
        .btn-group { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
        .btn-tambah, .btn-home, .btn-edit, .btn-delete, .btn-logout { display: inline-block; text-decoration: none; padding: 10px 16px; border-radius: 8px; font-weight: bold; }
        .btn-tambah { background: linear-gradient(90deg, #00c2ff, #a86bff); color: #fff; }
        .btn-home { background: #292f40; color: #fff; border: 1px solid #444b5c; }
        .btn-edit { background: #1f8fff; color: #fff; }
        .btn-delete { background: #d93d3d; color: #fff; }
        .btn-logout { background: #3d475b; color: #fff; }
        .btn-tambah:hover, .btn-home:hover, .btn-edit:hover, .btn-delete:hover, .btn-logout:hover { opacity: 0.9; }
        table { width: 100%; border-collapse: collapse; background: rgba(255,255,255,0.04); }
        table th, table td { border: 1px solid #3a4050; padding: 12px; text-align: left; }
        table th { background: #292f40; color: #fff; }
        table td { color: #b8bdc9; }
        .action-box { display: flex; gap: 8px; flex-wrap: wrap; }
        .kosong { text-align: center; padding: 20px; color: #b8bdc9; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: rgba(40,167,69,0.2); border: 1px solid rgba(40,167,69,0.6); color: #d7f9df; }
        .alert-error { background: rgba(220,53,69,0.18); border: 1px solid rgba(220,53,69,0.6); color: #ffd7db; }
    </style>
</head>
<body>
<div class="page">
    <div class="navbar">
        <a href="<?= base_url('mahasiswa') ?>">Data Mahasiswa</a>
        <a href="<?= base_url('logout') ?>" class="btn-logout">Logout</a>
    </div>

    <div class="container">
        <div class="header-row">
            <h1>Data Mahasiswa</h1>
            <div class="btn-group">
                <a href="<?= base_url('/') ?>" class="btn-home">&larr; Home</a>
                <a href="<?= base_url('mahasiswa/tambah') ?>" class="btn-tambah">+ Tambah Data</a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <?php if (empty($mahasiswa)) : ?>
            <p class="kosong">Belum ada data mahasiswa.</p>
        <?php else : ?>
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>

                <?php $no = 1; ?>
                <?php foreach ($mahasiswa as $m) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($m['nama']) ?></td>
                        <td><?= esc($m['nim']) ?></td>
                        <td><?= esc($m['kelas']) ?></td>
                        <td>
                            <div class="action-box">
                                <a href="<?= base_url('mahasiswa/edit/' . $m['id']) ?>" class="btn-edit">Edit</a>
                                <a href="<?= base_url('mahasiswa/hapus/' . $m['id']) ?>" class="btn-delete" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
