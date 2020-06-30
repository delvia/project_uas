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

   
    public function LiatData_get()
    {
        // echo "Ini RestAPI LiatData";
        $id = $this->get('id');
            // jika id tidak ada (tidak panggil) 
            if($id === null) {
                // maka panggil semua data
                $users = $this->model->getuser();
                // tapi jika id di panggil maka hanya id tersebut yang akan muncul pada data tersebut
            } else {
                $users = $this->model->getuser($id);
            }
            if($users) {
                $this->response([
                    'status' => true,
                    'data' => $users
                ],200); // NOT_FOUND (404) being the HTTP response code
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], 502); // NOT_FOUND (404) being the HTTP response code
            
            }
    }

    public function Tambahuser_post()
    {
        $data = [
            'id_user' => $this->post('id'),
           
            'nama' => $this->post('nama'),
            'username'  => $this->post('username'),
            'akses_level' => $this->post('akses_level')
        ];
        if ($this->model->tambahuser($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new user has been created'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed create data'
            ],502);
        }
    }
<<<<<<< HEAD
    public function Ubahusers_post()
=======
    
    public function Ubahusers_put()
>>>>>>> 901933f... By Delvi
    {
        $id =     $this->put('id_user');
        $data = [
            
            
            'nama' => $this->put('nama'),
            'username'  => $this->put('username'),
            'akses_level' => $this->put('akses_level')
        ];
<<<<<<< HEAD
        $hasil = $this->model->ubah('users', $id, $data);
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
    public function Hapususers_post()
    {
        $id = [
            'id_user' => $this->delete('id')
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
=======
            if ($this->model->updateuser($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'update user has been updated',
                    'data'  => $data,
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'failed to update data'
                ], 502);
            }
        
        
    
    }

    public function Hapususers_delete()
    {
        $id = $this->delete('id_user');
            if($id === null) {
                $this->response([
                    'status' => false,
                    'message' => 'provide an id'
                ],200); 
            } else {
                if($this->model->deleteuser($id) > 0) {
                    // Ok
                    $this->response([
                        'status' => true,
                        'id_user' => $id,
                        'message' => 'deleted success'
                    ],200);
                } else {
                    // id not found
                    $this->response([
                        'status' => false,
                        'message' => 'id not found'
                    ], 502); // NOT_FOUND (404) being the HTTP response code
                
                }
            }
        
>>>>>>> 901933f... By Delvi
    }  


}

/* End of file Api.php */
