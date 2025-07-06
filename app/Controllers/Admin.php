<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\PesananModel;
use App\Models\CustomerModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    protected $session;
    protected $produkModel;
    protected $kategoriModel;
    protected $pesananModel;
    protected $customerModel;
    protected $UserModel;
    
    public function __construct()
    {
        $this->session = session();
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
        $this->pesananModel = new PesananModel();
        $this->customerModel = new CustomerModel();
        $this->UserModel = new UserModel();
    }
    
    public function index(): string
    {
        // Get dashboard statistics
        $data = [
            'title' => 'Dashboard Admin',
            'totalProducts' => $this->produkModel->countAll(),
            'totalCategories' => $this->kategoriModel->countAll(),
            'totalCustomers' => $this->customerModel->countAll(),
            'totalOrders' => $this->pesananModel->countAll(),
            'totalUsers' => $this->UserModel->countAll(),
           
            // Get products by category for chart
            'productsByCategory' => $this->getProductsByCategory(),
           
            // Get orders by status
            'ordersByStatus' => $this->getOrdersByStatus(),
           
            // Get monthly sales data
            'monthlySales' => $this->getMonthlySales(),
           
            // Get stock status
            'stockStatus' => $this->getStockStatus(),
            
            // Get new orders for modal notification
            'pesanan_baru' => $this->getNewOrdersData()
        ];
       
        return view('pages/admin/dashboard', $data);
    }
    
    // Method untuk mendapatkan pesanan baru (AJAX)
    public function getNewOrders()
    {
        if ($this->request->isAJAX()) {
            $newOrders = $this->getNewOrdersData();
            return $this->response->setJSON($newOrders);
        }
        
        return $this->response->setStatusCode(403);
    }
    
    // Helper method untuk mendapatkan data pesanan baru
    private function getNewOrdersData()
    {
        try {
            // Ambil pesanan dengan status 'Dikemas' atau pesanan dalam 24 jam terakhir
            $builder = $this->pesananModel->builder();
            $builder->select('order_id, customer_id, status, tanggal, total');
            $builder->groupStart();
            $builder->where('status', 'Dikemas');
            $builder->orWhere('tanggal >=', date('Y-m-d H:i:s', strtotime('-24 hours')));
            $builder->groupEnd();
            $builder->orderBy('tanggal', 'DESC');
            $builder->limit(10); // Batasi hanya 10 pesanan terbaru
            
            $result = $builder->get()->getResultArray();
            
            return $result ?: []; // Return empty array if null
        } catch (\Exception $e) {
            log_message('error', 'Error getting new orders: ' . $e->getMessage());
            return [];
        }
    }

    private function getProductsByCategory()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT k.nama as kategori, COUNT(p.id) as jumlah_produk 
            FROM kategori k 
            LEFT JOIN produk p ON k.id = p.kategori_id 
            GROUP BY k.id, k.nama
        ");
        return $query->getResultArray();
    }

    private function getOrdersByStatus()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT status, COUNT(*) as jumlah 
            FROM pesanan 
            GROUP BY status
        ");
        return $query->getResultArray();
    }

    private function getMonthlySales()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT 
                DATE_FORMAT(tanggal, '%Y-%m') as bulan,
                COUNT(*) as jumlah_pesanan,
                SUM(total) as total_penjualan
            FROM pesanan 
            WHERE tanggal >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
            GROUP BY DATE_FORMAT(tanggal, '%Y-%m')
            ORDER BY bulan ASC
        ");
        return $query->getResultArray();
    }

    private function getStockStatus()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT 
                CASE 
                    WHEN stok = 0 THEN 'Habis'
                    WHEN stok <= 10 THEN 'Stok Rendah'
                    WHEN stok <= 50 THEN 'Stok Normal'
                    ELSE 'Stok Banyak'
                END as status_stok,
                COUNT(*) as jumlah_produk
            FROM produk 
            GROUP BY 
                CASE 
                    WHEN stok = 0 THEN 'Habis'
                    WHEN stok <= 10 THEN 'Stok Rendah'
                    WHEN stok <= 50 THEN 'Stok Normal'
                    ELSE 'Stok Banyak'
                END
        ");
        return $query->getResultArray();
    }
    

    public function produk(): string
    {
        $search = $this->request->getGet('search');
        $kategori_id = $this->request->getGet('kategori');
        
        $produk = $this->produkModel->getProdukWithKategori(null, $search, $kategori_id);
        $kategori = $this->kategoriModel->findAll();
        
        $data = [
            'title' => 'Produk',
            'produk' => $produk,
            'kategori' => $kategori,
            'search' => $search,
            'selected_kategori' => $kategori_id
        ];
        
        return view('pages/admin/produk', $data);
    }
    
    public function tambahProduk()
    {
        if ($this->request->getMethod() === 'POST') {
            $validation = \Config\Services::validation();
            
            $validation->setRules([
                'nama' => 'required|min_length[3]',
                'harga' => 'required|numeric',
                'kategori_id' => 'required|numeric',
                'ketersediaan_stok' => 'required|in_list[tersedia,habis]',
                'stok' => 'required|integer|greater_than_equal_to[0]',
                'detail' => 'permit_empty'
            ]);
            
            if ($validation->withRequest($this->request)->run()) {
                $foto = '';
                $file = $this->request->getFile('foto');
                
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $foto = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/uploads/produk/', $foto);
                }
                
                $data = [
                    'nama' => $this->request->getPost('nama'),
                    'harga' => $this->request->getPost('harga'),
                    'kategori_id' => $this->request->getPost('kategori_id'),
                    'ketersediaan_stok' => $this->request->getPost('ketersediaan_stok'),
                    'stok' => $this->request->getPost('stok'),
                    'detail' => $this->request->getPost('detail'),
                    'foto' => $foto
                ];
                
                if ($this->produkModel->insert($data)) {
                    return redirect()->to('/admin/produk')->with('success', 'Produk berhasil ditambahkan');
                } else {
                    return redirect()->back()->with('error', 'Gagal menambahkan produk');
                }
            } else {
                return redirect()->back()->with('errors', $validation->getErrors());
            }
        }
        
        $kategori = $this->kategoriModel->findAll();
        $data = [
            'title' => 'Tambah Produk',
            'kategori' => $kategori
        ];
        
        return view('pages/admin/tambah_produk', $data);
    }
    
    public function editProduk($id)
    {
        $produk = $this->produkModel->find($id);
        if (!$produk) {
            return redirect()->to('/admin/produk')->with('error', 'Produk tidak ditemukan');
        }
        
        if ($this->request->getMethod() === 'POST') {
            $validation = \Config\Services::validation();
            
            $validation->setRules([
                'nama' => 'required|min_length[3]',
                'harga' => 'required|numeric',
                'kategori_id' => 'required|numeric',
                'ketersediaan_stok' => 'required|in_list[tersedia,habis]',
                'stok' => 'required|integer|greater_than_equal_to[0]',
                'detail' => 'permit_empty'
            ]);
            
            if ($validation->withRequest($this->request)->run()) {
                $foto = $produk['foto'];
                $file = $this->request->getFile('foto');
                
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    // Hapus foto lama jika ada
                    if ($foto && file_exists(ROOTPATH . 'public/uploads/produk/' . $foto)) {
                        unlink(ROOTPATH . 'public/uploads/produk/' . $foto);
                    }
                    
                    $foto = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/uploads/produk/', $foto);
                }
                
                $data = [
                    'nama' => $this->request->getPost('nama'),
                    'harga' => $this->request->getPost('harga'),
                    'kategori_id' => $this->request->getPost('kategori_id'),
                    'ketersediaan_stok' => $this->request->getPost('ketersediaan_stok'),
                    'stok' => $this->request->getPost('stok'),
                    'detail' => $this->request->getPost('detail'),
                    'foto' => $foto
                ];
                
                if ($this->produkModel->update($id, $data)) {
                    return redirect()->to('/admin/produk')->with('success', 'Produk berhasil diupdate');
                } else {
                    return redirect()->back()->with('error', 'Gagal mengupdate produk');
                }
            } else {
                return redirect()->back()->with('errors', $validation->getErrors());
            }
        }
        
        $kategori = $this->kategoriModel->findAll();
        $data = [
            'title' => 'Edit Produk',
            'produk' => $produk,
            'kategori' => $kategori
        ];
        
        return view('pages/admin/edit_produk', $data);
    }
    
    public function hapusProduk($id)
    {
        $produk = $this->produkModel->find($id);
        if (!$produk) {
            return redirect()->to('/admin/produk')->with('error', 'Produk tidak ditemukan');
        }

        // Hapus foto jika ada
        if ($produk['foto'] && file_exists(ROOTPATH . 'public/uploads/produk/' . $produk['foto'])) {
            unlink(ROOTPATH . 'public/uploads/produk/' . $produk['foto']);
        }

        // Hapus dulu dari keranjang
        $db = \Config\Database::connect();
        $db->table('keranjang')->where('produk_id', $id)->delete();

        // Hapus produk
        if ($this->produkModel->delete($id)) {
            return redirect()->to('/admin/produk')->with('success', 'Produk dan data keranjang berhasil dihapus');
        } else {
            return redirect()->to('/admin/produk')->with('error', 'Gagal menghapus produk');
        }
    }


    public function customer(): string
    {
        $db = \Config\Database::connect();
        $builder = $db->table('customer');
        $query = $builder->get(); // ambil semua data

        $data = [
            'title' => 'Customer',
            'customers' => $query->getResultArray() // kirim ke view
        ];

        return view('pages/admin/customer', $data);
    }

    public function editCustomer($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('customer');
        $data['customer'] = $builder->where('id', $id)->get()->getRowArray();
        $data['title'] = 'Edit Customer';

        return view('pages/admin/edit_customer', $data);
    }

    public function updateCustomer($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('customer');

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
        ];

        $builder->where('id', $id)->update($data);
        return redirect()->to('/admin/customer')->with('msg', 'Data berhasil diupdate');
    }

    public function deleteCustomer($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('customer');
        $builder->where('id', $id)->delete();

        return redirect()->to('/admin/customer')->with('msg', 'Data berhasil dihapus');
    }



    public function kategori(): string
    {
        $kategori = $this->kategoriModel->findAll();
        $data = [
            'title' => 'Kategori Produk',
            'kategori' => $kategori
        ];
        return view('pages/admin/kategori', $data);
    }

    public function tambahKategori()
    {
        if ($this->request->getMethod() === 'POST') {
            $validation = \Config\Services::validation();
            
            $validation->setRules([
                'nama' => 'required|max_length[100]'
            ]);
            
            if ($validation->withRequest($this->request)->run()) {
                $data = [
                    'nama' => $this->request->getPost('nama')
                ];
                
                if ($this->kategoriModel->insert($data)) {
                    return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil ditambahkan');
                } else {
                    return redirect()->back()->with('error', 'Gagal menambahkan kategori');
                }
            } else {
                return redirect()->back()->with('errors', $validation->getErrors());
            }
        }
        
        return view('pages/admin/tambah_kategori', [
            'title' => 'Tambah Kategori'
        ]);
    }

    public function hapusKategori($id)
    {
        // Cek apakah kategori digunakan oleh produk
        $produkTerkait = $this->produkModel->where('kategori_id', $id)->countAllResults();

        if ($produkTerkait > 0) {
            // Redirect ke halaman edit, bukan halaman list
            return redirect()->to('/admin/kategori/edit/' . $id)->with('error', 'Kategori tidak bisa dihapus karena masih ada produk yang menggunakan kategori ini!');
        }

        // Jika tidak digunakan, hapus kategori
        if ($this->kategoriModel->delete($id)) {
            return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil dihapus');
        } else {
            return redirect()->to('/admin/kategori/edit/' . $id)->with('error', 'Gagal menghapus kategori');
        }
    }


    public function editKategori($id)
    {
        $kategori = $this->kategoriModel->find($id);
        if (!$kategori) {
            return redirect()->to('/admin/kategori')->with('error', 'Kategori tidak ditemukan');
        }

        if ($this->request->getMethod() === 'POST') {
            $validation = \Config\Services::validation();

            $validation->setRules([
                'nama' => 'required|max_length[100]'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $data = ['nama' => $this->request->getPost('nama')];

                if ($this->kategoriModel->update($id, $data)) {
                    return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil diupdate');
                } else {
                    return redirect()->back()->with('error', 'Gagal mengupdate kategori');
                }
            } else {
                return redirect()->back()->with('errors', $validation->getErrors());
            }
        }

        return view('pages/admin/edit_kategori', [
            'title' => 'Edit Kategori',
            'kategori' => $kategori
        ]);
    }

    public function pesanan()
    {
        $pesananModel = new PesananModel();
        
        $data = [
            'title' => 'Pesanan Customer',
            'pesanan' => $pesananModel
                ->select('pesanan.*, customer.username as nama_customer')
                ->join('customer', 'customer.id = pesanan.customer_id')
                ->orderBy('tanggal', 'DESC')
                ->findAll()
        ];

        return view('pages/admin/pesanan', $data);
    }

    public function ubahStatusPesanan($orderId)
    {
        $status = $this->request->getPost('status');
        $pesananModel = new PesananModel();

        // Gunakan order_id sebagai kondisi where
        $result = $pesananModel->where('order_id', $orderId)->set(['status' => $status])->update();
        
        if ($result) {
            return redirect()->to('/admin/pesanan')->with('success', 'Status pesanan berhasil diupdate!');
        } else {
            return redirect()->to('/admin/pesanan')->with('error', 'Gagal mengupdate status pesanan!');
        }
    }

    public function hapusPesanan($orderId)
    {
        $pesananModel = new PesananModel();
        // Gunakan order_id sebagai kondisi where
        $pesananModel->where('order_id', $orderId)->delete();

        return redirect()->to('/admin/pesanan');
    }

    public function detailPesanan($id)
    {
        $pesananModel = new PesananModel();
        $customerModel = new CustomerModel();
        
        // Ambil data pesanan dengan join ke customer
        $pesanan = $pesananModel
            ->select('pesanan.*, customer.username as nama_customer, pembayaran.alamat, pembayaran.email, pembayaran.no_hp')
            ->join('customer', 'customer.id = pesanan.customer_id')
            ->join('pembayaran', 'pembayaran.order_id = pesanan.order_id')
            ->where('pesanan.order_id', $id)
            ->first();

        
        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan');
        }
        
        // Ambil detail order dari tabel order_detail
        $db = \Config\Database::connect();
        $builder = $db->table('order_detail');
        $orderDetails = $builder
            ->select('order_detail.*, produk.nama as nama_produk')
            ->join('produk', 'produk.id = order_detail.produk_id')
            ->where('order_detail.order_id', $id)
            ->get()
            ->getResultArray();
        
        $data = [
            'title' => 'Detail Pesanan #' . $id,
            'pesanan' => $pesanan,
            'order_details' => $orderDetails
        ];
        
        return view('pages/admin/detail_pesanan', $data);
    }


}