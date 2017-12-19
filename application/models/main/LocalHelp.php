<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocalHelp extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    
    public function getSchedule()
    {// <获取LocalHelp列表数据>
        $sql = "SELECT `id`, `title`, `department`, `datetime`, `signup_cnt`, `state` FROM `facss_localhelp`";
        $Q = $this->db->query($sql);
        $result = $Q->result_array();
        
        $status = [0 => '未开放报名', 1 => '', 2 => '已停止报名', 3 => '已过期'];
        foreach ($result as $k => $v)
        {
            $status[1] ='<a href="content/'.$v['id'].'" class="_lh_signup" lhid="'.$v['id'].'">'.'点此报名</a>';
            $result[$k]['signup_cnt'] = (int)$v['signup_cnt'];
            $result[$k]['state']      = $status[(int)$v['state']];
        }
        
//        echo'<pre>';
//        print_r($result);
//        die();
        
        return $result;
    }
    
    public function getContent($content_id = 0)
    {// <获取单条LocalHelp信息>
        $sql = 'SELECT `id`, `content`, `title`, `department`, `datetime`, `signup_cnt`, `state` FROM `facss_localhelp` WHERE id = ?';
        $Q = $this->db->query($sql,$content_id);
        return $Q->row_array() ? $Q->row_array() : NULL;
//        echo'<pre>';
//        print_r($result);
//        die();
    }
    
    public function getLHID($uid = 0)
    {
        $sql = 'SELECT `reg_localhelp` FROM `facss_users` WHERE user_id = ?';
        $Q = $this->db->query($sql, $uid);
        return $Q->row_array() ? unserialize($Q->row_array()['reg_localhelp']) : NULL;
    }
    
    public function regLHID($uid, $reg_LHID)
    {
        $sql_1 = 'SELECT `reg_localhelp` FROM `facss_users` WHERE user_id = ?';
        $Q_1 = $this->db->query($sql_1, $uid);
        $LHID_arr = unserialize($Q_1->row_array()['reg_localhelp']);
        array_push($LHID_arr, (int)$reg_LHID);
        
        $sql_2 = 'UPDATE `facss_users` SET `reg_localhelp` = ? WHERE user_id = ?';
        $Q_2 = $this->db->query($sql_2,[serialize($LHID_arr), (int)$uid]);
        
        $sql_3 = 'UPDATE `facss_localhelp` SET `signup_cnt` = `signup_cnt` + 1 WHERE id = ?';
        $Q_3 = $this->db->query($sql_3,(int)$reg_LHID);
    }
    
    public function cancelLHID($uid, $cancel_LHID)
    {
        $sql_1 = 'SELECT `reg_localhelp` FROM `facss_users` WHERE user_id = ?';
        $Q_1 = $this->db->query($sql_1, $uid);
        $LHID_arr = unserialize($Q_1->row_array()['reg_localhelp']);
        foreach ($LHID_arr as $k => $v)
        {
            if ($v == $cancel_LHID)
            {
                unset($LHID_arr[$k]);
            }
        }
        
        $sql_2 = 'UPDATE `facss_users` SET `reg_localhelp` = ? WHERE user_id = ?';
        $Q_2 = $this->db->query($sql_2,[serialize($LHID_arr), (int)$uid]);
        
        $sql_3 = 'UPDATE `facss_localhelp` SET `signup_cnt` = `signup_cnt` - 1 WHERE id = ?';
        $Q_3 = $this->db->query($sql_3,(int)$cancel_LHID);
    }
}
