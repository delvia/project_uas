<?php
class Simple_pelanggan 
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        //load data model user
        $this->CI->load->model('pelanggan_model');
    }

            //fungsi login

    public function login($email,$password)
    {
        $check = $this->CI->pelanggan_model->login($email,$password);
        //jika ada data user maka create session login
        if($check) {
            $id_pelanggan   = $check->id_pelanggan;
            $nama_pelanggan = $check->nama_pelanggan;
            //create session
            $this->CI->session->set_userdata('id_pelanggan',$id_pelanggan);
            $this->CI->session->set_userdata('nama_pelanggan',$nama_pelanggan);
            $this->CI->session->set_userdata('email',$email);
            
            //redirect ke halaman admin yg diproteksi
            
            redirect(base_url('dasbor'),'refresh');
        }else
        {
            $check = $this->CI->pelanggan_model->login_admin($email,$password);
        }
        //jika ada data user maka create session login
        if($check) {
            $id_user   = $check->id_user;
           
            //create session
            $this->CI->session->set_userdata('id_user',$id_user);
            $this->CI->session->set_userdata('email',$email);
            
            //redirect ke halaman admin yg diproteksi
            
            redirect(base_url('dasbor'),'refresh');
            
        }else{
            //kalo ga ada (username password salah), maka suruh login lagi
           $this->CI->session->set_flashdata('warning', 'Username atau password salah');
           redirect(base_url('masuk'),'refresh');
        }
            
        
    }
    

    //fungsi cek login

  public function cek_login()
  {
       //memriksa apakah session sudah atau belum jika blm alihkan ke halaman login
      if($this->CI->session->userdata('email') == ""){
      $this->CI->session->set_flashdata('warning', 'Anda belum login');
         redirect(base_url('masuk'),'refresh');
      }
  
  }


        //fungsi logout

    public function logout()
     {
        //membuang session  yg telah di set saat login
        $this->CI->session->unset_userdata('id_pelanggan');
        $this->CI->session->unset_userdata('nama_pelanggan');
        $this->CI->session->unset_userdata('email');
        //setelah session di buang maka redirect login
            $this->CI->session->set_flashdata('sukses', 'Anda berhasil logout');
               redirect(base_url('masuk'),'refresh');

    }

}
