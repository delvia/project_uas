<?php

class Produk extends CI_Controller{

    //load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('berita_model');
        
        
        //proteksi halaman
        $this->simple_login->cek_login();

    }

        //data produk
    public function index()
    {
        $produk = $this->produk_model->listing();
        $data = array ( 'title' => 'Berita Produk',
                        'berita' => $berita,
                        'isi' => 'admin/berita/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        //ini
    }

        //gambar
    public function gambar($id_produk)
    {
        $produk = $this->produk_model->detail($id_produk);
        $gambar = $this->produk_model->gambar($id_produk);

         //validaasi input
         $valid = $this->form_validation;

         $valid->set_rules('judul_gambar','Judul/Nama Gambar','required',
             array( 'required'   => '%s harus diisi'));
 
    
         if($valid->run()){ 
         $config['upload_path']   = './assets/upload/image/';
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
         $config['max_size']      = '2400'; //dalam kb
         $config['max_width']     = '2024';
         $config['max_height']    = '2024';
         
         $this->load->library('upload', $config);
         
         if ( ! $this->upload->do_upload('gambar')){
             //END VALIDASI
 
             $data = array(  'title'     => 'Tambah Gambar Produk: '.$berita->judul_berita,
                             'berita'    => $berita,
                             'gambar'    => $gambar,
                             'error'     => $this->upload->display_errors(),
                             'isi'       => 'admin/berita/gambar');
 
             $this->load->view('admin/layout/wrapper', $data, FALSE);
             //masuk database
 
         }else{
             $upload_gambar = array('upload_data' => $this->upload->data());
             //Create thumbanail gambar
             $config['image_library']    = 'gd2';
             $config['source_image']     = './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
                 
                 //lokasi folder thumbnailnya
             $config['new_image']        = './assets/upload/image/thumbs/';
            
             $config['create_thumb']     = TRUE;
             $config['maintain_ratio']   = TRUE;
             $config['width']            = 250;//pixel
             $config['height']           = 250;//pixel
             $config['thumb_marker']     = '';
 
             $this->load->library('image_lib', $config);
 
             $this->image_lib->resize();
 
             //end creat thumbnail
             $i = $this->input;
            
            
             $data = array(       'id_berita'         => $id_berita,
                                  'judul_gambar'      => $i->post('judul_gambar'),
        
                                  //disimpan nama gambarny
                                  'gambar'            => $upload_gambar['upload_data']['file_name']
                                  
                         );
             $this->produk_model->tambah_gambar($data);
             $this->session->set_flashdata('sukses', 'Gambar telah ditambahkan');
             
             redirect(base_url('admin/berita/gambar/'.$id_berita),'refresh');
             
         }}
         //end masuk database
         $data = array(  'title'     => 'Tambah Gambar Produk: '.$berita->judul_berita,
                         'berita'    => $berita,
                         'gambar'    => $gambar,
                         'isi'       => 'admin/berita/gambar');
          $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
    
    //tambah produk
    public function tambah()
    {
        //aambil data kategori
        $berita  = $this->berita_model->listing();
        //validaasi input
        $valid = $this->form_validation;

        $valid->set_rules('judul_berita','Judul Berita','required',
            array( 'required'   => '%s harus diisi'));

            $valid->set_rules('slug_berita','Slug Berita','required',
            array( 'required'   => '%s harus diisi'));

            $valid->set_rules('keterangan','Keterangan','required',
            array( 'required'   => '%s harus diisi'));
            
            $valid->set_rules('gambar','gambar','required',
            array( 'required'   => '%s harus diisi'));

      

        if($valid->run()){ 
        $config['upload_path']   = './assets/upload/image/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '2400'; //dalam kb
        $config['max_width']     = '2024';
        $config['max_height']    = '2024';
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('gambar')){
            //END VALIDASI

            $data = array(  'title'     => 'Tambah Berita',
                            'berita'    => $berita,
                            'gambar'    => $gambar,
                            'error'     => $this->upload->display_errors(),
                            'isi'       => 'admin/berita/tambah');

            $this->load->view('admin/layout/wrapper', $data, FALSE);
            //masuk database

        }else{
            $upload_gambar = array('upload_data' => $this->upload->data());
            //Create thumbanail gambar
            $config['image_library']    = 'gd2';
            $config['source_image']     = './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
                
                //lokasi folder thumbnailnya
            $config['new_image']        = './assets/upload/image/thumbs/';
           
            $config['create_thumb']     = TRUE;
            $config['maintain_ratio']   = TRUE;
            $config['width']            = 250;//pixel
            $config['height']           = 250;//pixel
            $config['thumb_marker']     = '';

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();

            //end creat thumbnail
            $i = $this->input;
           
            $data = array(      'id_user'            => $this->session->userdata('id_user'),
                                'jenis_berita'       =>  $i->post('jenis_berita'),
                                'judul_berita'       =>  $i->post('judul_berita'),
                                'slug_berita'       =>  $i->post('slug_berita'),
                                 'keterangan'        => $i->post('keterangan'),
                                 'keywords'          => $i->post('keywords'),
        
                                 //disimpan nama gambarny
                                 'gambar'            => $upload_gambar['upload_data']['file_name'],
                                 'tanggal_post'      => date('Y-m-d H:i:s')
                        );
            $this->berita_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data telah ditambah');
            
            redirect(base_url('admin/berita'),'refresh');
            
        }}
        //end masuk database
        $data = array(  'title'     => 'Tambah Berita',
                        'isi'       => 'admin/berita/tambah');
         $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

  

    

}