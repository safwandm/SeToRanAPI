<?php
namespace App\Controllers;

use App\Models\DiskonModel;
use CodeIgniter\RESTful\ResourceController;

class DiskonController extends ResourceController
{
    protected $diskonModel;
    protected $format = 'json';

    public function __construct()
    {
        $this->diskonModel = new DiskonModel();
    }

    // GET /api/diskon
    public function index()
    {
        $status = $this->request->getGet('status');
        $data = $this->diskonModel->getDiskon($status);
        
        return $this->respond([
            'status' => 200,
            'data' => $data
        ]);
    }

    // GET /api/diskon/{id}
    public function show($id = null)
    {
        $data = $this->diskonModel->getDiskonById($id);
        
        if ($data) {
            return $this->respond([
                'status' => 200,
                'data' => $data
            ]);
        }
        
        return $this->failNotFound('Diskon tidak ditemukan');
    }

    // POST /api/diskon
    public function create()
    {
        $rules = [
            'id' => 'required|min_length[6]|is_unique[diskon.id]',
            'nama_promo' => 'required',
            'status_promo' => 'required|in_list[Aktif,Non Aktif]',
            'tgl_mulai' => 'required|valid_date',
            'tgl_akhir' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'id' => $this->request->getPost('id'),
            'nama_promo' => $this->request->getPost('nama_promo'),
            'status_promo' => $this->request->getPost('status_promo'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_akhir' => $this->request->getPost('tgl_akhir')
        ];

        if ($this->diskonModel->addDiskon($data)) {
            return $this->respondCreated([
                'status' => 201,
                'message' => 'Diskon berhasil ditambahkan',
                'data' => $data
            ]);
        }

        return $this->fail('Gagal menambahkan diskon');
    }

    // PUT /api/diskon/{id}
    public function update($id = null)
    {
        $rules = [
            'nama_promo' => 'required',
            'status_promo' => 'required|in_list[Aktif,Non Aktif]',
            'tgl_mulai' => 'required|valid_date',
            'tgl_akhir' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'nama_promo' => $this->request->getRawInput()['nama_promo'],
            'status_promo' => $this->request->getRawInput()['status_promo'],
            'tgl_mulai' => $this->request->getRawInput()['tgl_mulai'],
            'tgl_akhir' => $this->request->getRawInput()['tgl_akhir']
        ];

        if ($this->diskonModel->updateDiskon($id, $data)) {
            return $this->respond([
                'status' => 200,
                'message' => 'Diskon berhasil diupdate',
                'data' => $data
            ]);
        }

        return $this->fail('Gagal mengupdate diskon');
    }

    // DELETE /api/diskon/{id}
    public function delete($id = null)
    {
        if ($this->diskonModel->deleteDiskon($id)) {
            return $this->respondDeleted([
                'status' => 200,
                'message' => 'Diskon berhasil dihapus'
            ]);
        }

        return $this->fail('Gagal menghapus diskon');
    }
}