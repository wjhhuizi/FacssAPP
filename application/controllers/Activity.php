<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        /** <Session Check> **/
        if (!isset($this->session->userID) || !(TRUE == $this->session->Logged_In))
        {
            redirect('/index', 'refresh');
        }
        
        
    }
    
    
}