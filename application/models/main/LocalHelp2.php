<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocalHelp2 extends CI_Model
{
    protected $perm_level;                         //权限等级
    
    public function __construct()
    {
        parent::__construct();
        $this->perm_level = $this->session->perm;
        $this->load->database();
    }
    
    public function getSchedule() 
    {// <获取LocalHelp时间表>
        $sql_1 = "SELECT `id`, `title`, `department`, `datetime`, `signup_cnt`, `state` "
                . "FROM `facss_localhelp`";
        $result = $this->db->query($sql_1)->result_array();
        $data = [];
        foreach ($result as $v) {
            array_push($data, [
                'id'         => (int)$v['id'], 
                'title'      =>      $v['title'],
                'department' =>      $v['department'],
                'datetime'   =>      $v['datetime'],
                'signup_cnt' => (int)$v['signup_cnt'],
                'state'      => (int)$v['state']
            ]);
        }
        return $data;
    }
    
    public function getContentById($lhid)
    {// <获取相应LHID的内容>
        $sql_1 = "SELECT * FROM `facss_localhelp` WHERE `id`=?";
        $result = $this->db->query($sql_1, [$lhid])->row_array();
        if (!$result) {return false;}
        
        $data =['id'         => (int)$result['id'], 
                'title'      =>      $result['title'],
                'department' =>      $result['department'],
                'datetime'   =>      $result['datetime'],
                'signup_cnt' => (int)$result['signup_cnt'],
                'content'    =>      $result['content'], 
                'state'      => (int)$result['state'],
                'QR_img'     =>      $result['QR_img'],
                'attachment' =>      $result['attachment']];
        
        return $data;
    }
    
    public function userCheckEvent($uid, $lhid)
    {// <用户报名查询>
        $sql_1 = "SELECT 1 FROM `facss_localhelp_record` WHERE `uid`=? AND `lhid`=?";
        $result_1 = $this->db->query($sql_1, [$uid, $lhid])->row_array();
        if(isset($result_1)) {
            return true;
        }
        else { 
            return false;
        }
    }
    
    public function userRegisterEvent($uid, $lhid)
    {// <用户报名>
        $sql_1 = "SELECT 1 FROM `facss_localhelp_record` WHERE `uid`=? AND `lhid`=?";
        $sql_2 = "INSERT INTO `facss_localhelp_record` (`uid`, `lhid`) VALUES (?,?)";
        $result_1 = $this->db->query($sql_1, [$uid, $lhid])->row_array();
        if(isset($result_1)){
            return false;
        }
        $this->db->query($sql_2, [$uid, $lhid]);
        return $this->db->affected_rows();
    }
    
    public function userCancelEvent($uid, $lhid)
    {// <用户取消报名>
        $sql_1 = "SELECT 1 FROM `facss_localhelp_record` WHERE `uid`=? AND `lhid`=?";
        $sql_2 = "DELETE FROM `facss_localhelp_record` WHERE `uid`=? AND `lhid`=?";
        $result_1 = $this->db->query($sql_1, [$uid, $lhid])->row_array();
        if(!isset($result_1)){
            return false;
        }
        $this->db->query($sql_2, [$uid, $lhid]);
        return $this->db->affected_rows();
    }
    
    public function mod_addEvent($title,$location,$content,$departmrnt,$datetime,$state=0,$QR_img=null,$attachment=null)
    {// <管理员添加 LocalHelp条目>
        if($this->perm_level < 1) {return false;}  // 检查权限
        $sql_1 = "INSERT INTO `facss_localhelp` "
                . "(title,location,content,department,datetime,state,QR_img,attachment) "
                . "VALUES (?,?,?,?,?,?,?,?)";
        $result_1 = $this->db->query($sql_1, [$title,$location,$content,$departmrnt,$datetime,$state,$QR_img,$attachment]);
        return $result_1;
    }
    
    public function mod_delEvent($lhid)
    {// <管理员删除 LocalHelp条目>
        if($this->perm_level < 1) {return false;}  // 检查权限
        $sql_1 = "DELETE FROM `facss_localhelp` WHERE id = ?";
        $this->db->query($sql_1,[$lhid]);
        return $this->db->affected_rows();
    }
    
    public function mod_editEvent()
    {// <管理员修改LocalHelp条目>
        
    }
    
    public function mod_editState($lhid, $state)
    {// <管理员修改LocalHelp开放状态>
        
    }
    
}
