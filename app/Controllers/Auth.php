<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->usersModel->ensureTable();
    }

    public function login()
    {
        if (session()->get('is_logged_in')) {
            return redirect()->to('/mahasiswa');
        }

        return view('auth/login');
    }

    public function doLogin()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'password' => 'required|min_length[3]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return view('auth/login', ['validation' => $this->validator]);
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $this->usersModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'is_logged_in' => true,
                'user_id'      => $user['id'],
                'username'     => $user['username'],
                'nama'         => $user['nama'],
            ]);

            return redirect()->to('/mahasiswa');
        }

        session()->setFlashdata('error', 'Username atau password salah.');

        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
