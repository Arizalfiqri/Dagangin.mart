<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['produk_id', 'jumlah', 'tanggal', 'customer_id'];
    protected $useTimestamps = false;

    public function getKeranjangByCustomer($customer_id)
    {
        return $this->db->table($this->table)
                    ->select('keranjang.*, produk.nama, produk.harga, produk.foto')
                    ->join('produk', 'produk.id = keranjang.produk_id')
                    ->where('keranjang.customer_id', $customer_id)
                    ->get()
                    ->getResultArray();
    }

    // Method baru untuk checkout dengan informasi lengkap produk
    public function getKeranjangWithProduk($customer_id)
    {
        return $this->select('keranjang.*, produk.nama, produk.harga, produk.foto, produk.stok, kategori.nama as kategori_nama')
                    ->join('produk', 'produk.id = keranjang.produk_id')
                    ->join('kategori', 'kategori.id = produk.kategori_id', 'left')
                    ->where('keranjang.customer_id', $customer_id)
                    ->findAll();
    }

    public function addToKeranjang($data)
    {
        // Cek apakah produk sudah ada di keranjang
        $existing = $this->where('customer_id', $data['customer_id'])
                        ->where('produk_id', $data['produk_id'])
                        ->first();

        if ($existing) {
            // Update jumlah jika sudah ada
            return $this->update($existing['id'], [
                'jumlah' => $existing['jumlah'] + $data['jumlah']
            ]);
        } else {
            // Tambah item baru
            $data['tanggal'] = date('Y-m-d H:i:s');
            return $this->save($data);
        }
    }

    public function updateJumlah($id, $jumlah)
    {
        return $this->update($id, ['jumlah' => $jumlah]);
    }

    public function removeFromKeranjang($id, $customer_id)
    {
        return $this->where('id', $id)
                ->where('customer_id', $customer_id)
                ->delete();
    }

    public function getTotalHarga($customer_id)
    {
        $result = $this->db->table($this->table)
                          ->select('SUM(keranjang.jumlah * produk.harga) as total')
                        ->join('produk', 'produk.id = keranjang.produk_id')
                        ->where('keranjang.customer_id', $customer_id)
                        ->get()
                        ->getRowArray();
        
        return $result['total'] ?? 0;
    }

    public function getJumlahItem($customer_id)
    {
        $result = $this->where('customer_id', $customer_id)
                    ->selectSum('jumlah', 'total_quantity')
                    ->get()
                    ->getRow();
        
        return $result->total_quantity ?? 0;
    }

    public function clearKeranjang($customer_id)
    {
        return $this->where('customer_id', $customer_id)->delete();
    }

    // Method tambahan untuk validasi stok sebelum checkout
    public function validateStok($customer_id)
    {
        $keranjang = $this->getKeranjangWithProduk($customer_id);
        $errors = [];
        
        foreach ($keranjang as $item) {
            if ($item['jumlah'] > $item['stok']) {
                $errors[] = [
                    'produk' => $item['nama'],
                    'jumlah_diminta' => $item['jumlah'],
                    'stok_tersedia' => $item['stok']
                ];
            }
        }
        
        return $errors;
    }

    // Method untuk mengecek apakah keranjang kosong
    public function isKeranjangEmpty($customer_id)
    {
        $count = $this->where('customer_id', $customer_id)->countAllResults();
        return $count == 0;
    }

    // Method untuk mendapatkan ringkasan keranjang
    public function getKeranjangSummary($customer_id)
    {
        $items = $this->getKeranjangWithProduk($customer_id);
        $total_items = 0;
        $total_harga = 0;
        
        foreach ($items as $item) {
            $total_items += $item['jumlah'];
            $total_harga += ($item['jumlah'] * $item['harga']);
        }
        
        return [
            'total_items' => $total_items,
            'total_harga' => $total_harga,
            'items' => $items
        ];
    }
}