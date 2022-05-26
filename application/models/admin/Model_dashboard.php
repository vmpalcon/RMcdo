<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dashboard extends CI_Model 
{
	/*public function show_total_category()
	{
		$sql = 'SELECT * from tbl_category';
        $query = $this->db->query($sql);
        return $query->num_rows();
    } */
    public function show_total_users()
	{
		$sql = 'SELECT id from tbl_user';
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    public function show_total_pendingpost()
	{
		//$sql = 'SELECT id from tbl_post';
        $this->db->select("id");
        $this->db->from("tbl_post");
        $this->db->where("status='Pending'");
        $query = $this->db->get();
        //$query = $this->db->query($sql);
        return $query->num_rows();
    }
    public function show_total_pages()
	{
		$sql = 'SELECT id from tbl_pages';
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}