<?php
namespace App\Models;
use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'order_id';  // Ubah dari 'id' ke 'order_id'
    protected $useAutoIncrement = false;  // Karena order_id adalah varchar, bukan auto increment
    protected $returnType = 'array';
    protected $allowedFields = [
        'customer_id', 
        'order_id',
        'status', 
        'tanggal', 
        'total', 
        'notification_read'
    ];
    
    protected $useTimestamps = false;
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}