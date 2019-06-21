<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Dummy extends REST_Controller
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	function index_get()
	{
		$id = $this->get('id');
		if ($id == '') {
			$partner = $this->db->get('bank')->result();
		} else {
			$this->db->where('id', $id);
			$partner = $this->db->get('bank')->result();
		}
		$this->response($partner, 200);
	}

	function index_post()
	{
		$data = array(
			'kode' => $this->post('kode'),
			'nama' => $this->post('nama'));
		$insert = $this->db->insert('bank', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}

	}

	function index_put()
	{
		$id = $this->put('id');
		$data = array(
			'id' => $this->put('id'),
			'kode' => $this->put('kode'),
			'nama' => $this->put('nama'));
		$this->db->where('id', $id);
		$update = $this->db->update('bank', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	function index_delete() {
		$id = $this->delete('id');
		$this->db->where('id', $id);
		$delete = $this->db->delete('bank');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}
