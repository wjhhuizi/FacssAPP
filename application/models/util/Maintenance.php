<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /* 启用请将private修改为public */
    
    private function update_db() 
    {/** <更新LocalHelp数据库结构 2017-12-17> */
        $sql1 = "SELECT `user_id`, `reg_localhelp` from `facss_users` LIMIT 1000";
        $sql2 = "INSERT IGNORE INTO `facss_localhelp_record` (`uid`, `lhid`) VALUES (?,?)";
        $r1 = $this->db->query($sql1);
        foreach ($r1->result_array() as $row)
        {
            $lh_arr = (Array)unserialize($row['reg_localhelp']);
            
            foreach($lh_arr as $v)
            {
                if($v) {
                    $this->db->query($sql2, [$row['user_id'], $v]);
                }
            }
            
        }
    }
    
    
    
    
}
