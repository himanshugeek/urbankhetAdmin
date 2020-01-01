<?php
class Farm_model extends CI_Model {

    public function getFarmDetail($farmer_id){
        $this->db->from('farm_detail');
        $this->db->where('farmer_id',$farmer_id);
        $data = $this->db->get()->result_array();
        return $data;
    }

    public function getCrop($farmer_id){
        $this->db->select('crops.*,farm_detail.farm_name,farm_detail.farmer_id,farm_detail.soil_profile,farm_detail.farm_location,farm_detail.bus_stand,farm_detail.farm_type');
        $this->db->from('crops');
        $this->db->join('farm_detail','farm_detail.id = crops.farm_id');
        $this->db->where('crops.farmer_id',$farmer_id);
        $res = $this->db->get()->result_array();
        $data = [];
        foreach($res as $key=>$value){
            $soil = [];
            $seed = [];
            $fertilizer = [];
            $pesticide = [];
            $seed_url = explode(',',$value['seed_detail']);
            $seed_url = array_filter($seed_url);
            foreach($seed_url as $key1=>$value1){
                if(!empty($value1)){
                    $seed[] = base_url()."upload/seed/".$value1;
                } else {
                    $seed[] = '';
                }
            }
            $fertilizer_url = explode(',',$value['fertilizer_details']);
            $fertilizer_url = array_filter($fertilizer_url);
            foreach($fertilizer_url as $key2=>$value2){
                if(!empty($value2)){
                    $fertilizer[] = base_url()."upload/fertilizer/".$value2;
                } else {
                    $fertilizer[] = '';
                }
            }
            $pesticide_url = explode(',',$value['pesticide_details']);
            $pesticide_url = array_filter($pesticide_url);
            foreach($pesticide_url as $key3=>$value3){
                if(!empty($value3)){
                    $pesticide[] = base_url()."upload/pesticide/".$value3;
                } else {
                    $pesticide[] = '';
                }
            }
            $soil_url = explode(',',$value['soil_profile']);
            foreach($soil_url as $key4=>$value4){
                if(!empty($value4)){
                    $soil[] = base_url()."upload/".$value4;
                } else {
                    $soil[] = "";
                }
            }
            $crop_iamge = [];
            $crop_image_url = explode(',',$value['current_crop_image']);
            $crop_image_url = array_filter($crop_image_url);
            foreach($crop_image_url as $key5=>$value5){
                if(!empty($value5)){
                    $crop_iamge[] = base_url()."upload/crop/".$value5;
                } else {
                    $crop_iamge[] = "";
                }
            }
            $data[] = array(
                'id' => $value['id'],
                'crop_name' => $value['crop_name'],
                'farmer_id' => $value['farmer_id'],
                'farm_id' => $value['farm_id'],
                'crop_type' => $value['crop_type'],
                'product_amount' => $value['product_amount'],
                'seeding_date' => $value['seeding_date'],
                'expected_harvest_date' => $value['expected_harvest_date'],
                'seed_detail' => $seed,
                'fertilizer_details' => $fertilizer,
                'pesticide_details' => $pesticide,
                'created_at' => $value['created_at'],
                'farm_name' => $value['farm_name'],
                'farm_location' => $value['farm_location'],
                'bus_stand' => $value['bus_stand'],
                'farm_type' => $value['farm_type'],
                'soil_profile' => $soil,
                'crop_image' => $crop_iamge
            );
        }
        return $data;
    }

    public function crop_update($crop_id,$farmer_id){
        $this->db->select('current_crop_image');
        $this->db->where('id',$crop_id);
        $this->db->where('farmer_id',$farmer_id);
        $this->db->from('crops');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function updateCropImage($crop_id,$farmer_id,$image){
        $this->db->where('id',$crop_id);
        $this->db->where('farmer_id',$farmer_id);
        $query = $this->db->update('crops',array('current_crop_image' => $image));
        return $query;
    }

    public function getCropId($crop_id){
        $this->db->select('crops.*,farm_detail.farm_name,farm_detail.farmer_id,farm_detail.soil_profile,farm_detail.farm_location,farm_detail.bus_stand,farm_detail.farm_type');
        $this->db->from('crops');
        $this->db->join('farm_detail','farm_detail.id = crops.farm_id');
        $this->db->where('crops.id',$crop_id);
        $res = $this->db->get()->result_array();
        $soil = [];
        $seed = [];
        $fertilizer = [];
        $pesticide = [];
        $data = [];
        foreach($res as $key=>$value){
            $seed_url = explode(',',$value['seed_detail']);
            foreach($seed_url as $key1=>$value1){
                if(!empty($value1)){
                    $seed[] = base_url()."upload/seed/".$value1;
                } else {
                    $seed[] = '';
                }
            }
            $fertilizer_url = explode(',',$value['fertilizer_details']);
            foreach($fertilizer_url as $key2=>$value2){
                if(!empty($value2)){
                    $fertilizer[] = base_url()."upload/fertilizer/".$value2;
                } else {
                    $fertilizer[] = '';
                }
            }
            $pesticide_url = explode(',',$value['pesticide_details']);
            foreach($pesticide_url as $key3=>$value3){
                if(!empty($value3)){
                    $pesticide[] = base_url()."upload/pesticide/".$value3;
                } else {
                    $pesticide[] = '';
                }
            }
            $soil_url = explode(',',$value['soil_profile']);
            foreach($soil_url as $key4=>$value4){
                if(!empty($value4)){
                    $soil[] = base_url()."upload/".$value4;
                } else {
                    $soil[] = "";
                }
            }
            $crop_iamge = [];
            $data[] = array(
                'id' => $value['id'],
                'crop_name' => $value['crop_name'],
                'farmer_id' => $value['farmer_id'],
                'farm_id' => $value['farm_id'],
                'crop_type' => $value['crop_type'],
                'product_amount' => $value['product_amount'],
                'seeding_date' => $value['seeding_date'],
                'expected_harvest_date' => $value['expected_harvest_date'],
                'seed_detail' => $seed,
                'fertilizer_details' => $fertilizer,
                'pesticide_details' => $pesticide,
                'created_at' => $value['created_at'],
                'farm_name' => $value['farm_name'],
                'farm_location' => $value['farm_location'],
                'bus_stand' => $value['bus_stand'],
                'farm_type' => $value['farm_type'],
                'soil_profile' => $soil,
                'crop_image' => $crop_iamge
            );
        }
        return $data;
    }

    public function getCropForHarvest($crop_id){
        $this->db->select('crops.crop_name,crops.id as crop_id,crop_upcoming_harvest.arrival_date');
        $this->db->from('crops');
        $this->db->join('crop_upcoming_harvest','crop_upcoming_harvest.crop_id = crops.id');
        $this->db->where('crops.id',$crop_id);
        $res = $this->db->get()->result_array();
        return $res;
    }

    public function getDataByFarmerId($farmer_id){
        $this->db->select('crops.crop_name,user.*,crop_upcoming_harvest.arrival_date, crop_upcoming_harvest.crop_id');
        $this->db->from('user');
        $this->db->join('crops','crops.farmer_id = user.id');
        $this->db->join('crop_upcoming_harvest','crop_upcoming_harvest.crop_id = crops.id');
        $this->db->where('user.id',$farmer_id);
        $this->db->where('crop_upcoming_harvest.arrival_date',NULL);
        $result = $this->db->get()->result_array();
        return $result;
    }
}