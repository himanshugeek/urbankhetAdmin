<?php
class Crop_model extends CI_Model {

    public function getCrop(){
        $this->db->select('*');
        $this->db->from('crops');
        $this->db->join('user','user.id = crops.farmer_id');
        $this->db->join('farm_detail','farm_detail.id = crops.farm_id');
        $result = $this->db->get()->result_array();
        return $result;
    }
}