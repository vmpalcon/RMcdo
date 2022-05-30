<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_post extends CI_Model {

    public function page_check($slug)
    {
        $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function dynamic_post_by_slug($slug)
    {
        $this->db->select("tbl_post.*, tbl_user.photo, tbl_user.username, tbl_user.firstname, tbl_user.lastname, tbl_user.isverified");
        $this->db->from('tbl_post');
        $this->db->join('tbl_user', 'tbl_user.id = tbl_post.userid', 'left');
        $this->db->where("tbl_post.status='Active' AND tbl_post.slug='".$slug."'");
        $query = $this->db->get();
        return $query->first_row('array');
    }
}