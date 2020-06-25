<?php

class Produk_model extends CI_Model{

   
   public function __construct()
   {
       parent::__construct();
       //Do your magic here
       $this->load->database();
   }
   
   //listing all berita
   public function listing()
   {
       $this->db->select('');
        $this->db->from('berita');
        //JOIN
        $this->db->join('users', 'users.id_user = produk.id_user', 'left');
        
        //end join
        $this->db->group_by('berita.id_berita');
        $this->db->order_by('id_berita', 'desc');
        $query = $this->db->get();
       return $query->result();
   }



   //gambar 
   public function gambar()
   {
    $this->db->select('*');
    $this->db->from('berita');
   
     $this->db->order_by('id_berita', 'desc');
    $query = $this->db->get();
    return $query->result();
   }

  


    //tambah gambar
    public function tambah_gambar($data)

    {
    $this->db->insert('berita', $data);
    }

    //delete gambar

    public function delete_gambar($data)
    {
        $this->db->where('id_berita', $data['id_berita']);
        $this->db->delete('berita', $data);
    }

   //detail produk
   public function detail($id_berita)
   {
       $this->db->select('*');
       $this->db->from('berita');
       $this->db->where('id_berita', $id_berita);
        $this->db->order_by('id_berita', 'desc');
       $query = $this->db->get();
       return $query->row();
   }

    
   //tambah
    public function tambah($data)

    {
        $this->db->insert('berita', $data);
    }


    //delete

    public function delete($data)
    {
        $this->db->where('id_berita', $data['id_berita']);
        $this->db->delete('berita', $data);
    }

    //edit
    public function edit($data)
    {
        $this->db->where('id_berita', $data['id_berita']);
        $this->db->update('berita', $data);
    }






}