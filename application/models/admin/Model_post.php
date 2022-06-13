
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_post extends CI_Model 
{
	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_post'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show() 
    {
        $sql = "SELECT * 
                FROM tbl_post t1
                ORDER BY t1.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    function pending() 
    {
        $sql = "SELECT tbl_post.*, tbl_user.photo, tbl_user.username, tbl_user.firstname, tbl_user.lastname, tbl_user.isverified
                FROM tbl_post 
                LEFT JOIN tbl_user on tbl_user.id = tbl_post.userid
                WHERE tbl_post.status = 'Pending'
                ORDER BY tbl_post.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data) 
    {
        $this->db->insert('tbl_post',$data);
        return $this->db->insert_id();
    }

    function addnotification($data) 
    {
        $this->db->insert('tbl_notifications',$data);
        return $this->db->insert_id();
    }
    function addsent($data) 
    {
        $this->db->insert('tbl_sent',$data);
        return $this->db->insert_id();
    }
    function getnotification($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function update($id,$data) 
    {
        $this->db->where('id',$id);
        $this->db->update('tbl_post',$data);
    }

    function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('tbl_post');
    }

    function getData($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function gettagData($id)
    {
        $this->db->select('tbl_tags.*, tbl_tagpost.post_id');
        $this->db->from('tbl_tags');
        $this->db->join('tbl_tagpost', 'tbl_tagpost.tag_id = tbl_tags.tag_id', 'left');
        $this->db->where('tbl_tagpost.post_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function deletetagpost($post_id,$tag_id)
    {
        $this->db->where('post_id',$post_id);
        $this->db->where('tag_id',$tag_id);
        $this->db->delete('tbl_tagpost');
    }

    function post_dynamic_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function slug_duplication_check($slug)
    {
        $sql = 'SELECT * FROM tbl_post WHERE slug=?';
        $query = $this->db->query($sql,array($slug));
        return $query->num_rows();
    }

    function slug_duplication_check_edit($slug,$slug2)
    {
        $sql = 'SELECT * FROM tbl_post WHERE slug=? AND slug!=?';
        $query = $this->db->query($sql,array($slug,$slug2));
        return $query->num_rows();
    }
}