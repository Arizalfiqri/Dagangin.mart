<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;

class User extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;
    
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }
    
    public function index(): string
    {
        // Ambil parameter pencarian dan filter
        $search = $this->request->getGet('search');
        $kategori_id = $this->request->getGet('kategori');
        $sort = $this->request->getGet('sort');
        
        // Ambil data produk dengan filter
        $produk = $this->produkModel->getProdukWithKategori(null, $search, $kategori_id, $sort);
        
        // Ambil semua kategori untuk dropdown
        $kategori = $this->kategoriModel->findAll();
        
        $data = [
            'title' => 'Beranda',
            'produk' => $produk,
            'kategori' => $kategori,
            'search' => $search,
            'selected_kategori' => $kategori_id,
            'selected_sort' => $sort
        ];
        
        return view('pages/user/homepage', $data);
    }
    
    public function allProduct(): string
    {
        // Ambil parameter pencarian dan filter
        $search = $this->request->getGet('search');
        $kategori_id = $this->request->getGet('kategori');
        $sort = $this->request->getGet('sort');
        
        // Ambil data produk dengan filter
        $produk = $this->produkModel->getProdukWithKategori(null, $search, $kategori_id, $sort);
        
        // Ambil semua kategori untuk dropdown
        $kategori = $this->kategoriModel->findAll();
        
        $data = [
            'title' => 'Semua Produk',
            'produk' => $produk,
            'kategori' => $kategori,
            'search' => $search,
            'selected_kategori' => $kategori_id,
            'selected_sort' => $sort
        ];
        
        return view('pages/user/product', $data);
    }

    public function detailProduct($encodedId): string
    {
        // Restore base64 padding dan karakter URL-safe
        $encodedId = str_replace(['-', '_'], ['+', '/'], $encodedId);
        // Tambahkan padding jika diperlukan
        $encodedId = str_pad($encodedId, strlen($encodedId) + (4 - strlen($encodedId) % 4) % 4, '=', STR_PAD_RIGHT);
        
        // Decode ID dari base64
        $id = base64_decode($encodedId);
        
        // Validasi apakah hasil decode adalah angka
        if (!is_numeric($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan');
        }
        
        // Ambil data produk berdasarkan ID
        $produk = $this->produkModel->find($id);
    
        if (!$produk) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan');
        }
    
        // Ambil data kategori untuk produk ini
        $kategori = $this->kategoriModel->find($produk['kategori_id']);
    
        // Ambil produk rekomendasi (produk lain dari kategori yang sama)
        $rekomendasi = $this->produkModel->getProdukWithKategori(6, null, $produk['kategori_id']);
    
        // Hapus produk saat ini dari rekomendasi
        $rekomendasi = array_filter($rekomendasi, function($item) use ($id) {
            return $item['id'] != $id;
        });
    
        // Batasi rekomendasi maksimal 5 produk
        $rekomendasi = array_slice($rekomendasi, 0, 5);
    
        $data = [
            'title' => $produk['nama'],
            'produk' => $produk,
            'kategori' => $kategori,
            'rekomendasi' => $rekomendasi
        ];
    
        return view('pages/user/product_detail', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang Kami - Dagangin.Mart',
            'meta_description' => 'Tentang Dagangin.Mart - Solusi belanja kebutuhan sehari-hari yang praktis, cepat, dan terpercaya untuk masyarakat modern.',
            'canonical_url' => base_url('about'),
            'team_members' => $this->getTeamData()
        ];

        return view('pages/user/about_us', $data);
    }

    protected function getTeamData()
    {
        return [
            [
                'name' => 'Arizal Fiqri',
                'position' => 'Project Manager, Developer',
                'roles' => ['pm', 'dev'],
                'icon' => 'fa-user-tie'
            ],
            [
                'name' => 'Yovy Agustin Ulandari',
                'position' => 'Designer, Developer',
                'roles' => ['design', 'dev'],
                'icon' => 'fa-paint-brush'
            ],
            [
                'name' => 'Dewi Maharani',
                'position' => 'System Analyst',
                'roles' => ['analysis'],
                'icon' => 'fa-chart-line'
            ],
            [
                'name' => 'Eli Susanti',
                'position' => 'Quality Assurance',
                'roles' => ['testing'],
                'icon' => 'fa-bug'
            ],
            [
                'name' => 'Sella Dwi Juliani',
                'position' => 'Documentation Specialist',
                'roles' => ['docs'],
                'icon' => 'fa-file-alt'
            ]
        ];
    }
}