<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Model_login');
    }

    public function index()
    {
        $error = '';

        $data['setting'] = $this->Model_login->get_setting_data();
        date_default_timezone_set($data['setting']['timezone']);
        $logged_in = $this->session->userdata('logged_in');
        if($logged_in)
        {
            redirect(base_url().'admin/dashboard');
        }

        if(isset($_POST['form1'])) {

            // Getting the form data
            $email = $this->input->post('email',true);
            $password = $this->input->post('password',true);

            // Checking the email address
            $un = $this->Model_login->check_email($email);

            if(!$un) {
                $error = 'Invalid Username / Email';
                $this->session->set_flashdata('error',$error);
                redirect(base_url().'admin');

            } else {

                // When email found, checking the password
                $pw = $this->Model_login->check_password($email,$password);

                if(!$pw) {
                    
                    $error = 'Invalid Account Username/Password!';
                    $this->session->set_flashdata('error',$error);
                    redirect(base_url().'admin');

                } else {

                    // When email and password both are correct
                    $array = array(
                        'id' => $pw['id'],
                        'email' => $pw['email'],
                        'username' => $pw['username'],
                        'firstname' => $pw['firstname'],
                        'lastname' => $pw['lastname'],
                        'photo' => $pw['photo'],
                        'countrycode' => $pw['countrycode'],
                        'phoneno' => $pw['phoneno'],
                        'role' => $pw['role'],
                        'status' => $pw['status'],
                        'logged_in' => true
                    );
                    $this->session->set_userdata($array);
                    redirect(base_url().'admin/dashboard');
                }
            }
        } else {
            //$this->load->view('admin/view_login',$data);    
            redirect(base_url());
        }
        
    }

    function logout() {
        $this->session->sess_destroy();
        redirect(base_url().'admin');
    }
}
