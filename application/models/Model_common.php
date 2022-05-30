<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_common extends CI_Model 
{
    public function all_setting()
    {
        $query = $this->db->query("SELECT * from tbl_settings WHERE id=1");
        return $query->first_row('array');
    }
    public function getsent()
    {
        $currentuserid = $this->session->userdata('id');
        $sql = 'SELECT * from tbl_sent WHERE userid=? ORDER by id DESC';
        $query = $this->db->query($sql,array($currentuserid));
       
        return $query->result_array();
    }
    function getnotification()
    {
        $currentuserid = $this->session->userdata('id');
        $sql = 'SELECT * FROM tbl_notifications WHERE userid=? ORDER by id DESC limit 5';
        $query = $this->db->query($sql,array($currentuserid));
       
        return $query->result_array();
    }
    function updatenotification($id,$data) 
    {
        $this->db->where('id',$id);
        $this->db->update('tbl_notifications',$data);
    }
   
    
    function gettotalnotification()
    {
        $currentuserid = $this->session->userdata('id');
        $sql = 'SELECT * FROM tbl_notifications WHERE userid=? and status="unread"';
        $query = $this->db->query($sql,array($currentuserid));
       
        return $query->result_array();
    }
}