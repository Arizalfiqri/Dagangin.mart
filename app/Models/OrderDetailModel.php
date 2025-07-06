<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table = 'order_detail';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'order_id',
        'produk_id', 
        'jumlah',
        'harga_satuan'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'order_id' => 'required|max_length[100]',
        'produk_id' => 'required|integer',
        'jumlah' => 'required|integer|greater_than[0]',
        'harga_satuan' => 'required|decimal'
    ];

    protected $validationMessages = [
        'order_id' => [
            'required' => 'Order ID harus diisi',
            'max_length' => 'Order ID maksimal 100 karakter'
        ],
        'produk_id' => [
            'required' => 'Produk ID harus diisi',
            'integer' => 'Produk ID harus berupa angka'
        ],
        'jumlah' => [
            'required' => 'Jumlah harus diisi',
            'integer' => 'Jumlah harus berupa angka',
            'greater_than' => 'Jumlah minimal 1'
        ],
        'harga_satuan' => [
            'required' => 'Harga satuan harus diisi',
            'decimal' => 'Harga satuan harus berupa angka'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Get order details with product information
     */
    public function getOrderDetailsWithProduct($orderId)
    {
        return $this->select('order_detail.*, produk.nama, produk.foto')
                    ->join('produk', 'produk.id = order_detail.produk_id')
                    ->where('order_detail.order_id', $orderId)
                    ->findAll();
    }

    /**
     * Get order details by order ID
     */
    public function getByOrderId($orderId)
    {
        return $this->where('order_id', $orderId)->findAll();
    }

    /**
     * Calculate total for an order
     */
    public function calculateOrderTotal($orderId)
    {
        $result = $this->selectSum('jumlah * harga_satuan', 'total')
                    ->where('order_id', $orderId)
                    ->first();
        
        return $result['total'] ?? 0;
    }

    /**
     * Get order details with complete product info
     */
    public function getCompleteOrderDetails($orderId)
    {
        return $this->select('
                        order_detail.*,
                        produk.nama as nama_produk,
                        produk.foto,
                        produk.deskripsi,
                        kategori.nama as nama_kategori
                    ')
                    ->join('produk', 'produk.id = order_detail.produk_id')
                    ->join('kategori', 'kategori.id = produk.kategori_id', 'left')
                    ->where('order_detail.order_id', $orderId)
                    ->findAll();
    }

    /**
     * Delete order details by order ID
     */
    public function deleteByOrderId($orderId)
    {
        return $this->where('order_id', $orderId)->delete();
    }

    /**
     * Get product sales statistics
     */
    public function getProductSalesStats($startDate = null, $endDate = null)
    {
        $builder = $this->select('
                            produk.id,
                            produk.nama,
                            SUM(order_detail.jumlah) as total_terjual,
                            SUM(order_detail.jumlah * order_detail.harga_satuan) as total_pendapatan
                        ')
                        ->join('produk', 'produk.id = order_detail.produk_id')
                        ->join('pesanan', 'pesanan.order_id = order_detail.order_id')
                        ->groupBy('produk.id, produk.nama')
                        ->orderBy('total_terjual', 'DESC');

        if ($startDate) {
            $builder->where('pesanan.tanggal >=', $startDate);
        }
        
        if ($endDate) {
            $builder->where('pesanan.tanggal <=', $endDate);
        }

        return $builder->findAll();
    }
}