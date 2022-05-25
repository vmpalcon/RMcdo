<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model 
{

    public function get_setting_data()
    {
        $query = $this->db->query("SELECT * from tbl_settings WHERE id=1");
        return $query->first_row('array');
    }

	function check_email($email) 
	{

		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where("(email='".$email."' OR username='".$email."')");
		$query = $this->db->get();
		return $query->first_row('array');
    }

    function check_password($email,$password)
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where("(email='".$email."' OR username='".$email."') AND password='".md5($password)."'");
        $query = $this->db->get();
        return $query->first_row('array');
    }

}