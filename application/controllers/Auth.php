<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Auth extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        //$this->load->model(array('Auth_model', 'General_model', 'Partner_model'));
        $this->load->model('LoginModel');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function all_get() {
        $this->db->select("*"); 
        $db = $this->db->get("users");

        if($db) {
            $this->response([
                'status' => TRUE,
                'data' => $db->result()
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => "User not found"
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function login_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $data = $this->LoginModel->cekAuth($username, $password);

        if($data->num_rows() > 0){
            $message = [
            'error'   => false,
            'message' => 'Login Berhasil',
            'user'    => $username,
            'pass'    => $password,
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);    
        }else{
             $message = [
            'error'   => true,
            'message' => 'Login Gagal',
            'user'    => $username,
            'pass'    => $password,
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);    
        }

    }

}
