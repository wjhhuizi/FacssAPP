<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserLib extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function checkExist($nid)
    {
        $sql = "SELECT 1 FROM facss_users WHERE user_netid = ?";
        $Q = $this->db->query($sql, $nid);
        return $Q->row_array();
    }
    
    
    public function checkPassWord($user)
    {
        $sql = "SELECT user_id FROM facss_users WHERE user_netid = ? AND user_pass = ?";
        $Q = $this->db->query($sql, [$user['nid'], $user['pass']]);
        return $Q->row_array();
    }
    
    public function checkPerm($nid)
    {
        $sql = "SELECT special_perm FROM facss_users WHERE user_id = ?";
        $Q = $this->db->query($sql, $nid);
        return $Q->row_array()['special_perm'];
    }
    
    public function reg($regInfo)
    {
        $sql = "INSERT INTO facss_users (`user_netid`, `user_pass`, `user_email`, `reg_localhelp`)"
                ." VALUES (?, ?, ?, ?)";
        $Q = $this->db->query($sql, [$regInfo['nid'], $regInfo['pass'], $regInfo['email'], serialize(array())]);
        return $Q;
    }
}
