<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->database();
    }

    //get user

    public function getuser($id = null) {
        if($id === null) {
            return $this->db->get('users')->result_array(); 
        } else {
            return $this->db->get_where('users', ['id_user' => $id])->result_array();
        }
    }


    public function deleteuser($id) {
        $this->db->delete('users', ['id_user' => $id]);
        return $this->db->affected_rows();
    }

    public function tambahuser($data) {
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }

    public function updateuser($data, $id) {
<<<<<<< HEAD
        $this->db->where('id_user', $id);
        $this->db->update('users', $data);
        
        // $this->db->update('users', $data, ['id_user' => $id]);
=======
        
        $this->db->update('users', $data, ['id_user' => $id]);
>>>>>>> 901933fa50462d21c175ed61eac9ff8089d747f9
            
        return $this->db->affected_rows();
    }

}

/* End of file ModelName.php */
