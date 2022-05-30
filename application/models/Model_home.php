<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_home extends CI_Model 
{
    function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_user'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_auto_post_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_post'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function slug_duplication_check($slug)
    {
        $sql = 'SELECT * FROM tbl_post WHERE slug=?';
        $query = $this->db->query($sql,array($slug));
        return $query->num_rows();
    }

    function fetch_data($limit, $start)
 {

  $this->db->select("tbl_post.*, tbl_user.photo, tbl_user.username, tbl_user.firstname, tbl_user.lastname, tbl_user.isverified");
  $this->db->from("tbl_post");
  $this->db->join('tbl_user', 'tbl_user.id = tbl_post.userid', 'left');
  $this->db->where("tbl_post.status='Active' AND tbl_post.privacy='Public'");
  $this->db->order_by("id", "DESC");
  $this->db->limit($limit, $start);
  $query = $this->db->get();
  return $query;
 }

    function add($data) {
        $this->db->insert('tbl_user',$data);
        return $this->db->insert_id();
    }

    function addpost($data) {
        $this->db->insert('tbl_post',$data);
        return $this->db->insert_id();
    }

    function check_email($email) 
	{

		$this->db->select('id,email,username');
		$this->db->from('tbl_user');
		$this->db->where("(email='".$email."' OR username='".$email."')");
		$query = $this->db->get();
		return $query->first_row('array');
    }

    function check_onlyemail($email) 
	{

		$this->db->select('id,email,username');
		$this->db->from('tbl_user');
		$this->db->where("email='".$email."'");
		$query = $this->db->get();
		return $query->first_row('array');
    }
    
    function check_username($username) 
	{

		$this->db->select('id,email,username');
		$this->db->from('tbl_user');
		$this->db->where("username='".$username."'");
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

    function getsearch($value)
    {
        $sql = 'SELECT tag_id as id, tag_title as title FROM tbl_tags WHERE tag_title LIKE "%'.$value.'%"';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getuser($value)
    {
        $sql = 'SELECT id, username, firstname, lastname, photo FROM tbl_user WHERE firstname LIKE "%'.$value.'%" OR lastname LIKE "%'.$value.'%"';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
  
    
}