<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Biodata Mahasiswa</title>
    <style>
        @page { margin: 28px; }
        body { font-family: DejaVu Sans, sans-serif; color: #222; font-size: 11px; }
        h1 { margin: 0 0 5px; text-align: center; font-size: 18px; }
        .subtitle { margin: 0 0 18px; text-align: center; color: #555; }
        .filter { margin-bottom: 12px; color: #555; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #555; padding: 8px; }
        th { background: #dfe6e9; text-align: center; }
        td:first-child, td:nth-child(2) { width: 35px; text-align: center; }
        .foto { width: 48px; height: 48px; object-fit: cover; }
        .empty { padding: 20px; text-align: center; border: 1px solid #555; }
    </style>
</head>
<body>
    <h1>LAPORAN BIODATA MAHASISWA</h1>
    <p class="subtitle">Data mahasiswa</p>

    <?php if (!empty($keyword)) : ?>
        <p class="filter">Filter pencarian: <strong><?= esc($keyword) ?></strong></p>
    <?php endif; ?>

    <?php if (empty($mahasiswa)) : ?>
        <div class="empty">Tidak ada data mahasiswa.</div>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswa as $index => $m) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <?php if (!empty($m['foto_src'])) : ?>
                                <img src="<?= $m['foto_src'] ?>" alt="Foto" class="foto">
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= esc($m['nama']) ?></td>
                        <td><?= esc($m['nim']) ?></td>
                        <td><?= esc($m['kelas']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
