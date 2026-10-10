<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;
    private const PHOTO_DIRECTORY = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'mahasiswa';

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->mahasiswaModel->ensureTable();
    }

    private function requireLogin()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        return null;
    }

    private function storePhoto()
    {
        $file = $this->request->getFile('foto');
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        if (!is_dir(self::PHOTO_DIRECTORY)) {
            mkdir(self::PHOTO_DIRECTORY, 0755, true);
        }

        $fileName = $file->getRandomName();
        $file->move(self::PHOTO_DIRECTORY, $fileName);

        return $fileName;
    }

    private function removePhoto(?string $fileName): void
    {
        if ($fileName && is_file(self::PHOTO_DIRECTORY . DIRECTORY_SEPARATOR . $fileName)) {
            unlink(self::PHOTO_DIRECTORY . DIRECTORY_SEPARATOR . $fileName);
        }
    }

    private function photoDataUri(?string $fileName): ?string
    {
        if (!$fileName) {
            return null;
        }

        $path = self::PHOTO_DIRECTORY . DIRECTORY_SEPARATOR . $fileName;
        if (!is_file($path)) {
            return null;
        }

        $mimeType = mime_content_type($path);
        if (!in_array($mimeType, ['image/jpeg', 'image/png'], true)) {
            return null;
        }

        return 'data:' . $mimeType . ';base64,' . base64_encode((string) file_get_contents($path));
    }

    public function index()
    {
        $redirect = $this->requireLogin();
        if ($redirect !== null) {
            return $redirect;
        }

        $keyword = trim((string) $this->request->getGet('q'));
        $query = $this->mahasiswaModel;

        if ($keyword !== '') {
            $query->groupStart()
                ->like('nama', $keyword)
                ->orLike('nim', $keyword)
                ->orLike('kelas', $keyword)
                ->groupEnd();
        }

        $data['mahasiswa'] = $query->orderBy('id', 'DESC')->findAll();
        $data['keyword'] = $keyword;

        return view('mahasiswa/index', $data);
    }

    public function pdf()
    {
        $redirect = $this->requireLogin();
        if ($redirect !== null) {
            return $redirect;
        }

        $keyword = trim((string) $this->request->getGet('q'));
        $query = $this->mahasiswaModel;

        if ($keyword !== '') {
            $query->groupStart()
                ->like('nama', $keyword)
                ->orLike('nim', $keyword)
                ->orLike('kelas', $keyword)
                ->groupEnd();
        }

        $mahasiswa = $query->orderBy('id', 'DESC')->findAll();
        foreach ($mahasiswa as &$item) {
            $item['foto_src'] = $this->photoDataUri($item['foto'] ?? null);
        }
        unset($item);

        $data = [
            'mahasiswa' => $mahasiswa,
            'keyword'   => $keyword,
        ];

        $options = new Options();

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('mahasiswa/pdf', $data), 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->response
            ->setContentType('application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="laporan-biodata-mahasiswa.pdf"')
            ->setBody($dompdf->output());
    }

    public function tambah()
    {
        $redirect = $this->requireLogin();
        if ($redirect !== null) {
            return $redirect;
        }

        return view('mahasiswa/tambah', ['validation' => $this->validator]);
    }

    public function simpan()
    {
        $redirect = $this->requireLogin();
        if ($redirect !== null) {
            return $redirect;
        }

        $rules = [
            'nama'  => 'required|min_length[2]|max_length[100]',
            'nim'   => 'required|max_length[20]',
            'kelas' => 'required|min_length[2]|max_length[50]',
            'foto'  => 'if_exist|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return view('mahasiswa/tambah', [
                'validation' => $this->validator,
            ]);
        }

        $data = [
            'nama'  => $this->request->getPost('nama'),
            'nim'   => $this->request->getPost('nim'),
            'kelas' => $this->request->getPost('kelas'),
        ];

        $photo = $this->storePhoto();
        if ($photo !== null) {
            $data['foto'] = $photo;
        }

        $this->mahasiswaModel->insert($data);

        return redirect()->to('/mahasiswa')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $redirect = $this->requireLogin();
        if ($redirect !== null) {
            return $redirect;
        }

        $mahasiswa = $this->mahasiswaModel->find($id);
        if (!$mahasiswa) {
            return redirect()->to('/mahasiswa')->with('error', 'Data tidak ditemukan.');
        }

        return view('mahasiswa/edit', ['mahasiswa' => $mahasiswa, 'validation' => $this->validator]);
    }

    public function update($id)
    {
        $redirect = $this->requireLogin();
        if ($redirect !== null) {
            return $redirect;
        }

        $mahasiswa = $this->mahasiswaModel->find($id);
        if (!$mahasiswa) {
            return redirect()->to('/mahasiswa')->with('error', 'Data tidak ditemukan.');
        }

        $rules = [
            'nama'  => 'required|min_length[2]|max_length[100]',
            'nim'   => 'required|max_length[20]',
            'kelas' => 'required|min_length[2]|max_length[50]',
            'foto'  => 'if_exist|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return view('mahasiswa/edit', [
                'mahasiswa' => $mahasiswa,
                'validation' => $this->validator,
            ]);
        }

        $data = [
            'nama'  => $this->request->getPost('nama'),
            'nim'   => $this->request->getPost('nim'),
            'kelas' => $this->request->getPost('kelas'),
        ];

        $photo = $this->storePhoto();
        if ($photo !== null) {
            $data['foto'] = $photo;
            $this->removePhoto($mahasiswa['foto'] ?? null);
        }

        $this->mahasiswaModel->update($id, $data);

        return redirect()->to('/mahasiswa')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $redirect = $this->requireLogin();
        if ($redirect !== null) {
            return $redirect;
        }

        $mahasiswa = $this->mahasiswaModel->find($id);
        if ($mahasiswa) {
            $this->removePhoto($mahasiswa['foto'] ?? null);
            $this->mahasiswaModel->delete($id);
        }

        return redirect()->to('/mahasiswa')->with('success', 'Data berhasil dihapus.');
    }
}
