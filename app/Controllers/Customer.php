<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Controller;

class Customer extends BaseController
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

    public function profile()
    {
        // Cek apakah user sudah login
        if (!$this->session->get('customer_logged_in')) {
            return redirect()->to(base_url('login-customer'));
        }

        // Ambil data customer dari database
        $customerId = $this->session->get('customer_id');
        $customer = $this->customerModel->find($customerId);

        $data = [
            'title' => 'Profil Saya - DAGANGIN.MART',
            'customer' => $customer
        ];

        return view('pages/user/profil_user', $data);
    }

    public function updateProfile()
    {
        // Cek apakah user sudah login
        if (!$this->session->get('customer_logged_in')) {
            return redirect()->to(base_url('login-customer'));
        }

        $customerId = $this->session->get('customer_id');

        // Debug - cek data yang diterima
        log_message('debug', 'POST Data: ' . json_encode($this->request->getPost()));
        log_message('debug', 'Files Data: ' . json_encode($_FILES));

        // Validasi input
        $validation = $this->validate([
            'nama' => [
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'min_length' => 'Nama minimal 3 karakter',
                    'max_length' => 'Nama maksimal 100 karakter'
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'permit_empty|valid_date',
                'errors' => [
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'permit_empty|in_list[L,P]',
                'errors' => [
                    'in_list' => 'Jenis kelamin tidak valid'
                ]
            ]
        ]);

        if (!$validation) {
            $this->session->setFlashdata('error', 'Data yang dimasukkan tidak valid: ' . implode(', ', $this->validator->getErrors()));
            return redirect()->back()->withInput();
        }

        // Data untuk update
        $data = [
            'nama_lengkap' => $this->request->getPost('nama'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir') ?: null,
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin') ?: null
        ];

        // Handle file upload jika ada
        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            // Validasi file
            if ($photo->getSize() > 10000000) { // 10MB
                $this->session->setFlashdata('error', 'Ukuran file foto terlalu besar (maksimal 10MB)');
                return redirect()->back();
            }

            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!in_array($photo->getMimeType(), $allowedTypes)) {
                $this->session->setFlashdata('error', 'Format file tidak diizinkan (hanya JPG, JPEG, PNG)');
                return redirect()->back();
            }

            // Buat folder jika belum ada
            if (!is_dir(ROOTPATH . 'public/uploads/profile/')) {
                mkdir(ROOTPATH . 'public/uploads/profile/', 0755, true);
            }

            // Upload file
            $newName = $photo->getRandomName();
            if ($photo->move(ROOTPATH . 'public/uploads/profile/', $newName)) {
                $data['foto_profil'] = $newName;
            } else {
                $this->session->setFlashdata('error', 'Gagal upload foto');
                return redirect()->back();
            }
        }

        // Debug - cek data yang akan diupdate
        log_message('debug', 'Update Data: ' . json_encode($data));

        // Update data
        if ($this->customerModel->update($customerId, $data)) {
            // Update session jika nama berubah
            if (!empty($data['nama_lengkap'])) {
                $this->session->set('customer_username', $data['nama_lengkap']);
            }
            
            $this->session->setFlashdata('success', 'Profil berhasil diperbarui');
        } else {
            $this->session->setFlashdata('error', 'Gagal memperbarui profil: ' . implode(', ', $this->customerModel->errors()));
        }

        return redirect()->back();
    }

    public function updateContact()
    {
        // Cek apakah user sudah login
        if (!$this->session->get('customer_logged_in')) {
            return redirect()->to(base_url('login-customer'));
        }

        $customerId = $this->session->get('customer_id');

        // Validasi input
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Format email tidak valid'
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
            ]
        ]);

        if (!$validation) {
            $this->session->setFlashdata('error', 'Data kontak tidak valid');
            return redirect()->back()->withInput();
        }

        // Cek apakah email sudah digunakan user lain
        $existingEmail = $this->customerModel->where('email', $this->request->getPost('email'))
                                           ->where('id !=', $customerId)
                                           ->first();
        
        if ($existingEmail) {
            $this->session->setFlashdata('error', 'Email sudah digunakan oleh pengguna lain');
            return redirect()->back();
        }

        // Data untuk update
        $data = [
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp')
        ];

        // Update data
        if ($this->customerModel->update($customerId, $data)) {
            // Update session email
            $this->session->set('customer_email', $data['email']);
            $this->session->setFlashdata('success', 'Kontak berhasil diperbarui');
        } else {
            $this->session->setFlashdata('error', 'Gagal memperbarui kontak');
        }

        return redirect()->back();
    }

    public function updateAddress()
    {
        // Cek apakah user sudah login
        if (!$this->session->get('customer_logged_in')) {
            return redirect()->to(base_url('login-customer'));
        }

        $customerId = $this->session->get('customer_id');

        // Validasi input
        $validation = $this->validate([
            'alamat' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Alamat harus diisi',
                    'min_length' => 'Alamat minimal 10 karakter'
                ]
            ],
            'kota' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Kota harus diisi',
                    'min_length' => 'Kota minimal 3 karakter'
                ]
            ],
            'kode_pos' => [
                'rules' => 'required|numeric|exact_length[5]',
                'errors' => [
                    'required' => 'Kode pos harus diisi',
                    'numeric' => 'Kode pos harus berupa angka',
                    'exact_length' => 'Kode pos harus 5 digit'
                ]
            ]
        ]);

        if (!$validation) {
            $this->session->setFlashdata('error', 'Data alamat tidak valid');
            return redirect()->back()->withInput();
        }

        // Data untuk update
        $data = [
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota'),
            'kode_pos' => $this->request->getPost('kode_pos')
        ];

        // Update data
        if ($this->customerModel->update($customerId, $data)) {
            $this->session->setFlashdata('success', 'Alamat berhasil diperbarui');
        } else {
            $this->session->setFlashdata('error', 'Gagal memperbarui alamat');
        }

        return redirect()->back();
    }
}