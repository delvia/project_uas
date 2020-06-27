<?php

class Berita_model extends CI_Model{

   
   public function __construct()
   {
       parent::__construct();
       //Do your magic here
       $this->load->database();
   }
   
   //listing all berita
   public function listing()
   {
       $this->db->select('*');
        $this->db->from('berita');
        //JOIN
        $this->db->join('users', 'users.id_user = berita.id_user', 'left');
        
        //end join
        $this->db->group_by('berita.id_berita');
        $this->db->order_by('id_berita', 'desc');
        $query = $this->db->get();
       return $query->result();
   }



   
   //detail berita
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