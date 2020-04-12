<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUser($email)
    {
        $this->db->from('users');
        $this->db->where('email', $email);
        return $this->db->get()->row();
    }

    public function registerUser($name, $email, $password)
    {
        $data = array (
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'registerDate' => date('Y-m-d')
            /*'ip' => $this->input->put->ip_address()*/
        );

        return $this->db->insert('users', $data);    
    }

    public function authenticate($email, $password)
    {
        $this->db->from('users');
        $this->db->where('email', $email);
        $hash = $this->db->get()->row('password');
        
        return password_verify($password, $hash);
    }


}