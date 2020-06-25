<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->model('rekening_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('konfigurasi_model');
    }
    
    //load data transaksi
    public function index()
    {
        $header_transaksi = $this->header_transaksi_model->listing();
        $data             = array(     'title'            => 'Data Transaksi',
                                        'header_transaksi' => $header_transaksi,
                                        'isi'              => 'admin/transaksi/list'

                        );
        
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        
    }

    //detail
    public function detail($kode_transaksi)
    {
        //ambil dat login id_pelanggan dari SESSION
        
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);
        
        $data  = array(     'title'             => 'Riwayat Belanja',
                            'header_transaksi'  => $header_transaksi,
                            'transaksi'         => $transaksi,
                            'isi'               =>  'admin/transaksi/detail'
                    );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        
    }

    //cetak
    public function cetak($kode_transaksi)
    {
        //ambil dat login id_pelanggan dari SESSION
        
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);
        $site               = $this->konfigurasi_model->listing();
        $data  = array(     'title'             => 'Riwayat Belanja',
                            'header_transaksi'  => $header_transaksi,
                            'transaksi'         => $transaksi,
                            'site'              => $site
                            
                    );
        $this->load->view('admin/transaksi/cetak', $data, FALSE);
        
    }

     //unduh pdf
     public function pdf($kode_transaksi)
     {
         //ambil dat login id_pelanggan dari SESSION
         
         $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
         $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);
         $site               = $this->konfigurasi_model->listing();
         $data  = array(     'title'             => 'Riwayat Belanja',
                             'header_transaksi'  => $header_transaksi,
                             'transaksi'         => $transaksi,
                             'site'              => $site
                             
                     );
        //$this->load->view('admin/transaksi/cetak', $data, FALSE);
         $html      = $this->load->view('admin/transaksi/cetak', $data, true);
         $mpdf      = new \Mpdf\Mpdf();
         // write some HTML code:
         $mpdf->WriteHTML($html);
         //output a PDF file directly to the browser
         $mpdf->Output();           

     }

     //pengiriman 
     public function kirim($kode_transaksi)
     {
         //ambil dat login id_pelanggan dari SESSION
         
         $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
         $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);
         $site               = $this->konfigurasi_model->listing();
         $data  = array(     'title'             => 'Riwayat Belanja',
                             'header_transaksi'  => $header_transaksi,
                             'transaksi'         => $transaksi,
                             'site'              => $site
                             
                     );
        //$this->load->view('admin/transaksi/kirim', $data, FALSE);
         $html      = $this->load->view('admin/transaksi/kirim', $data, true);
         $mpdf      = new \Mpdf\Mpdf();
         //SETTING HEADER DAN FOOTER
         $mpdf->SetHTMLHeader('
        <div style="text-align: left; font-weight: bold;">
            <img src="'.base_url('assets/upload/image/'.$site->logo).'" style="height: 50px;
                    width: auto;">
        </div>');
        $mpdf->SetHTMLFooter('
            <div style="padding: 10px 20px; background-color: red; color: white; font-size:12px;">
            Alamat: '.$site->namaweb.' ('.$site->alamat.')<br>
            Telepon: '.$site->telepon.'
            </div>');
        
         // write some HTML code:
         $mpdf->WriteHTML($html);
         //output tampil dengan nama baru
         $nama_file_pdf= url_title($site->namaweb,'dash','true').'-'.$kode_transaksi.'.pdf';

         $mpdf->Output($nama_file_pdf,'I');           

     }



}

/* End of file Transaksi.php */
