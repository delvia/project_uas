<?php

class Berita extends CI_Controller{

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
        $berita = $this->berita_model->listing();
        $data = array ( 'title' => 'Berita Produk',
                       'berita' => $berita,
                        'isi' => 'admin/berita/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        //ini
    }
    
   

    //tambah produk
    public function tambah()
    {
        //aambil data berita
        $berita = $this->berita_model->listing();
       
        //validaasi input
        $valid = $this->form_validation;

        $valid->set_rules('judul_berita','Judul Berita','required',
            array( 'required'   => '%s harus diisi'));

            $valid->set_rules('slug_berita','Slug Berita','required',
            array( 'required'   => '%s harus diisi'));

            $valid->set_rules('keterangan','Keterangan','required',
            array( 'required'   => '%s harus diisi'));
            
        
            if($valid->run()){ 
                //check jika gambar diganti
            if(!empty($_FILES['gambar']['name'])) {
           $config['upload_path']   = './assets/upload/image/';
           $config['allowed_types'] = 'gif|jpg|png|jpeg';
           $config['max_size']      = '2400'; //dalam kb
           $config['max_width']     = '2024';
           $config['max_height']    = '2024';
           
           $this->load->library('upload', $config);
           
           if ( ! $this->upload->do_upload('gambar')){
               //END VALIDASI

               $data = array(  'title'     => 'Tambah Berita: '.$berita->judul_berita,
                               'berita'    => $berita,
                               'error'        => $this->upload->display_errors(),
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
               
               $data = array(     
                                   'id_berita'           => $id_berita,
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
           }}else{
               //edit produk tanpa ganti gambar
               $i = $this->input;
              
               $data = array(      'id_berita'           => $id_berita,
                                   'jenis_berita'       =>  $i->post('jenis_berita'),
                                   'judul_berita'       =>  $i->post('judul_berita'),
                                   'slug_berita'       =>  $i->post('slug_berita'),
                                   'keterangan'        => $i->post('keterangan'),
                                   'keywords'          => $i->post('keywords'),
                                    //disimpan nama file gambar(gambar tidak diganti)
                                     //disimpan nama gambarny
                                  // 'gambar'            => $upload_gambar['upload_data']['file_name'],
                                   'tanggal_post'      => date('Y-m-d H:i:s')
                                  
                           );
               $this->berita_model->tambah($data);
               $this->session->set_flashdata('sukses', 'Data telah diedit');
               
               redirect(base_url('admin/berita'),'refresh');
           }}
           //end masuk database
           $data = array( 'title'     => 'Tambah Berita: '.$berita->judul_berita,
                           'berita'    => $berita,
                           'error'        => $this->upload->display_errors(),
                           'isi'       => 'admin/berita/tambah');

           $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function edit($id_berita)
     {
         $berita = $this->berita_model->detail($id_berita);
         //validaasi input
         $valid = $this->form_validation;
         $valid->set_rules('judul_berita','Judul Berita','required',
         array( 'required'   => '%s harus diisi'));

         $valid->set_rules('slug_berita','Slug Berita','required',
         array( 'required'   => '%s harus diisi'));

         $valid->set_rules('keterangan','Keterangan','required',
         array( 'required'   => '%s harus diisi'));
         
         

            if($valid->run()){ 
                 //check jika gambar diganti
             if(!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './assets/upload/image/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = '2400'; //dalam kb
            $config['max_width']     = '2024';
            $config['max_height']    = '2024';
            
            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload('gambar')){
                //END VALIDASI

                $data = array(  'title'     => 'Edit Berita: '.$berita->judul_berita,
                                'berita'    => $berita,
                               
                                'isi'       => 'admin/berita/edit');

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
                
                $data = array(     
                                    'id_berita'           => $id_berita,
                                    'jenis_berita'       =>  $i->post('jenis_berita'),
                                    'judul_berita'       =>  $i->post('judul_berita'),
                                    'slug_berita'       =>  $i->post('slug_berita'),
                                    'keterangan'        => $i->post('keterangan'),
                                    'keywords'          => $i->post('keywords'),
            
                                    //disimpan nama gambarny
                                    'gambar'            => $upload_gambar['upload_data']['file_name'],
                                    'tanggal_post'      => date('Y-m-d H:i:s')
                            );
                $this->berita_model->edit($data);
                $this->session->set_flashdata('sukses', 'Data telah ditambah');
                
                redirect(base_url('admin/berita'),'refresh');
            }}else{
                //edit produk tanpa ganti gambar
                $i = $this->input;
               
                $data = array(      'id_berita'           => $id_berita,
                                    'jenis_berita'       =>  $i->post('jenis_berita'),
                                    'judul_berita'       =>  $i->post('judul_berita'),
                                    'slug_berita'       =>  $i->post('slug_berita'),
                                    'keterangan'        => $i->post('keterangan'),
                                    'keywords'          => $i->post('keywords'),
                                     //disimpan nama file gambar(gambar tidak diganti)
                                      //disimpan nama gambarny
                                   // 'gambar'            => $upload_gambar['upload_data']['file_name'],
                                    'tanggal_post'      => date('Y-m-d H:i:s')
                                   
                            );
                $this->berita_model->edit($data);
                $this->session->set_flashdata('sukses', 'Data telah diedit');
                
                redirect(base_url('admin/berita'),'refresh');
            }}
            //end masuk database
            $data = array( 'title'     => 'Edit Berita: '.$berita->judul_berita,
                            'berita'    => $berita,
                            
                            'isi'       => 'admin/berita/edit');

            $this->load->view('admin/layout/wrapper', $data, FALSE);

     }
  

      //delete
      public function delete($id_berita)
      {
          $data = array('id_berita' => $id_berita);
          $this->berita_model->delete($data);
          $this->session->set_flashdata('sukses', 'Data telah dihapus');
          
          redirect(base_url('admin/berita'),'refresh');
          
          
      }

    

}