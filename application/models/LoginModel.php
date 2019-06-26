<?php
class LoginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function cekAuth($user){
		$this->db->select("*");
		$this->db->where("username", $user);
		// $this->db->where("password", sha1($pass));
		$db = $this->db->get("users");

		return $db;
	}
}
?>