<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;

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

    public function index()
    {
        $redirect = $this->requireLogin();
        if ($redirect !== null) {
            return $redirect;
        }

        $data['mahasiswa'] = $this->mahasiswaModel->orderBy('id', 'DESC')->findAll();

        return view('mahasiswa/index', $data);
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
        ];

        if (!$this->validate($rules)) {
            return view('mahasiswa/tambah', [
                'validation' => $this->validator,
            ]);
        }

        $this->mahasiswaModel->insert([
            'nama'  => $this->request->getPost('nama'),
            'nim'   => $this->request->getPost('nim'),
            'kelas' => $this->request->getPost('kelas'),
        ]);

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

        $rules = [
            'nama'  => 'required|min_length[2]|max_length[100]',
            'nim'   => 'required|max_length[20]',
            'kelas' => 'required|min_length[2]|max_length[50]',
        ];

        if (!$this->validate($rules)) {
            $mahasiswa = $this->mahasiswaModel->find($id);
            return view('mahasiswa/edit', [
                'mahasiswa' => $mahasiswa,
                'validation' => $this->validator,
            ]);
        }

        $this->mahasiswaModel->update($id, [
            'nama'  => $this->request->getPost('nama'),
            'nim'   => $this->request->getPost('nim'),
            'kelas' => $this->request->getPost('kelas'),
        ]);

        return redirect()->to('/mahasiswa')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $redirect = $this->requireLogin();
        if ($redirect !== null) {
            return $redirect;
        }

        $this->mahasiswaModel->delete($id);

        return redirect()->to('/mahasiswa')->with('success', 'Data berhasil dihapus.');
    }
}
