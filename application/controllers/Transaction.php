<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Transaction extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        //$this->load->model(array('Auth_model', 'General_model', 'Partner_model'));
        $this->load->model('TransactionModel');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        // $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function getKategori_get() {
        $this->db->select("*"); 
        $db = $this->db->get("categories");

        if($db) {
            $this->response([
                'status' => TRUE,
                'data' => $db->result()
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => "Categories not found"
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function getProduk_get() {
        $this->db->select("*"); 
        $this->db->from("products");
        $this->db->join("product_store_qty", "product_store_qty.product_id = products.id");
        $db = $this->db->get();

        if($db) {
            $this->response([
                'status' => TRUE,
                'data' => $db->result()
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => "Products not found"
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
