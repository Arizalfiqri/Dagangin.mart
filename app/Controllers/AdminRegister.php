<?php 

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AdminRegister extends Controller
{
    public function index()
    {
        return view('auth/register');
    }

    public function store()
    {
        helper(['form']);
        $session = session();
        $validation = \Config\Services::validation();
        
        $rules = [
            'nama_lengkap'     => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi'
                ]
            ],
            'email'            => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Format email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'username'         => [
                'rules' => 'required|is_unique[users.username]|min_length[3]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah digunakan',
                    'min_length' => 'Username minimal 3 karakter'
                ]
            ],
            'password'         => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 8 karakter'
                ]
            ],
            'repeat_password'  => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak cocok'
                ]
            ],
            'no_hp'            => [
                'rules' => 'required|is_unique[users.no_hp]|numeric',
                'errors' => [
                    'required' => 'Nomor HP harus diisi',
                    'is_unique' => 'Nomor HP sudah terdaftar',
                    'numeric' => 'Nomor HP harus berupa angka'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'no_hp'        => $this->request->getPost('no_hp'),
            'status'       => 'pending',
        ];

        try {
            // Simpan sementara di database
            $userModel = new UserModel();
            $userModel->save($data);

            // Kirim email ke tim IT
            $email = \Config\Services::email();
            $email->setTo('fikriganteng238@gmail.com');
            $email->setSubject('Verifikasi Pendaftaran Admin');
            $message = view('auth/verifikasi_email', ['user' => $data]);
            $email->setMessage($message);
            $email->setMailType('html');
            
            if ($email->send()) {
                return redirect()->to(base_url('admin/register/status?username=' . $data['username']));
            } else {
                $session->setFlashdata('errors', ['email' => 'Gagal mengirim email verifikasi']);
                return redirect()->back()->withInput();
            }
            
        } catch (\Exception $e) {
            $session->setFlashdata('errors', ['system' => 'Terjadi kesalahan sistem. Silakan coba lagi.']);
            return redirect()->back()->withInput();
        }
    }

    public function status()
    {
        $username = $this->request->getGet('username');
        
        if (!$username) {
            return redirect()->to('admin/register')->with('errors', ['system' => 'Parameter tidak valid']);
        }

        $model = new UserModel();
        $user = $model->where('username', $username)->first();

        if (!$user) {
            return redirect()->to('admin/register')->with('errors', ['system' => 'Akun tidak ditemukan']);
        }

        return view('auth/status_verifikasi', ['user' => $user]);
    }
}