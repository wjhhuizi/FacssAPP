<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth/CheckSession', 'chk_sess');
        //检查登陆Session
        if($this->chk_sess->main()) {
        redirect('/main', 'refresh');
        }

    }
    
    public function index()
    {
        //return http_response_code(403);
        $this->load->view('index/login');                                       // 调用login UI
        
    }
    
    public function login()                                                    // 处理登录信息
    {
        /** <Load Model> **/
        $this->load->model('auth/UserLib', 'm_login');                          // 加载登录模块
        
        /** <Get Request> **/
        $user['nid'] = filter_input(INPUT_POST, 'username');                    // 获取POST表单
        $user['pass'] = filter_input(INPUT_POST, 'password');
        
        /** <Validate User Credentials> **/
        $Q = $this->m_login->checkExist($user['nid']);
        
        if(NULL === ($Q))
        {//如果数据库不存在该NetID，返回错误
            echo "<script>alert('此NetID未注册！');\n</script>";
            redirect('/index', 'refresh');
            return;
        }
        else
        {//如果NetID存在，进行登录
            $result = $this->m_login->checkPassWord($user);
            if(NULL === ($result))
            {//登录失败
                echo "<script>alert('您输入的密码有误！');\n</script>";
                redirect('/index', 'refresh');
                return;
            }
            else
            {//登陆成功
                /* 检查用户Permission */
                
                
                /** <Update Session> **/
                $this->session->userID = (int)$result['user_id'];
                $this->session->Logged_In = (bool)true;
                $this->session->perm = $this->m_login->checkPerm((int)$result['user_id']);
                //echo $this->session->userID ." ". $this->session->Logged_In ." ". $this->session->perm;
                //echo "<script>alert('登陆成功！');\n</script>";
                redirect('/main', 'refresh');
            }
            return;
        }

    }
    
    public function register()
    {
        /** <Load View> **/
        $this->load->view('index/register');
    }
    
    public function reg()
    {
        /** <Load Model> */
        $this->load->model('auth/UserLib', 'm_reg');                            // 加载注册模块
        
        /** <Get Request> */
        $user['nid'] = filter_input(INPUT_POST, 'username');                    // 获取POST表单
        $user['pass'] = filter_input(INPUT_POST, 'password');
        $user['email'] = filter_input(INPUT_POST, 'email');
        //print_r($user);
        
        /** <Call Register model> */
        $Q = $this->m_reg->checkExist($user['nid']);
        
        if(NULL !== ($Q))
        {//如果数据库已经存在该NetID，重定向到登录页面
            echo "<script>alert('该用户已经注册！请登录！');\n</script>";
            redirect('/index', 'refresh');
        }
        else
        {//如果不存在，完成注册后返回登录页面
            $Q = $this->m_reg->reg($user);
            echo "<script>alert('注册成功！请登录！');\n</script>";
            redirect('/index', 'refresh');
        }
        
    }
    
}
