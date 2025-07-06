<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Controller;

class AuthCustomer extends BaseController
{
    protected $customerModel;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }

    public function loginCustomer()
    {
        // Jika sudah login, redirect ke homepage
        if ($this->session->get('customer_logged_in')) {
            return redirect()->to(base_url('/'));
        }

        return view('auth/login_user');
    }

    public function registerCustomer()
    {
        // Jika sudah login, redirect ke homepage
        if ($this->session->get('customer_logged_in')) {
            return redirect()->to(base_url('/'));
        }

        return view('auth/register_user');
    }

    public function loginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        // Validasi input
        $validation = $this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi'
                ]
            ]
        ]);

        if (!$validation) {
            $this->session->setFlashdata('error', 'Username dan password harus diisi');
            return redirect()->back();
        }

        // Cek customer di database
        $customer = $this->customerModel->where('username', $username)->first();

        if ($customer && password_verify($password, $customer['password'])) {
            // Set session data
            $sessionData = [
                'customer_id' => $customer['id'],
                'customer_username' => $customer['username'],
                'customer_email' => $customer['email'],
                'customer_logged_in' => true
            ];

            $this->session->set($sessionData);

            // Set remember me cookie jika dipilih
            if ($remember) {
                $cookie = [
                    'name' => 'remember_customer',
                    'value' => $customer['id'],
                    'expire' => 86400 * 30, // 30 hari
                    'httponly' => true,
                    'secure' => false
                ];
                $this->response->setCookie($cookie);
            }

            $this->session->setFlashdata('success', 'Login berhasil! Selamat datang ' . $customer['username']);
            return redirect()->to(base_url('/'));
        } else {
            $this->session->setFlashdata('error', 'Username atau password salah');
            return redirect()->back();
        }
    }

    public function registerStore()
    {
        // Validasi input
        $validation = $this->validate([
            'username' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[customer.username]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'min_length' => 'Username minimal 3 karakter',
                    'max_length' => 'Username maksimal 50 karakter',
                    'is_unique' => 'Username sudah digunakan'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[customer.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Format email tidak valid',
                    'is_unique' => 'Email sudah digunakan'
                ]
            ],
            'no_hp' => [
                'rules' => 'required|numeric|min_length[10]|max_length[15]',
                'errors' => [
                    'required' => 'No HP harus diisi',
                    'numeric' => 'No HP harus berupa angka',
                    'min_length' => 'No HP minimal 10 digit',
                    'max_length' => 'No HP maksimal 15 digit'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'repeat_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi',
                    'matches' => 'Konfirmasi password tidak cocok'
                ]
            ]
        ]);

        if (!$validation) {
            $this->session->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->back()->withInput();
        }

        // Data untuk disimpan
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'password' => $this->request->getPost('password')
        ];

        // Simpan ke database
        if ($this->customerModel->save($data)) {
            $this->session->setFlashdata('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
            return redirect()->to(base_url('login-customer'));
        } else {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        // Hapus session
        $this->session->remove([
            'customer_id',
            'customer_username', 
            'customer_email',
            'customer_logged_in'
        ]);

        // Hapus remember cookie
        if (isset($_COOKIE['remember_customer'])) {
            $this->response->setCookie('remember_customer', '', time() - 3600);
        }

        $this->session->setFlashdata('success', 'Anda telah berhasil logout');
        return redirect()->to(base_url('/'));
    }

    // Method tambahan untuk mengecek auto-login dari cookie
    public function checkRememberMe()
    {
        if (!$this->session->get('customer_logged_in') && isset($_COOKIE['remember_customer'])) {
            $customerId = $_COOKIE['remember_customer'];
            $customer = $this->customerModel->find($customerId);
            
            if ($customer) {
                $sessionData = [
                    'customer_id' => $customer['id'],
                    'customer_username' => $customer['username'],
                    'customer_email' => $customer['email'],
                    'customer_logged_in' => true
                ];
                
                $this->session->set($sessionData);
            }
        }
    }
}