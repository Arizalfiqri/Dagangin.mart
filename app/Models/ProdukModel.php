<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kategori_id', 'nama', 'harga', 'foto', 'detail', 'ketersediaan_stok', 'stok'];
    
    public function getProdukWithKategori($limit = null, $search = null, $kategori_id = null, $sort = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('produk.*, kategori.nama as nama_kategori');
        $builder->join('kategori', 'kategori.id = produk.kategori_id', 'left');

        if ($search) {
            // Buat pencarian tidak case-sensitive dan fleksibel
            $search = strtolower($search);
            $builder->groupStart()
                    ->like('LOWER(produk.nama)', $search)
                    ->orLike('LOWER(produk.detail)', $search)
                    ->groupEnd();
        }

        if ($kategori_id) {
            $builder->where('produk.kategori_id', $kategori_id);
        }

        // Tambahkan sorting
        if ($sort) {
            switch ($sort) {
                case 'price_low':
                    $builder->orderBy('produk.harga', 'ASC');
                    break;
                case 'price_high':
                    $builder->orderBy('produk.harga', 'DESC');
                    break;
                case 'name_asc':
                    $builder->orderBy('produk.nama', 'ASC');
                    break;
                case 'name_desc':
                    $builder->orderBy('produk.nama', 'DESC');
                    break;
                case 'newest':
                    $builder->orderBy('produk.id', 'DESC');
                    break;
                default:
                    $builder->orderBy('produk.id', 'DESC');
            }
        } else {
            $builder->orderBy('produk.id', 'DESC');
        }

        if ($limit) {
            $builder->limit($limit);
        }

        return $builder->get()->getResultArray();
    }

    
    public function searchProduk($keyword)
    {
        return $this->like('nama', $keyword)
                ->orLike('detail', $keyword)
                ->findAll();
    }
}