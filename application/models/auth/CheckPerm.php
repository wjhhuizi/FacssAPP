<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckPerm extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function checkPerm($nid)
    {
        $sql = "SELECT special_perm FROM facss_users WHERE user_id = ?";
        $Q = $this->db->query($sql, $nid);
        //return $Q->row_array();
        //print_r($Q->row_array()['special_perm']);
        return $Q->row_array()['special_perm'];
    }
    

}
