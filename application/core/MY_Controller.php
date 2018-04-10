<?php
Class MY_Controller extends CI_Controller {

    private $withAuth = false;
    public function __construct($withAuth = false) {
        parent::__construct();
        $this->withAuth = $withAuth;

        if ($this->withAuth){
            $isAuth = $this->isAuthenticated();
            if ($isAuth){
                // echo "auth";
            }else{
                // echo "not auth";
            }
        }else{
            // echo "no auth required";
        }
    }

    private function isAuthenticated(){
        if ($this->isLoggedIn()) {
            return true;
        }
        return false;
    }

    public function isLoggedIn(){
        return isset($this->session->userdata['logged_in']);
    }
}