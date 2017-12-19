<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth/CheckSession', 'chk_sess');
        //检查登陆Session
        if(!$this->chk_sess->main()) {
            echo "<script>alert('请先登录！');</script>";
            redirect('/index', 'refresh');
        }
        $this->load->model('main/LocalHelp2', 'lh2');
//        print("<pre>");
//        var_dump($this->lh2->mod_addEvent("LocalHelp测试",null,"这里是一些内容","管理员，Admin","20170509115959"));
//        var_dump($this->lh2->userRegisterEvent(2017100117, 8));
//        var_dump($this->lh2->userCancelEvent(2017100117,8));
//        var_dump($this->lh2->mod_delEvent(8));
//        print("</pre>");
    }
    
    /** 检查用户权限 **/
    private function check_perm()
    {
        $this->load->model('auth/CheckPerm', 'CkPerm');
        return (int)$this->CkPerm->checkPerm($this->session->userID);
    }
    
    private function loadpage($content_part=null, $para = null)
    {/** <Page loader> **/
        $this->load->view('main/header');
        $this->load->view('main/nav', ['perm' => $this->check_perm()]);
        $this->load->view($content_part, $para);
        $this->load->view('main/footer');
    }
    
    public function logout()
    {// [Controller] /main/logout
        $this->session->sess_destroy();
        echo "<script>alert('登出成功！');\n</script>";
        redirect('/index', 'refresh');
    }
    
    public function index()
    {//[Controller] /main[/index]
        $this->loadpage('main/index');
    }
    
    public function profile()
    {// [Controller] /main/profile
        $this->loadpage('main/profile');
    }
    
    public function localhelp($lhid = null, $action = null /*1: 报名；2：取消*/)
    {// [Controller] /main/localhelp
        /* <Load Model> */
        $this->load->model('main/LocalHelp2', 'm_lh');
        
        if(!isset($lhid)) { // 没有传递ID，显示LocalHelp主页面
            /* <Construct Data> */
            $result = $this->m_lh->getSchedule();
            $VIEW_DATA = ['result' => $result];
            /* <Load View> */
            $this->loadpage('main/localhelp', $VIEW_DATA);
        } 
        else {
            if(!$this->m_lh->getContentById($lhid)) { //如果lhid不存在返回404
                show_404();
            }
            if (!isset($action)){ // 用户点击查看详情
                $status = $this->m_lh->userCheckEvent($this->session->userID, $lhid); // 检查用户是否已经注册该场LocalHelp
                $VIEW_DATA = ['result' => $this->m_lh->getContentById($lhid), 'status' => (int)$status];
                $this->loadpage('localhelp/content', $VIEW_DATA);
            }
            else if ($action=="register"){ // 用户点击详情页报名按钮
                $r = $this->m_lh->userRegisterEvent($this->session->userID, $lhid);
                redirect('main/localhelp/'.$lhid,'auto');
//                $status = $this->m_lh->userCheckEvent($this->session->userID, $lhid);
//                $VIEW_DATA = ['result' => $this->m_lh->getContentById($lhid), 'status' => (int)$status, 'msg' => $r];
//                $this->loadpage('localhelp/content', $VIEW_DATA);
            } 
            else if ($action=="cancel"){ // 用户点击详情页取消报名
                $r = $this->m_lh->userCancelEvent($this->session->userID, $lhid);
                redirect('main/localhelp/'.$lhid,'auto');
//                $status = $this->m_lh->userCheckEvent($this->session->userID, $lhid);
//                $VIEW_DATA = ['result' => $this->m_lh->getContentById($lhid), 'status' => (int)$status, 'msg' => $r];
//                $this->loadpage('localhelp/content', $VIEW_DATA);
            }
        }
    }
    
    public function content($id = null)
    {
        if (!isset($id))
        {
            show_404();
            return;
        }
        /** <Load Model> **/
        $this->load->model('main/LocalHelp', 'm_lh');
        
        /** <Construct Data> **/
        $result = $this->m_lh->getContent($id);
        $LHID_arr = $this->m_lh->getLHID($this->session->userID);
        $status = 0;
        if ($LHID_arr)                                                          // 检查注册状态，已注册=1，未注册=0
        {
            foreach ($LHID_arr as $v)
            {
                if ($v === (int)$id)
                {
                    $status = 1;
                    break;
                }
            }
        }
        if (!isset($result) || 1 != (int)$result['state'])                      // 无结果或者未开放注册返回404
        {
            show_404();
            return;
        }
        
        $VIEW_DATA = ['result' => $result, 'status' => $status, 'id' => $id];
        
        /** <Load View> **/
        $this->load->view('main/header');
        $this->load->view('main/nav', ['perm' => $this->check_perm()]);
        $this->load->view('localhelp/content', $VIEW_DATA);
        $this->load->view('main/footer'); 
    }
    
    /** Ajax */
    public function lh_signup()
    {
        /** <Load Model> **/
        $this->load->model('main/LocalHelp', 'm_lh');
        
        /** <Construct Data> **/
        $result = $this->m_lh->regLHID($this->session->userID, filter_input(INPUT_POST, 'LHID'));
        
        /** <Load [Ajax] View> **/
        echo'{"error": false}';
    }
    
    /** @Ajax */
    public function lh_cancel()
    {
        /** <Load Model> **/
        $this->load->model('main/LocalHelp', 'm_lh');
        
        /** <Construct Data> **/
        $result = $this->m_lh->cancelLHID($this->session->userID, filter_input(INPUT_POST, 'LHID'));
        
        
        /** <Load [Ajax] View> **/
        echo'{"error": false}';
    }
    
    /** @Ajax */
    public function lh_getcontent($id = null)
    {
        if (!isset($id))
        {
            show_404();
            return;
        }
        /** <Load Model> **/
        $this->load->model('main/LocalHelp', 'm_lh');
        
        /** <Construct Data> **/
        $result = $this->m_lh->getContent($id);
        $LHID_arr = $this->m_lh->getLHID($this->session->userID);
        $status = 0;
        if ($LHID_arr)                                                          // 检查注册状态，已注册=1，未注册=0
        {
            foreach ($LHID_arr as $v)
            {
                if ($v === (int)$id)
                {
                    $status = 1;
                    break;
                }
            }
        }
        if (!isset($result) || 1 != (int)$result['state'])                      // 无结果或者未开放注册返回404
        {
            show_404();
            return;
        }
        
        $VIEW_DATA = ['result' => $result, 'status' => $status, 'id' => $id];
        
        /** <Load [Ajax] View> **/
        $this->load->view('localhelp/content', $VIEW_DATA);
    }
}