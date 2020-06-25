<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('transaksi_model');
        $this->load->model('rekening_model');
        
        //halaman ini diproteksi dengan simple_pelanggan
        $this->simple_pelanggan->cek_login();
        
    }
    
    //halaman dasbor
    public function index()
    {
        //ambil dat login id_pelanggan dari SESSION
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->pelanggan($id_pelanggan);
        
        $data= array(   'title'             => 'Halaman Dasbor',
                        'header_transaksi'  => $header_transaksi,
                        'isi'               => 'dasbor/list'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
        
    }

    //belanja
    public function belanja()
    {
        //ambil dat login id_pelanggan dari SESSION
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->pelanggan($id_pelanggan);

        $data  = array(     'title'             => 'Riwayat Belanja',
                            'header_transaksi'  => $header_transaksi,
                            'isi'               =>  'dasbor/belanja'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
        

    }

    //detail
    public function detail($kode_transaksi)
    {
        //ambil dat login id_pelanggan dari SESSION
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);
        //pastikan bahwa pelanggan hanya mengakses data transaksinya
        if($header_transaksi->id_pelanggan != $id_pelanggan){
            $this->session->set_flashdata('warning', 'Anda mencoba mengakses data
                            transaksi orang lain');
            
            redirect(base_url('masuk'));   
        }
        $data  = array(     'title'             => 'Riwayat Belanja',
                            'header_transaksi'  => $header_transaksi,
                            'transaksi'         => $transaksi,
                            'isi'               =>  'dasbor/detail'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
        
    }

    //profil
    public function profil()
    {
        //ambil data login id_pelanggan dari SESSION
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $pelanggan          = $this->pelanggan_model->detail($id_pelanggan);
        //validaasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_pelanggan','Nama lengkap','required',
            array( 'required'   => '%s harus diisi'));

        $valid->set_rules('alamat','Alamat','required',
        array( 'required'   => '%s harus diisi'));

        $valid->set_rules('telepon','Nomor telepon','required',
            array( 'required'   => '%s harus diisi'));


        if($valid->run()===FALSE)
        {
            //END VALIDASI
        $data  = array(     'title'             => 'Profil Saya',
                            'pelanggan'         => $pelanggan,
                            'isi'               =>  'dasbor/profil'
                        );
        $this->load->view('layout/wrapper', $data, FALSE);
         
        
        //masuk database

        }else{
            $i = $this->input;
            //kalau password >6 karakter, maka ganti password
            if(strlen($i->post('password')) >= 6){
            $data = array(      
                                'id_pelanggan'      => $id_pelanggan,
                                'nama_pelanggan'    => $i->post('nama_pelanggan'),
                                 'password'         => SHA1($i->post('password')),
                                 'telepon'          => $i->post('telepon'),
                                 'alamat'           => $i->post('alamat')

                        );
                    }else{
                        //kalau kurang dari 6, maka ga ganti
                        $data = array(      
                            'id_pelanggan'      => $id_pelanggan,
                            'nama_pelanggan'    => $i->post('nama_pelanggan'),
                             'password'         => SHA1($i->post('password')),
                             'telepon'          => $i->post('telepon'),
                             'alamat'           => $i->post('alamat')
                
                    );
                    }
                    //end update
            $this->pelanggan_model->edit($data);
            $this->session->set_flashdata('sukses', 'Update Profil berhasil');
            redirect(base_url('dasbor/profil'),'refresh');
            
        }
         //end masuk database
    }

    //konfirmasi pembayaran
    public function konfirmasi($kode_transaksi)
    {
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi(
            $kode_transaksi);
        $rekening           = $this->rekening_model->listing();
         //validaasi input
         $valid = $this->form_validation;

         $valid->set_rules('nama_bank','Nama Bank','required',
             array( 'required'   => '%s harus diisi'));
 
         $valid->set_rules('rekening_pembayaran','Nomor Rekening','required',
              array( 'required'   => '%s harus diisi'));

        $valid->set_rules('rekening_pelanggan','Nama Pemilik Rekening','required',
              array( 'required'   => '%s harus diisi'));
 
        $valid->set_rules('tanggal_bayar','Tanggal Pembayaran','required',
              array( 'required'   => '%s harus diisi'));

        $valid->set_rules('jumlah_bayar','Jumlah Pembayaran','required',
              array( 'required'   => '%s harus diisi'));
         if($valid->run()){ 
             //check jika gambar diganti
             if(!empty($_FILES['bukti_bayar']['name'])) {

         $config['upload_path']   = './assets/upload/image/';
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
         $config['max_size']      = '2400'; //dalam kb
         $config['max_width']     = '2024';
         $config['max_height']    = '2024';
         
         $this->load->library('upload', $config);
         
         if ( ! $this->upload->do_upload('bukti_bayar')){
             //END VALIDASI
        $data = array(      'title'             => 'Konfirmasi Pembayaran',
                            'header_transaksi'  => $header_transaksi,
                            'rekening'          => $rekening,
                            'error'             => $this->upload->display_errors(),
                            'isi'               => 'dasbor/konfirmasi'
    
                        );
        $this->load->view('layout/wrapper', $data, FALSE);
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
        
        
        $data = array(       'id_header_transaksi' => $header_transaksi->id_header_transaksi,
                             'status_bayar'        => 'Konfirmasi',
                             'jumlah_bayar'        => $i->post('jumlah_bayar'),
                             'rekening_pembayaran' => $i->post('rekening_pembayaran'),
                             'rekening_pelanggan'  => $i->post('rekening_pelanggan'),
                             'bukti_bayar'         => $upload_gambar['upload_data']['file_name'],
                             'id_rekening'         => $i->post('id_rekening'),
                             'tanggal_bayar'       => $i->post('tanggal_bayar'),
                             'nama_bank'           => $i->post('nama_bank')       
                           
                    );
        $this->header_transaksi_model->edit($data);
        $this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil');
        redirect(base_url('dasbor'),'refresh');
        
   }}else{
        //edit produk tanpa ganti gambar
        $i = $this->input;
    
                    $data = array(       'id_header_transaksi' => $header_transaksi->id_header_transaksi,
                                        'status_bayar'        => 'Konfirmasi',
                                        'jumlah_bayar'        => $i->post('jumlah_bayar'),
                                        'rekening_pembayaran' => $i->post('rekening_pembayaran'),
                                        'rekening_pelanggan'  => $i->post('rekening_pelanggan'),
                                    // 'bukti_bayar'         => $upload_gambar['upload_data']['file_name'],
                                        'id_rekening'         => $i->post('id_rekening'),
                                        'tanggal_bayar'       => $i->post('tanggal_bayar'),
                                        'nama_bank'           => $i->post('nama_bank')       
                                    
            );
            $this->header_transaksi_model->edit($data);
            $this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil');
            redirect(base_url('dasbor'),'refresh');
        }}
            //end masuk database
                $data = array(      'title'             => 'Konfirmasi Pembayaran',
                                    'header_transaksi'  => $header_transaksi,
                                    'rekening'          => $rekening,
                                    'isi'               => 'dasbor/konfirmasi'

            );
            $this->load->view('layout/wrapper', $data, FALSE);
    }

}

/* End of file Dasbor.php */
