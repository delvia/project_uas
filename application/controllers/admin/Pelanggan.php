
<?php

class Pelanggan extends CI_Controller{
    //load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
        //proteksi halaman
        $this->simple_login->cek_login();

    }

        //data user
    public function index()
    {
        $pelanggan = $this->pelanggan_model->listing();
        $data = array ( 'title' => 'Data Pelanggan',
                        'pelanggan' => $pelanggan,
                        'isi' => 'admin/pelanggan/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        //ini
    }

    //tambah user
    public function tambah()
    {
        //validaasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_pelanggan','Nama lengkap','required',
            array( 'required'   => '%s harus diisi'));


         $valid->set_rules('email','Email','required|valid_email',
            array( 'required'   => '%s harus diisi', 
                'valid_email'   => '%s tidak valid'));
                            
        $valid->set_rules('password','Password','required',
             array( 'required'   => '%s harus diisi'));

             $valid->set_rules('alamat','Alamat','required',
            array( 'required'   => '%s harus diisi', 
                'valid_email'   => '%s tidak valid'));



        if($valid->run()===FALSE)
        {
            //END VALIDASI
            $data = array(  'title' => 'Tambah Pelanggan',
                            'isi' => 'admin/pelanggan/tambah');

            $this->load->view('admin/layout/wrapper', $data, FALSE);
            //masuk database

        }else{
            $i = $this->input;
            $data = array(      'nama_pelanggan'    => $i->post('nama_pelanggan'),
                                 'email'            => $i->post('email'),
                                 'password'         => SHA1($i->post('password')),
                                 'telepon'          => $i->post('telepon'),
                                 'alamat'          => $i->post('alamat'),
                                 'tanggal_daftar'    => date('Y-m-d H:i:s')
                               
                                 
            
                        );
            $this->pelanggan_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data telah ditambah');
            
            redirect(base_url('admin/pelanggan'),'refresh');
            //end masuk database
        }

        
    }

     //eedit user
     public function edit($id_pelanggan)
     {
         $pelanggan = $this->pelanggan_model->detail($id_pelanggan);
         //validaasi input
         $valid = $this->form_validation;
 
         $valid->set_rules('nama_pelanggan','Nama lengkap','required',
             array( 'required'   => '%s harus diisi'));
 
 
          $valid->set_rules('email','Email','required|valid_email',
             array( 'required'   => '%s harus diisi', 
                 'valid_email'   => '%s tidak valid'));
                             
 

         $valid->set_rules('password','Password','required',
              array( 'required'   => '%s harus diisi'));

        $valid->set_rules('alamat','Alamat','required',
              array( 'required'   => '%s harus diisi', 
                  'valid_email'   => '%s tidak valid'));
  
 
 
 
         if($valid->run()===FALSE)
         {
             //END VALIDASI
             $data = array(  'title' => 'Edit Pelanggan',
                            'pelanggan' => $pelanggan,
                             'isi' => 'admin/pelanggan/edit');
 
             $this->load->view('admin/layout/wrapper', $data, FALSE);
             //masuk database
 
         }else{
             $i = $this->input;
             $data = array(      'id_pelanggan' =>$id_pelanggan,
                                'nama_pelanggan'    => $i->post('nama_pelanggan'),
                                'email'            => $i->post('email'),
                                'password'         => SHA1($i->post('password')),
                                'telepon'          => $i->post('telepon'),
                                'alamat'          => $i->post('alamat'),
                                'tanggal_daftar'    => date('Y-m-d H:i:s')
           
             
                         );
             $this->pelanggan_model->edit($data);
             $this->session->set_flashdata('sukses', 'Data telah diedit');
             
             redirect(base_url('admin/pelanggan'),'refresh');
             
         }
 
         
     }

        //delete
        public function delete($id_pelanggan)
        {
            $data = array('id_pelanggan' => $id_pelanggan);
            $this->pelanggan_model->delete($data);
            $this->session->set_flashdata('sukses', 'Data telah dihapus');
            
            redirect(base_url('admin/pelanggan'),'refresh');
            
            
        }


}