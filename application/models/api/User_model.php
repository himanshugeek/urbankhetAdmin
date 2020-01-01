<?php
class User_model extends CI_Model {

    public function login($email,$password){
        $this->db->from('user');
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        $this->db->where('role','farmer');
        $data = $this->db->get()->result_array();
        return $data;
    }

    public function update_farmer($farmer_id,$data){
        $this->db->where('id',$farmer_id);
        $sql = $this->db->update('user',$data);
        return $sql;
    }
    
}