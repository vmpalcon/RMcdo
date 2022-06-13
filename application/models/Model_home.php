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

    function reactpost($react){
        $this->db->insert('tbl_react',$react);
        return $this->db->insert_id();
    }

    function postcomment($comment){
        $this->db->insert('tbl_comments',$comment);
        return $this->db->insert_id();
    }

    function react_duplication_check($userid,$postid)
    {
        $sql = 'SELECT * FROM tbl_react WHERE userid=? AND postid=?';
        $query = $this->db->query($sql,array($userid,$postid));
        return $query->num_rows();
    }

    function deletereact($userid,$postid)
    {
        $this->db->where("tbl_react.postid='".$postid."' AND tbl_react.userid='".$userid."'");
        $this->db->delete('tbl_react');
    }

    function fetch_data($limit, $start)
 {
    $currentuser = $this->session->userdata('id');
    if($currentuser == null) {
        $currentuser = 0;
    } else {
        $currentuser = $this->session->userdata('id');
    }
  $this->db->select("exists(select 1 from `tbl_react` li where li.postid = p.id AND li.userid = ".$currentuser." limit 1) as isreact, (select count(distinct l.userid) from `tbl_react` l where l.postid = p.id) as totalreact, p.*, tbl_user.photo, tbl_user.username, tbl_user.firstname, tbl_user.lastname, tbl_user.isverified");
  $this->db->from("tbl_post as p");
  $this->db->join('tbl_user', 'tbl_user.id = p.userid', 'left');
  $this->db->where("p.status='Active' AND p.privacy='Public'");
  $this->db->order_by("id", "DESC");
  $this->db->limit($limit, $start);
  $query = $this->db->get();
  return $query;
 }

 function getdatabyusername($username)
    {
        $sql = 'SELECT id FROM tbl_user WHERE username=?';
        $query = $this->db->query($sql,array($username));
        return $query->result_array();
    }


 function fetch_databyuser($limit, $start, $username)
 {
    $currentuser = $username;
    if($currentuser == null) {
        $currentuser = 0;
    } else {
        $currentuser = $username;
    }
  $this->db->select("exists(select 1 from `tbl_react` li where li.postid = p.id AND li.userid = ".$currentuser." limit 1) as isreact, (select count(distinct l.userid) from `tbl_react` l where l.postid = p.id) as totalreact, p.*, tbl_user.photo, tbl_user.username, tbl_user.firstname, tbl_user.lastname, tbl_user.isverified");
  $this->db->from("tbl_post as p");
  $this->db->join('tbl_user', 'tbl_user.id = p.userid', 'left');
  $this->db->where("p.status='Active' AND p.privacy='Public' AND tbl_user.id = '".$currentuser."'");
  $this->db->order_by("id", "DESC");
  $this->db->limit($limit, $start);
  $query = $this->db->get();
  return $query;
 }

 function fetch_datatags($limit, $start, $postids)
 {
    $currentuser = $this->session->userdata('id');
    if($currentuser == null) {
        $currentuser = 0;
    } else {
        $currentuser = $this->session->userdata('id');
    }
  $this->db->select("exists(select 1 from `tbl_react` li where li.postid = p.id AND li.userid = ".$currentuser." limit 1) as isreact, (select count(distinct l.userid) from `tbl_react` l where l.postid = p.id) as totalreact, p.*, tbl_user.photo, tbl_user.username, tbl_user.firstname, tbl_user.lastname, tbl_user.isverified");
  $this->db->from("tbl_post as p");
  $this->db->join('tbl_user', 'tbl_user.id = p.userid', 'left');
  $this->db->where("p.status='Active' AND p.privacy='Public' AND p.id IN (".$postids.")");
  $this->db->order_by("id", "DESC");
  $this->db->limit($limit, $start);
  $query = $this->db->get();
  return $query;
 }


 function getalltags($tagtitle)
 {
    $sql = 'SELECT * FROM tbl_tags LEFT JOIN tbl_tagpost on tbl_tagpost.tag_id = tbl_tags.tag_id where tbl_tags.tag_title = "'.$tagtitle.'"';
        $query = $this->db->query($sql);
        return $query->result_array();
 }

 function getdata($postid)
 {
    $currentuser = $this->session->userdata('id');
    if($currentuser == null) {
        $currentuser = 0;
    } else {
        $currentuser = $this->session->userdata('id');
    }
  $this->db->select("exists(select 1 from `tbl_react` li where li.postid = p.id AND li.userid = ".$currentuser." limit 1) as isreact, (select count(distinct l.userid) from `tbl_react` l where l.postid = p.id) as totalreact, p.*, tbl_user.photo, tbl_user.username, tbl_user.firstname, tbl_user.lastname, tbl_user.isverified");
  $this->db->from("tbl_post as p");
  $this->db->join('tbl_user', 'tbl_user.id = p.userid', 'left');
  $this->db->where("p.status='Active' AND p.privacy='Public' AND p.id = ".$postid." ");
  $this->db->order_by("id", "DESC");
  $query = $this->db->get();
  return $query->first_row('array');
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

    function duplicate_tags($tag) {
        $sql = 'SELECT * FROM tbl_tags WHERE tag_title=?';
        $query = $this->db->query($sql,array($tag));
        return $query->result_array();
    }
  
    function addtag($data) {
        $this->db->insert('tbl_tags',$data);
        return $this->db->insert_id();
    }

    function addtagpost($data) {
        $this->db->insert('tbl_tagpost',$data);
        return $this->db->insert_id();
    }

    function fetch_comment($limit, $start, $postid)
    {
      
     $this->db->select("tbl_comments.*, tbl_user.firstname, tbl_user.lastname, tbl_user.photo, tbl_user.username");
     $this->db->from("tbl_comments");
     $this->db->join('tbl_user', 'tbl_user.id = tbl_comments.userid', 'left');
     $this->db->where("tbl_comments.postid = '".$postid."'");
     $this->db->order_by("tbl_comments.date_added", "desc");
     
     $this->db->limit($limit, $start);
     $query = $this->db->get();
     return $query;
    }
    
}