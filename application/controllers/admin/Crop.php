<?php 

class Crop extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
       $this->load->model('harvest_model');
       $this->load->model('farm_model');
       $this->load->model('crop_model');

    }

    public function index()
    {
        $data = array();
        $data['page_title'] = 'Crop';
        $data['country'] = $this->common_model->select('country');
        $data['power'] = $this->common_model->get_all_power('user_power');
        $data['crop'] = $this->crop_model->getCrop();
       // echo "<pre>";print_r($data['crop']);exit;
        $data['farm_type'] = array("Aquaponics farming","Hydroponics farming","Convention farming","Convention organic farming");
        //$data['crops'] = $this->db->get('crops')->result_array();
        $data['main_content'] = $this->load->view('admin/crop/list', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function addCropHarvestDate(){
        $data = array();
        $data['page_title'] = 'Crop Harvest Date';
        $data['country'] = $this->common_model->select('country');
        $data['power'] = $this->common_model->get_all_power('user_power');
        $data['crop'] = $this->crop_model->getCrop();
        $data['farmer'] = $this->db->get_where('user',array("role" => "farmer"))->result_array();
       // echo "<pre>";print_r($data['crop']);exit;
        $data['farm_type'] = array("Aquaponics farming","Hydroponics farming","Convention farming","Convention organic farming");
        //$data['crops'] = $this->db->get('crops')->result_array();
        $data['main_content'] = $this->load->view('admin/crop/add_date', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    
}