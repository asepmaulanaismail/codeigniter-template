<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    private $isAuthRequired = false;

    public function __construct() {
        // set true if this controller required auth
        parent::__construct($this->isAuthRequired);

        // Load form helper library
        $this->load->helper('form');
        // Load database
        $this->load->model('UserModel');
    }

	public function index()
	{
		$this->load->view('home');
	}
}
