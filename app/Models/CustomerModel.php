<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 
        'email', 
        'no_hp', 
        'password',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'kota',
        'kode_pos',
        'foto_profil',
        'created_at',
        'updated_at'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Hash password sebelum insert atau update
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // Method untuk mendapatkan data customer lengkap
    public function getCustomerProfile($id)
    {
        return $this->select('id, username, email, no_hp, nama_lengkap, tanggal_lahir, jenis_kelamin, alamat, kota, kode_pos, foto_profil, created_at')
                    ->where('id', $id)
                    ->first();
    }

    public function updateProfile($id, $data)
    {
        // Remove password from data if empty
        if (isset($data['password']) && empty($data['password'])) {
            unset($data['password']);
        }
        
        return $this->update($id, $data);
    }
}