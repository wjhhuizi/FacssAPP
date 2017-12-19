<?php

class test extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function testSession()
    {/** <测试func：用户Session数据> **/
        echo'<pre>';
        var_export($this->session->userdata());
        echo'</pre>';
    }
    
    
}
