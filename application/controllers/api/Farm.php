<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Farm extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('api/Farm_model','farm');
    }

    public function getFarm(){
        $farmer_id = $_POST['farmer_id'];
        $records = $this->farm->getFarmDetail($farmer_id);
        if(!empty($records)){
           // echo "<pre>";print_r($records);exit;
           $soil_url = explode(',',$records[0]['soil_profile']);
           $record = [];
           foreach($soil_url as $k => $v){
                $record[] = base_url()."upload/".$v;
           } 
           $records[0]['soil_profile'] = $record;
           $data['status'] = true;
            $data['message'] = "Farm Details";
            $data['records'] = $records;
            $sql = json_encode($data);
            echo $sql; 
        } else {
            $data['status'] = false;
            $data['message'] = 'Your Farm Not Register Yet!';
            $sql = json_encode($data);
            echo $sql;
        }
    }

    public function updateFarm(){
        $farmer_id = $_POST['farmer_id'];
        $farm_name = $_POST['farm_name'];
        $farm_location = $_POST['farm_location'];
        $farm_type = $_POST['farm_type'];
        $bus_stand = $_POST['bus_stand'];
        //$soil = $_FILES['soil_profile']['name'];
        //$soil_profile = count($soil);
        //$this->load->library('upload');
        $data = [];
        //$files = $_FILES;
        // if(!empty($soil)){
        //     for($i=0;$i<$soil_profile;$i++){
        //         $_FILES['file']['name'] = $files['soil_profile']['name'][$i];
        //         $_FILES['file']['type'] = $files['soil_profile']['type'][$i];
        //         $_FILES['file']['tmp_name'] = $files['soil_profile']['tmp_name'][$i];
        //         $_FILES['file']['error'] = $files['soil_profile']['error'][$i];
        //         $_FILES['file']['size'] = $files['soil_profile']['size'][$i];
                
        //         $config['upload_path'] = 'upload/'; 
        //         $config['allowed_types'] = 'jpg|jpeg|png|gif';
        //         $this->load->library('upload',$config); 
        //         $this->upload->initialize($config);
        //         if($this->upload->do_upload('file')){
        //             $imageData = $this->upload->data();
        //             $data[] = $imageData['file_name'];
        //         }
        //     }
        //     $image = implode(',',$data);
        //     $old_soil = $this->db->get('farm_detail',array('farmer_id' => $farmer_id))->result_array();
        //     if(!empty($old_soil)){
        //         $image = $old_soil[0]['soil_profile'].",".$image;
        //     }        
        // } else {
        //     $old_soil = $this->db->get('farm_detail',array('farmer_id' => $farmer_id))->result_array();
        //     $image = $old_soil[0]['soil_profile'];
        // }

        $farm = array(
            'farm_name' => $farm_name,
            'farm_location' => $farm_location,
            'farm_type' => $farm_type,
            'bus_stand' => $bus_stand,
            //'soil_profile' => $image
        );
        $this->db->where('farmer_id',$farmer_id);
        $sql = $this->db->update('farm_detail',$farm);
        if($sql){
            $sql = $this->db->
            $res['status'] = true;
            $res['message'] = "Soil Profile Updated for Farm";
            $result = json_encode($res);
            echo $result;
        } else {
            $res['status'] = false;
            $res['message'] = "Something went wrong!";
            $result = json_encode($res);
            echo $result;
        }
    }

    public function addCrop()
    {   
       $crop_name = $_POST['crop_name'];
       $farmer_id = $_POST['farmer_id'];
       $farm_id = $_POST['farm_id'];
       $crop_type = $_POST['crop_type'];
       $product_amount = $_POST['product_amount'];
       $seeding_date = $_POST['seeding_date'];
       $expected_harvest_date = $_POST['expected_harvest_date'];
       $seed_detail = NULL;
       $seed_image_files = NULL;
       if (isset($_FILES['seed_detail'])) {
            $seed_detail = $_FILES['seed_detail']['name'];
            $seed_image_files = count($seed_detail);
       }
       $fertilizer_detail = NULL;
       $fertilizer_image_files = NULL;
       if (isset($_FILES['fertilizer_detai'])) {
            $fertilizer_detail = $_FILES['fertilizer_detail']['name'];
            $fertilizer_image_files = count($fertilizer_detail);
       }
       $pesticide_detail = NULL;
       $pesticide_image_files = NULL;
       if (isset($_FILES['pesticide_detail'])) {
            $pesticide_detail = $_FILES['pesticide_detail']['name'];
            $pesticide_image_files = count($pesticide_detail);
       }
       $crop_detail = NULL;
       $crop_image_files = NULL;
       if (isset($_FILES['crop_detail'])) {
            $crop_detail = $_FILES['crop_detail']['name'];
            $crop_image_files = count($pesticide_detail);
       }
       $fertilizer_image = [];
       $seed_image = [];
       $pesticide_image= [];
       $crop_image = [];
       $crop_data = [];
       $files = $_FILES;
       if($seed_detail){
        for($i=0;$i<$seed_image_files;$i++){
            $_FILES['file']['name'] = $files['seed_detail']['name'][$i];
            $_FILES['file']['type'] = $files['seed_detail']['type'][$i];
            $_FILES['file']['tmp_name'] = $files['seed_detail']['tmp_name'][$i];
            $_FILES['file']['error'] = $files['seed_detail']['error'][$i];
            $_FILES['file']['size'] = $files['seed_detail']['size'][$i];
            $config['upload_path'] = 'upload/seed/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload',$config); 
            $this->upload->initialize($config);
            if($this->upload->do_upload('file')){
                $imageData = $this->upload->data();
                $seed_image[] = $imageData['file_name'];
            }
        }
       }
       $seed_image = implode(',',$seed_image);
        for($i=0;$i<$fertilizer_image_files;$i++){
                $_FILES['file']['name'] = $files['fertilizer_detail']['name'][$i];
                $_FILES['file']['type'] = $files['fertilizer_detail']['type'][$i];
                $_FILES['file']['tmp_name'] = $files['fertilizer_detail']['tmp_name'][$i];
                $_FILES['file']['error'] = $files['fertilizer_detail']['error'][$i];
                $_FILES['file']['size'] = $files['fertilizer_detail']['size'][$i];
                
                $config['upload_path'] = 'upload/fertilizer/'; 
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $this->load->library('upload',$config); 
                $this->upload->initialize($config);
                if($this->upload->do_upload('file')){
                    $imageData = $this->upload->data();
                    $fertilizer_image[] = $imageData['file_name'];
                }
        }
        $fertilizer_data = implode(',',$fertilizer_image);

        for($i=0;$i<$pesticide_image_files;$i++){
            $_FILES['file']['name'] = $files['pesticide_detail']['name'][$i];
            $_FILES['file']['type'] = $files['pesticide_detail']['type'][$i];
            $_FILES['file']['tmp_name'] = $files['pesticide_detail']['tmp_name'][$i];
            $_FILES['file']['error'] = $files['pesticide_detail']['error'][$i];
            $_FILES['file']['size'] = $files['pesticide_detail']['size'][$i];
            
            $config['upload_path'] = 'upload/pesticide/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload',$config); 
            $this->upload->initialize($config);
            if($this->upload->do_upload('file')){
                $imageData = $this->upload->data();
                $pesticide_image[] = $imageData['file_name'];
            }
        }
        $pesticide_data = implode(',',$pesticide_image);

        for($i=0;$i<$crop_image_files;$i++){
            $_FILES['file']['name'] = $files['crop_detail']['name'][$i];
            $_FILES['file']['type'] = $files['crop_detail']['type'][$i];
            $_FILES['file']['tmp_name'] = $files['crop_detail']['tmp_name'][$i];
            $_FILES['file']['error'] = $files['crop_detail']['error'][$i];
            $_FILES['file']['size'] = $files['crop_detail']['size'][$i];
            
            $config['upload_path'] = 'upload/crop/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload',$config); 
            $this->upload->initialize($config);
            if($this->upload->do_upload('file')){
                $imageData = $this->upload->data();
                $crop_image[] = $imageData['file_name'];
            }
        }
        $crop_data = implode(',',$crop_image);

        $sql =array(
            'crop_name' => $crop_name,
            'farmer_id' => $farmer_id,
            'farm_id' => $farm_id,
            'crop_type' => $crop_type,
            'product_amount' => $product_amount,
            'seeding_date' => $seeding_date,
            'expected_harvest_date' => $expected_harvest_date,
            'seed_detail' => $seed_image,
            'fertilizer_details' => $fertilizer_data,
            'pesticide_details' => $pesticide_data,
            'current_crop_image' => $crop_data,
            'created_at' => date('Y-m-d H:i:s')
        );
        $sql1 = $this->db->insert('crops',$sql);
        if($sql1){
            $res['status'] = true;
            $res['message'] = "Add Crop Successfully";
            $result = json_encode($res);
            echo $result;
        } else {
            $res['status'] = false;
            $res['message'] = "Something went wrong!";
            $result = json_encode($res);
            echo $result;
        }
    }

    public function getCrop(){
        $farmer_id = $_POST['farmer_id'];
        $crop_all = $this->farm->getCrop($farmer_id);
        if($crop_all){
            $res['status'] = true;
            $res['message'] ="Crops List.";
            $res['data'] = $crop_all;
            $result = json_encode($res);
            echo $result;
        }else{
            $res['status'] = false;
            $res['message'] ="No Crops Available.";
            $res['data'] = $crop_all;
            $result = json_encode($res);
            echo $result;
        }
    }

    public function updateCropImage(){
        $crop_id = $_POST['crop_id'];
        $farmer_id = $_POST['farmer_id'];
        $current_image = $_FILES['crop_image']['name'];
        $crop_image = count($current_image);
        $crop_current_image = [];
        for($i=0;$i<$crop_image;$i++){
            $_FILES['file']['name'] = $_FILES['crop_image']['name'][$i];
            $_FILES['file']['type'] = $_FILES['crop_image']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['crop_image']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['crop_image']['error'][$i];
            $_FILES['file']['size'] = $_FILES['crop_image']['size'][$i];
            
            $config['upload_path'] = 'upload/crop/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload',$config); 
            $this->upload->initialize($config);
            if($this->upload->do_upload('file')){
                $imageData = $this->upload->data();
                $crop_current_image[] = $imageData['file_name'];
            }
        }
        $crop_data = implode(',',$crop_current_image);
        $old_crop_image = $this->farm->crop_update($crop_id,$farmer_id);
        if(!empty($old_crop_image)){
            $image = $old_crop_image[0]['current_crop_image'].','.$crop_data;
        } else {
            $image = $crop_data;
        }
        $update_data = $this->farm->updateCropImage($crop_id,$farmer_id,$image);
        $list_crop_image = $this->farm->crop_update($crop_id,$farmer_id);
        $crop_data1 = [];

        $crop_data_array = explode(',',$list_crop_image[0]['current_crop_image']);
        foreach($crop_data_array as $key=>$value){
            $crop_data1[] = base_url()."upload/crop/".$value;
        }
        if($update_data){
            $res['status'] = true;
            $res['message'] = "Crop Current Image Update";
            $res['crop_image'] = $crop_data1;
            echo json_encode($res);
        } else {
            $res['status'] = false;
            $res['message'] = "Something went wrong!";
            $res['crop_image'] = $update_data;
            echo json_encode($res);
        }   

    }

    public function getCropById(){
        $crop_id = $_POST['crop_id'];
        $result = $this->farm->getCropId($crop_id);
        if($result){
            $res['status'] = true;
            $res['message'] = "Crop Details.";
            $res['data'] = $result;
            echo json_encode($res);
        } else {
            $res['status'] = false;
            $res['message'] = "Something went wrong!";
            $res['data'] = $result;
            echo json_encode($res);
        }   
    }

    public function updateCropArrival(){
        $crop_id = $_POST['crop_id'];
        $date = $_POST['date'];
        
        $sql = $this->db->get_where('crop_upcoming_harvest')->result_array();
        if(!empty($sql)){
            $data = array(
                'arrival_date' => $date
            );
            $this->db->where('crop_id',$crop_id);
            $result = $this->db->update('crop_upcoming_harvest',$data);
            $crop_data = $this->farm->getCropForHarvest($crop_id);
            if($result){
                $res['status'] = true;
                $res['message'] = "Update Successfully.";
                $res['data'] = $crop_data;
                echo json_encode($res);
            } else {
                $res['status'] = false;
                $res['message'] = "Something went wrong.";
                $res['data'] = [];
                echo json_encode($res);
            }
        } 
    }

    public function getCropByDate(){
        $farmer_id = $_POST['farmer_id'];
        $result = $this->farm->getDataByFarmerId($farmer_id);
        if($result){
            $res['status'] = true;
            $res['message'] = "Crops Data.";
            $res['data'] = $result;
            echo json_encode($res);
        } else {
            $res['status'] = true;
            $res['message'] = "No Data.";
            $res['data'] = [];
            echo json_encode($res);
        }
    }

    public function updateAllImages(){
        $crop_id = $_POST['crop_id'];
        $type = $_POST['type'];
        $image = $_FILES['crop_image']['name'];
        if($type == 'seed'){
            $config['upload_path'] = 'upload/seed/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload',$config); 
            if ( ! $this->upload->do_upload('crop_image'))
            {
                $data = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }
            
            $seed_image = $this->db->get_where('crops',array('id' => $crop_id))->result_array();
            $old_image = $seed_image[0]['seed_detail'];
            if($old_image != ''){
                $image = $old_image.",".$data['upload_data']['file_name'];
            } else {
                $image = $data['upload_data']['file_name']; 
            }
            $this->db->where('id',$crop_id);
            $sql = $this->db->update('crops',array('seed_detail' => $image));
            if($sql){
                $arr = array(
                    'crop_id' => $crop_id,
                    'seed_image' => base_url()."upload/seed/".$data['upload_data']['file_name']
                );
                $res['status'] = true;
                $res['message'] = "Seed Image Upload Successfully.";
                $res['data'] = $arr;
                echo json_encode($res);exit;
            } else {
                $res['status'] = false;
                $res['message'] = 'something went wrong.';
                echo json_encode($res);exit;
            }
        }
	if($type == 'fertilizer'){
            $config['upload_path'] = 'upload/fertilizer/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload',$config); 
            if ( ! $this->upload->do_upload('crop_image'))
            {
                $data = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }
            
            $seed_image = $this->db->get_where('crops',array('id' => $crop_id))->result_array();
            $old_image = $seed_image[0]['fertilizer_details'];
            if($old_image != ''){
                $image = $old_image.",".$data['upload_data']['file_name'];
            } else {
                $image = $data['upload_data']['file_name'];
            }
            $this->db->where('id',$crop_id);
            $sql = $this->db->update('crops',array('fertilizer_details' => $image));
            if($sql){
                $arr = array(
                    'crop_id' => $crop_id,
                    'seed_image' => base_url()."upload/fertilizer/".$data['upload_data']['file_name']
                );
                $res['status'] = true;
                $res['message'] = "Fertilizer Image Upload Successfully.";
                $res['data'] = $arr;
                echo json_encode($res);exit;
            } else {
                $res['status'] = false;
                $res['message'] = 'something went wrong.';
                echo json_encode($res);exit;
            }
        }
	if($type == 'pesticide'){
            $config['upload_path'] = 'upload/pesticide/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload',$config); 
            if ( ! $this->upload->do_upload('crop_image'))
            {
                $data = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }
            
            $seed_image = $this->db->get_where('crops',array('id' => $crop_id))->result_array();
            $old_image = $seed_image[0]['pesticide_details'];
            if($old_image != ''){
                $image = $old_image.",".$data['upload_data']['file_name'];
            } else {
                $image = $data['upload_data']['file_name'];
            }
            $this->db->where('id',$crop_id);
            $sql = $this->db->update('crops',array('pesticide_details' => $image));
            if($sql){
                $arr = array(
                    'crop_id' => $crop_id,
                    'seed_image' => base_url()."upload/pesticide/".$data['upload_data']['file_name']
                );
                $res['status'] = true;
                $res['message'] = "Pesticide Image Upload Successfully.";
                $res['data'] = $arr;
                echo json_encode($res);exit;
            } else {
                $res['status'] = false;
                $res['message'] = 'something went wrong.';
                echo json_encode($res);exit;
            }
        }
	if($type == 'current_image'){
            $config['upload_path'] = 'upload/crop/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload',$config); 
            if ( ! $this->upload->do_upload('crop_image'))
            {
                $data = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }
            
            $seed_image = $this->db->get_where('crops',array('id' => $crop_id))->result_array();
            $old_image = $seed_image[0]['current_crop_image'];
            if($old_image != ''){
                $image = $old_image.",".$data['upload_data']['file_name'];
            } else {
                $image = $data['upload_data']['file_name'];
            }
            $this->db->where('id',$crop_id);
            $sql = $this->db->update('crops',array('current_crop_image' => $image));
            if($sql){
                $arr = array(
                    'crop_id' => $crop_id,
                    'seed_image' => base_url()."upload/crop/".$data['upload_data']['file_name']
                );
                $res['status'] = true;
                $res['message'] = "Current Crop Image Upload Successfully.";
                $res['data'] = $arr;
                echo json_encode($res);exit;
            } else {
                $res['status'] = false;
                $res['message'] = 'something went wrong.';
                echo json_encode($res);exit;
            }
        }
    }

    public function updateSoilProfile(){
        $farm_id = $_POST['farm_id'];
        $soil_image = $_FILES['soil_profile']['name'];
        $config['upload_path'] = 'upload/'; 
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $this->load->library('upload',$config); 
        if ( ! $this->upload->do_upload('soil_profile'))
        {
            $data = array('error' => $this->upload->display_errors());
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
        }

        $seed_image = $this->db->get_where('farm_detail',array('id' => $farm_id))->result_array();
        $old_image = $seed_image[0]['soil_profile'];
        if($old_image != ''){
            $image = $old_image.",".$data['upload_data']['file_name'];
        } else {
            $image = $data['upload_data']['file_name'];
        }
        $this->db->where('id',$farm_id);
        $sql = $this->db->update('farm_detail',array('soil_profile' => $image));
        if($sql){
            $sql2 = $this->db->get_where('farm_detail',array("id"=>$farm_id))->result_array();
            $sql2[0]['soil_profile'] =  base_url()."upload/".$data['upload_data']['file_name'];
            $arr = array(
                    'farm_id' => $farm_id,
                    'seed_image' => base_url()."upload/".$data['upload_data']['file_name']
                );
            $res['status'] = true;
            $res['message'] = "Soil Profile Image Upload Successfully.";
            $res['data'] = $sql2;
            echo json_encode($res);exit;
        } else {
            $res['status'] = false;
            $res['message'] = 'something went wrong.';
            echo json_encode($res);exit;
        }
    }
}