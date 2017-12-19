<?php

class CheckSession extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //put your code here
    
    public function main() {
        if (isset($this->session->userID) && (TRUE == $this->session->Logged_In))
        {
            return true;
        } else {
            return false;
        }
    }
    
    
}
