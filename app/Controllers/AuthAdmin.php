<?php

namespace App\Controllers;
use App\Models\UserModel;

class AuthAdmin extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {

            // Cek status verifikasi
            if ($user['status'] === 'pending') {
                $session->setFlashdata('error', 'Akun Anda belum diverifikasi oleh tim IT.');
                return redirect()->to('/admin/login');
            }

            if ($user['status'] === 'rejected') {
                $session->setFlashdata('error', 'Pendaftaran Anda ditolak.');
                return redirect()->to('/admin/login');
            }

            // Login sukses
            $session->set([
                'admin_id' => $user['id'],
                'admin_username' => $user['username'],
                'isAdminLoggedIn' => true,
            ]);
            return redirect()->to('/admin/dashboard');

        } else {
            $session->setFlashdata('error', 'Username atau password salah.');
            return redirect()->to('/admin/login');
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
