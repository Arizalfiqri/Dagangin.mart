<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\ProdukModel;
use App\Models\KategoriModel; // Add this import

class Keranjang extends BaseController
{
    protected $keranjangModel;
    protected $produkModel;
    protected $kategoriModel; // Add this property
    protected $session;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel(); // Initialize kategori model
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        // Cek apakah user sudah login
        if (!$this->session->get('customer_logged_in')) {
            return redirect()->to(base_url('login-customer'));
        }

        $customer_id = $this->session->get('customer_id');
        $data = [
            'title' => 'Keranjang Saya',
            'keranjang' => $this->keranjangModel->getKeranjangByCustomer($customer_id),
            'total_harga' => $this->keranjangModel->getTotalHarga($customer_id),
            'kategori' => $this->kategoriModel->findAll(), // Add kategori data
            'produk' => [], // Add empty produk array for template compatibility
            'search' => '', // Add search variable
            'selected_kategori' => '', // Add selected kategori variable
            'selected_sort' => '' // Add selected sort variable
        ];

        return view('pages/user/keranjang', $data);
    }

    public function add()
    {
        // Cek apakah user sudah login
        if (!$this->session->get('customer_logged_in')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Silakan login terlebih dahulu'
            ]);
        }

        $produk_id = $this->request->getPost('produk_id');
        $jumlah = $this->request->getPost('jumlah') ?? 1;
        $customer_id = $this->session->get('customer_id');

        // Validasi produk
        $produk = $this->produkModel->find($produk_id);
        if (!$produk) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ]);
        }

        // Cek stok
        if ($produk['stok'] < $jumlah) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Stok tidak mencukupi'
            ]);
        }

        $data = [
            'customer_id' => $customer_id,
            'produk_id' => $produk_id,
            'jumlah' => $jumlah
        ];

        if ($this->keranjangModel->addToKeranjang($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Berhasil ditambahkan ke keranjang',
                'jumlah_item' => $this->keranjangModel->getJumlahItem($customer_id)
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menambahkan ke keranjang'
            ]);
        }
    }

    public function update()
    {
        if (!$this->session->get('customer_logged_in')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized'
            ]);
        }

        $id = $this->request->getPost('id');
        $jumlah = $this->request->getPost('jumlah');
        $customer_id = $this->session->get('customer_id');

        if ($jumlah <= 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Jumlah tidak valid'
            ]);
        }

        if ($this->keranjangModel->updateJumlah($id, $jumlah)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Keranjang berhasil diupdate',
                'total_harga' => $this->keranjangModel->getTotalHarga($customer_id)
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal mengupdate keranjang'
            ]);
        }
    }

    public function remove()
    {
        if (!$this->session->get('customer_logged_in')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized'
            ]);
        }

        $id = $this->request->getPost('id');
        $customer_id = $this->session->get('customer_id');

        if ($this->keranjangModel->removeFromKeranjang($id, $customer_id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Item berhasil dihapus',
                'total_harga' => $this->keranjangModel->getTotalHarga($customer_id),
                'jumlah_item' => $this->keranjangModel->getJumlahItem($customer_id)
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus item'
            ]);
        }
    }

    public function getCount()
    {
        if (!$this->session->get('customer_logged_in')) {
            return $this->response->setJSON(['count' => 0]);
        }

        $customer_id = $this->session->get('customer_id');
        return $this->response->setJSON([
            'count' => $this->keranjangModel->getJumlahItem($customer_id)
        ]);
    }

    
}