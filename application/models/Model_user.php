<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model 
{
    public function page_check($username)
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function dynamic_user($username)
    {
        $this->db->select("id,email,username,firstname, lastname, bio, photo, role, isverified, status");
        $this->db->from('tbl_user');
        $this->db->where("tbl_user.username='".$username."'");
        $query = $this->db->get();
        return $query->first_row('array');
    }

    public function totalpost($userid) 
    {
        $sql = "SELECT tbl_post.*, tbl_user.photo, tbl_user.username, tbl_user.firstname, tbl_user.lastname, tbl_user.isverified
                FROM tbl_post 
                LEFT JOIN tbl_user on tbl_user.id = tbl_post.userid
                WHERE tbl_post.status = 'Active' and tbl_post.userid = '".$userid."'
                ORDER BY tbl_post.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}