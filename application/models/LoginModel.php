<?php
class LoginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function cekAuth($user, $pass){
		$this->db->select("*");
		$this->db->where("username", $user);
		$this->db->where("origin", $pass);
		// $this->db->where("password", sha1($pass));
		$db = $this->db->get("users");

		return $db;
	}
}
?>