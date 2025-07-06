<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\ProdukModel;
use App\Models\CustomerModel;
use App\Models\PesananModel;
use App\Models\OrderDetailModel;

class Checkout extends BaseController
{
    protected $keranjangModel;
    protected $produkModel;
    protected $customerModel;
    protected $pesananModel;
    protected $orderDetailModel;
    protected $session;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
        $this->customerModel = new CustomerModel();
        $this->pesananModel = new PesananModel();
        $this->orderDetailModel = new OrderDetailModel();
        $this->session = session();
    }

    public function index()
    {
        // Cek apakah user sudah login
        if (!$this->session->get('customer_logged_in')) {
            return redirect()->to('/login-customer')->with('error', 'Silakan login terlebih dahulu untuk melanjutkan checkout');
        }

        $customer_id = $this->session->get('customer_id');
        
        // Ambil data keranjang customer
        $keranjang = $this->keranjangModel->getKeranjangWithProduk($customer_id);
        
        if (empty($keranjang)) {
            return redirect()->to('/keranjang')->with('error', 'Keranjang Anda kosong');
        }

        // Ambil data customer untuk informasi pengiriman
        $customer = $this->customerModel->find($customer_id);

        // Hitung total
        $total_harga = 0;
        foreach ($keranjang as $item) {
            $total_harga += $item['harga'] * $item['jumlah'];
        }

        $data = [
            'title' => 'Checkout',
            'keranjang' => $keranjang,
            'customer' => $customer,
            'total_harga' => $total_harga
        ];

        return view('pages/user/checkout', $data);
    }

    public function process()
    {
        if (!$this->session->get('customer_logged_in')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Anda harus login terlebih dahulu'
            ]);
        }

        $customer_id = $this->session->get('customer_id');
        
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]',
            'alamat' => 'required|min_length[10]',
            'no_hp' => 'required|min_length[10]',
            'email' => 'required|valid_email'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak valid',
                'errors' => $validation->getErrors()
            ]);
        }

        // Ambil data keranjang
        $keranjang = $this->keranjangModel->getKeranjangWithProduk($customer_id);
        
        if (empty($keranjang)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Keranjang kosong'
            ]);
        }

        // Hitung total
        $total = 0;
        foreach ($keranjang as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Generate order ID
            $order_id = 'ORD-' . date('YmdHis') . '-' . $customer_id;
            
            // Simpan ke tabel pesanan
            $pesanan_data = [
                'customer_id' => $customer_id,
                'order_id' => $order_id,
                'status' => 'Dikemas',
                'tanggal' => date('Y-m-d H:i:s'),
                'total' => $total,
                'notification_read' => 0
            ];
            
            // Insert menggunakan order_id sebagai primary key
            $this->pesananModel->insert($pesanan_data);

            // Simpan ke tabel pembayaran
            $pembayaran_data = [
                'nama' => $this->request->getPost('nama'),
                'alamat' => $this->request->getPost('alamat'),
                'biaya' => $total,
                'order_id' => $order_id,
                'transaction_status' => 'Selesai',
                'transaction_id' => 'TXN-' . time(),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp')
            ];
            
            $pembayaran_model = new \App\Models\PembayaranModel();
            $pembayaran_model->insert($pembayaran_data);

            // Simpan detail pesanan
            foreach ($keranjang as $item) {
                $detail_data = [
                    'order_id' => $order_id,
                    'produk_id' => $item['produk_id'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga']
                ];
                
                $this->orderDetailModel->insert($detail_data);

                // Update stok produk
                $produk = $this->produkModel->find($item['produk_id']);
                if ($produk) {
                    $stok_baru = $produk['stok'] - $item['jumlah'];
                    $this->produkModel->update($item['produk_id'], ['stok' => $stok_baru]);
                }
            }

            // Hapus keranjang setelah checkout berhasil
            $this->keranjangModel->where('customer_id', $customer_id)->delete();

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat memproses pesanan'
                ]);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pesanan berhasil dibuat',
                'order_id' => $order_id
            ]);

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Checkout error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}