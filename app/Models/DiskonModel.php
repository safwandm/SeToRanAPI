<?php
namespace App\Models;

use CodeIgniter\Model;

class DiskonModel extends Model
{
    protected $table = 'diskon';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'nama_promo',
        'status_promo',
        'tgl_mulai',
        'tgl_akhir'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    // Get all discounts with optional filter
    public function getDiskon($status = null)
    {
        $builder = $this->builder();
        
        if ($status !== null) {
            $builder->where('status_promo', $status);
        }
        
        return $builder->get()->getResultArray();
    }
    
    // Get single discount by ID
    public function getDiskonById($id)
    {
        return $this->where('id', $id)->first();
    }
    
    // Add new discount
    public function addDiskon($data)
    {
        return $this->insert($data);
    }
    
    // Update discount
    public function updateDiskon($id, $data)
    {
        return $this->update($id, $data);
    }
    
    // Delete discount
    public function deleteDiskon($id)
    {
        return $this->delete($id);
    }
    
    // Check if discount is active
    public function isActive($id)
    {
        $diskon = $this->getDiskonById($id);
        $currentDate = date('Y-m-d');
        
        return (
            $diskon['status_promo'] === 'Aktif' &&
            $currentDate >= $diskon['tgl_mulai'] &&
            $currentDate <= $diskon['tgl_akhir']
        );
    }
}