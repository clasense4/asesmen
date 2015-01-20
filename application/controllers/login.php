<?php
class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Login_model', '', TRUE);
    }
    
    function index () {
        if ($this->session->userdata('login') == TRUE) {
            redirect('kegiatan');
        }
        
        else {
            $this->load->view('login/login_view');
        }
    }
    function process_login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            if ($this->Login_model->check_user($username, $password) == TRUE) {
                $data = array('username' => $username, 'login' => TRUE);
                $this->session->set_userdata($data);
                redirect('kegiatan');
            }
            
            else {
                $this->session->set_flashdata('message', 'maaf, username dan password anda salah');
                redirect('login/index');//form tujuan
            }
        }
        
        else {
            $this->load->view('login/login_view');
        }
    }
    
    function process_logout() {
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }
}
?>