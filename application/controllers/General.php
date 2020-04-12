<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->library(array('form_validation', 'session'));

        $this->load->view('header');
        $this->load->view('footer');
    }

    public function index()
	{
		$this->load->view('login');
    }
    
    public function registro()
    {
        $this->load->view('registro');
    }

    public function registerUser()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Rules
        $this->form_validation->set_rules('email', 'Correo', 'trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|min_length[6]|max_length[30]');
        $this->form_validation->set_rules('password-confirm', 'Confirmar contraseña', 'trim|min_length[6]|max_length[30]|matches[password]');

        
        if ($this->form_validation->run()){
            
            if ($this->user_model->registerUser($name, $email, $password)){  
                redirect('general', 'refresh');
                echo "Usuario registrado correctamente";
            } else {
                redirect('general/registro', 'refresh');
            }
        } else {
            redirect('general/registro', 'refresh');
            echo "No se ha podido efectuar su registro";
        } 
    }

    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Rules
        $this->form_validation->set_rules('email', 'Correo', 'trim|valid_email');

        if ($this->form_validation->run()){
            //Try to do login
            if ($this->user_model->authenticate($email, $password)){
                echo "Usuario logeado correctamente";

                //Get user data
                $user = $this->user_model->getUser($email);
                //Create user session
                $user_session = array (
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'registerDate' => $user->registerDate,
                    'logged' => true
                );

                $this->session->set_userdata('userinfo', $user_session);

                redirect('panel/', 'refresh');

            } else {
                redirect('general/', 'refresh');
                echo "Email o contraseña incorrectos";
            }
        } else {
            redirect('general/', 'refresh');
            echo "No se ha podido efectuar el login";
        }
    }

    public function logout()
    {
        $remove_sessions = array('id', 'name', 'email', 'registerDate', 'logged');
        $this->session->unset_userdata($remove_sessions);
        $this->session->sess_destroy();
        echo "Sesion cerrada correctamente";
        redirect('general/', 'refresh');
    }

}