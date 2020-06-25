<?php

class Rekening extends CI_Controller{

    //load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rekening_model');
        //proteksi halaman
        $this->simple_login->cek_login();

    }

        //data rekening
    public function index()
    {
        $rekening = $this->rekening_model->listing();
        $data = array ( 'title'     => 'Data Rekening',
                        'rekening'  => $rekening,
                        'isi'       => 'admin/rekening/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        //ini
    }

    //tambah rekening
    public function tambah()
    {
        //validaasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_bank','Nama rekening','required',
            array( 'required'   => '%s harus diisi'));

        $valid->set_rules('nama_pemilik','Nama pemilik rekening','required',
            array( 'required'   => '%s harus diisi'));

        $valid->set_rules('nomor_rekening','Nomor rekening','required|is_unique[rekening.nomor_rekening]',
                array( 'required'   => '%s harus diisi',
                        'is_unique' => '%s sudah ada. Buat nomor rekening yang baru!'));

        if($valid->run()===FALSE)
        {
            //END VALIDASI
            $data = array(  'title' => 'Tambah Rekening',
                            'isi'   => 'admin/rekening/tambah');

            $this->load->view('admin/layout/wrapper', $data, FALSE);
            //masuk database

        }else{
            $i = $this->input;
           

            $data = array(     
                                'nama_bank'       => $i->post('nama_bank'),
                                'nomor_rekening'  => $i->post('nomor_rekening'),
                                'nama_pemilik'    => $i->post('nama_pemilik'));
            $this->rekening_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data telah ditambah');
            
            redirect(base_url('admin/rekening'),'refresh');
            
        }  
    }

     //edit rekening
     public function edit($id_rekening)
     {
         $rekening = $this->rekening_model->detail($id_rekening);
         //validaasi input
         $valid = $this->form_validation;

         $valid->set_rules('nama_bank','Nama rekening','required',
         array( 'required'   => '%s harus diisi'));
 
         if($valid->run()===FALSE)
         {
             //END VALIDASI
             $data = array(  'title'    => 'Edit Rekening',
                             'rekening' => $rekening,
                             'isi'      => 'admin/rekening/edit');
 
             $this->load->view('admin/layout/wrapper', $data, FALSE);
             //masuk database
 
         }else{
             $i = $this->input;
            
             $data = array(      'id_rekening'    => $id_rekening,
                                 'nama_bank'      => $i->post('nama_bank'),
                                'nomor_rekening'  => $i->post('nomor_rekening'),
                                'nama_pemilik'    => $i->post('nama_pemilik'));
             
                         
             $this->rekening_model->edit($data);
             $this->session->set_flashdata('sukses', 'Data telah diedit');
             
             redirect(base_url('admin/rekening'),'refresh');
             
         }
 
         
     }

        //delete
        public function delete($id_rekening)
        {
            $data = array('id_rekening' => $id_rekening);
            $this->rekening_model->delete($data);
            $this->session->set_flashdata('sukses', 'Data telah dihapus');
            
            redirect(base_url('admin/rekening'),'refresh');
            
            
        }


}