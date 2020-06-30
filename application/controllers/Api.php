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

   

    public function index_get()

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

    public function index_post()
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



    public function index_put()

    {
        $id = $this->put('id_user');
        $nama = $this->put('nama');
        $username = $this->put('username');
        $akses_level = $this->put('akses_level');

            $data = array(
                'id_user' => $id,
                'nama' => $nama,
                'username' => $username,
                'akses_level' => $akses_level
            );

            if($nama || $username || $akses_level > 0){
                $update = $this->model->updateuser($data, $id);
                if($update){
                    $response = array(
                        "msg" => "Data telah Terupdate!",
                        "data" => $data,
                    );
                    $this->response($response, 200);
                }
                } else {
                $response = array(
                    'status' => 'Gagal',
                    'msg' => 'Data gagal Terupdate!'
                );
                $this->response($response, 504);
            }             
        }


    

    
    

    public function index_delete()

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
        }
}


/* End of file Api.php */
