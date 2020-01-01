<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// *************************************************************************
// *                                                                       *
// * Optimum LinkupComputers                              *
// * Copyright (c) Optimum LinkupComputers. All Rights Reserved                     *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@optimumlinkupsoftware.com                                 *
// * Website: https://optimumlinkup.com.ng								   *
// * 		  https://optimumlinkupsoftware.com							   *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// *                                                                       *
// *************************************************************************

//LOCATION : application - controller - Auth.php

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('api/User_model','user');
    }

    public function login(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);
        $records = $this->user->login($email,$password);
        if(!empty($records)){
            $data['status'] = true;
            $data['message'] = "Login Successfully";
            $data['records'] = $records;
            $sql = json_encode($data);
            echo $sql; 
        } else {
            $data['status'] = false;
            $data['message'] = 'Email or Password Incorrect!';
            $sql = json_encode($data);
            echo $sql;
        }
    }

    public function update_profile(){
        $farmer_id = $_POST['farmer_id'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $data = array(
            'email' => $email,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'mobile' => $phone
        );
        $records = $this->user->update_farmer($farmer_id,$data);
        if($records){
            $farmer_detail = $this->db->get('user',array("id" => $farmer_id))->result_array();
            $res['status'] = true;
            $res['message'] = 'Profile Update Successfully.';
            $res['records'] = $farmer_detail;
            $sql = json_encode($res);
            echo $sql;
        } else {
            $res['status'] = false;
            $res['message'] = 'Something went wrong!';
            $sql=  json_encode($res);
            echo $sql;
        }
    }

}