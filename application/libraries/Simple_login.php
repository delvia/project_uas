<?php
class Simple_login 
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        //load data model user
        $this->CI->load->model('user_model');
    }

            //fungsi login

    public function login($username,$password)
    {
        $check = $this->CI->user_model->login($username,$password);
        //jika ada data user maka create session login
        if($check) {
            $id_user        = $check->id_user;
            $nama           = $check->nama;
            $akses_level    = $check->akses_level;
            //create session
            $this->CI->session->set_userdata('id_user',$id_user);
            $this->CI->session->set_userdata('nama',$nama);
            $this->CI->session->set_userdata('username',$username);
            $this->CI->session->set_userdata('akses_level',$akses_level);
            //redirect ke halaman admin yg diproteksi
            
            redirect(base_url('admin/dasbor'),'refresh');
            
        }else{
            //kalo ga ada (username password salah), maka suruh login lagi
           $this->CI->session->set_flashdata('warning', 'Username atau password salah');
           redirect(base_url('login'),'refresh');

        }
    }

    //fungsi cek login

    public function cek_login()
    {
         //memriksa apakah session sudah atau belum jika blm alihkan ke halaman login
        if($this->CI->session->userdata('username') == ""){
        $this->CI->session->set_flashdata('warning', 'Anda belum login');
           redirect(base_url('login'),'refresh');
        }
    
    }



    
        //fungsi logout

    public function logout()
     {
        //membuang session  yg telah di set saat login
        $this->CI->session->unset_userdata('id_user');
        $this->CI->session->unset_userdata('nama');
        $this->CI->session->unset_userdata('username');
        $this->CI->session->unset_userdata('akses_level');
        //setelah session di buang maka redirect login
            $this->CI->session->set_flashdata('sukses', 'Anda berhasil logout');
               redirect(base_url('login'),'refresh');

    }

}