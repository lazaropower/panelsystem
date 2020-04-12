<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->library('session');

        $this->load->view('header');
        $this->load->view('footer');

        // Getting session
        $this->userinfo = $this->session->userdata('userinfo');

        // Check if user is 
        if (!$this->userinfo['logged']){
            redirect('general/', 'refresh');
        }

    }

    public function index()
    {
        $this->load->view('panel');
    }
}