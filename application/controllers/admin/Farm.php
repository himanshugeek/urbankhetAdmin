<?php 

class Farm extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
       $this->load->model('harvest_model');
       $this->load->model('farm_model');

    }

    public function index()
    {
        $data = array();
        $data['page_title'] = 'Farm';
        $data['country'] = $this->common_model->select('country');
        $data['power'] = $this->common_model->get_all_power('user_power');
        $data['farmer'] = $this->db->get_where('user',array("role" => "farmer"))->result_array();
        $data['farm_type'] = array("Aquaponics farming","Hydroponics farming","Convention farming","Convention organic farming");
        //$data['crops'] = $this->db->get('crops')->result_array();
        $data['main_content'] = $this->load->view('admin/farm/add', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function getcrop(){
        if(isset($_POST["farmer_id"])){
            $farmer_id = $_POST["farmer_id"];
            $crops = $this->db->get_where('crops',array('farmer_id' => $farmer_id))->result_array();
            $count = count($crops);
            
            if($count > 0){
                $crop = '<option value="">Select Crop</option>';
                foreach($crops as $key => $value){
                    $crop_id = $value['id'];
                    $crop_name = $value['crop_name'];
                    $crop .=  "<option value='$crop_id'>$crop_name</option>";
                }
            } else {

                $crop = '<option value="">Select Crop</option>';
            }
            return $crop;
        }
    }

    //-- add new user by admin
    public function add()
    {   
        if ($_POST) {
            $data = array(
                'farmer_id' => $_POST['farmer_id'],
                'farm_name' => $_POST['farm_name'],
                'farm_location' => $_POST['farm_location'],
                'farm_type' => $_POST['farm_type'],
                "bus_stand" => $_POST['bus_stand'],
                'created_at' => current_datetime()
            );

            if (!empty($data)) {
                $user_id = $this->farm_model->insert($data, 'farm_detail');
            }
                $this->session->set_flashdata('msg', 'Farm added Successfully');
                redirect(base_url('admin/farm/all_farm_list'));
        }
    }

    public function all_farm_list()
    {
	 	$data['page_title'] = 'All Farm List';
        $data['users'] = $this->common_model->get_all_user();
        $data['farm'] = $this->farm_model->get_farm_list();
       //echo "<pre>";print_r($data['harvest']);exit;
        $data['country'] = $this->common_model->select('country');
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/farm/all_farm_list', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- update users info
    public function update($id)
    {
        if ($_POST) {

            $data = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'mobile' => $_POST['mobile'],
                'country' => $_POST['country'],
                'role' => $_POST['role']
            );
            $data = $this->security->xss_clean($data);

            $powers = $this->input->post('role_action');
            if (!empty($powers)) {
                $this->common_model->delete_user_role($id, 'user_role');
                foreach ($powers as $value) {
                   $role_data = array(
                        'user_id' => $id,
                        'action' => $value
                    ); 
                   $role_data = $this->security->xss_clean($role_data);
                   $this->common_model->insert($role_data, 'user_role');
                }
            }

            $this->common_model->edit_option($data, $id, 'user');
            $this->session->set_flashdata('msg', 'Information Updated Successfully');
            redirect(base_url('admin/user/all_user_list'));

        }
		
        $data['user'] = $this->common_model->get_single_user_info($id);
        $data['user_role'] = $this->common_model->get_user_role($id);
        $data['power'] = $this->common_model->select('user_power');
        $data['country'] = $this->common_model->select('country');
        $data['main_content'] = $this->load->view('admin/user/edit_user', $data, TRUE);
		$data['page_title'] = 'Edit Users';
        $this->load->view('admin/index', $data);
        
    }

    
    //-- active user
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'User active Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }

    //-- deactive user
    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'User deactive Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }

    //-- delete user
    public function delete($id)
    {
        $this->common_model->delete($id,'user'); 
        $this->session->set_flashdata('msg', 'User deleted Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }


    public function power()
    {   
		$data['page_title'] = 'Add User Role';
        $data['powers'] = $this->common_model->get_all_power('user_power');
        $data['main_content'] = $this->load->view('admin/user/user_power', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- add user power
    public function add_power()
    {   
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name'],
                'power_id' => $_POST['power_id']
            );
            $data = $this->security->xss_clean($data);
            
            //-- check duplicate power id
            $power = $this->common_model->check_exist_power($_POST['power_id']);
            if (empty($power)) {
                $user_id = $this->common_model->insert($data, 'user_power');
                $this->session->set_flashdata('msg', 'Power added Successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Power id already exist, try another one');
            }
            redirect(base_url('admin/user/power'));
        }
        
    }

    //--update user power
    public function update_power()
    {   
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name']
            );
            $data = $this->security->xss_clean($data);
            
            $this->session->set_flashdata('msg', 'Power updated Successfully');
            $user_id = $this->common_model->edit_option($data, $_POST['id'], 'user_power');
            redirect(base_url('admin/user/power'));
        }
        
    }

    public function delete_power($id)
    {
        $this->common_model->delete($id,'user_power'); 
        $this->session->set_flashdata('msg', 'Power deleted Successfully');
        redirect(base_url('admin/user/power'));
    }


}