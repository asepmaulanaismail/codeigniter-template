<?php
Class Auth extends MY_Controller {
    private $isAuthRequired = false;

    public function __construct() {
        // set true if this controller required auth
        parent::__construct($this->isAuthRequired);

        // Load form helper library
        $this->load->helper('form');
        // Load database
        $this->load->model('UserModel');
    }

    public function index() {
        redirect("/auth/login");
    }

    public function login() {
        $this->load->view('auth/signin');
    }

    public function authentication() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if($this->isLoggedIn()){
                $this->load->view('admin_page');
            }else{
                $data = array(
                    'error_message' => validation_errors()
                );
                $this->session->set_flashdata($data);
                redirect("auth/login");
            }
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $result = $this->UserModel->login($data);
            if ($result == TRUE) {
                $username = $this->input->post('username');
                $result = $this->UserModel->read_user_information($username);
                if ($result != false) {
                    $session_data = array(
                        'username' => $result[0]->username,
                        'email' => $result[0]->password,
                    );
                    // Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    $this->load->view('admin_page');
                }   
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->session->set_flashdata($data);
                redirect("auth/login");
            }
        }
    }

    // Show registration page
    public function register() {
        echo "register"; die();
        $this->load->view('registration_form');
    }

    // Validate and store registration data in database
    public function new_user_registration() {

        // Check validation for user input in SignUp form
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email_value', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('registration_form');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'name' => '',
                'password' => $this->input->post('password')
            );
            $result = $this->UserModel->registration_insert($data);
            if ($result == TRUE) {
                $data['message_display'] = 'Registration Successfully !';
                $this->load->view('login_form', $data);
            } else {
                $data['message_display'] = 'Username already exist!';
                $this->load->view('registration_form', $data);
            }
        }
    }

    // Logout from admin page
    public function logout() {
        // Removing session data
        $sess_array = array(
        'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('login_form', $data);
    }

}

?>