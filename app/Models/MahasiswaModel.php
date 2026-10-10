<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table      = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'nim', 'kelas', 'foto'];

    public function ensureTable(): void
    {
        $db = db_connect();

        if (!$db->tableExists('mahasiswa')) {
            $db->query("CREATE TABLE mahasiswa (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nama VARCHAR(100) NOT NULL,
                nim VARCHAR(50) NOT NULL,
                kelas VARCHAR(50) NOT NULL,
                foto VARCHAR(255) DEFAULT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
        } elseif (!$db->fieldExists('foto', 'mahasiswa')) {
            $db->query('ALTER TABLE mahasiswa ADD foto VARCHAR(255) DEFAULT NULL AFTER kelas');
        }
    }
}
