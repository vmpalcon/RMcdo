
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
        $sql = "SELECT * 
                FROM tbl_post t1
                WHERE t1.status = 'pending'
                ORDER BY t1.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data) 
    {
        $this->db->insert('tbl_post',$data);
        return $this->db->insert_id();
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