<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';

use chriskacerguis\RestServer\RestController;
class Api extends RestController {
    function __construct()
    {
    // Construct the parent class
    parent::__construct();
    $this->load->model('Api_model', 'model');
    } 

    protected $list_table = ['users'];
    public function LiatData_get($table)
    {
        // echo "Ini RestAPI LiatData";
        if (in_array($table, $this->list_table)) {
            $data = $this->model->liat($table);
            $this->response($data, 200);
        } else {
            $this->response([
                "status" => false,
                "error" => "Unknown method"
            ], 502);
        }
    }

    public function Tambahuser_post()
    {
        $data = [
            'id_user' => $this->post('id'),
            'akses_level' => $this->post('akses_level'),
            'nama' => $this->post('nama')
        ];
        $hasil = $this->model->tambah('users', $data);
        if ($hasil) {
            $this->response([
                'status' => 'Berhasil',
                'message' => $data
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => "$hasil Data ditambah"
            ], 502);
        }
    }
    public function Ubahusers_put()
    {
        $id = [
            'id_user' => $this->put('id')
        ];
        $data = [
            'nama' => $this->put('nama'),
            'akses_level' => $this->put('akses_level')

        ];
        $hasil = $this->model->ubahusers('users', $id, $data);
        if ($hasil) {
            $this->response([
                'status' => 'Berhasil',
                'message' => $data
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => "$hasil data diedit"
            ], 502);
        }
    }
    public function Hapususers_delete()
    {
        $id = [
            'id_user' => $this->delete('id_user')
        ];
        $hasil = $this->model->hapus('users', $id);
        if ($hasil) {
            $this->response([
                'status' => 'Berhasil',
                'message' => $id
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => "$hasil data dihapus"
            ], 502);
        }
    }  

}

/* End of file Api.php */
