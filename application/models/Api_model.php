<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->database();
    }

    public function liat($table)
    {
        $this->db->from($table);
        $data= $this->db->get();
        return $data->result_array();
    }

    public function tambah($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }    

    public function ubah($table, $id, $data)
    {
        $this->db->where($id)->update($table, $data);
        return $this->db->affected_rows();
    }

    public function hapus($table, $id)
    {
        $this->db->where($id)->delete($table);
        return $this->db->affected_rows();
    }



}

/* End of file ModelName.php */
