<?php
/**
 * Created by PhpStorm.
 * User: adamzeng
 * Date: 2019-02-27
 * Time: 19:25
 */

class User_model extends CI_Model
{
    public function register($enc_password)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $enc_password,
            'zipcode' => $this->input->post('zipcode'),
        );

        return $this->db->insert('users', $data);
    }

    public function login($username, $password)
    {
        $this->db->where(array('username' => $username));
        $this->db->where(array('password' => $password));

        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {
            return $result->row(0)->id;
        } else {
            return false;
        }

    }


    public function check_username_exists($username)
    {
        $query = $this->db->get_where('users', array('username' => $username));

        $data = $query->row_array();

        if (empty($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function check_email_exists($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));

        $data = $query->row_array();

        if (empty($data)) {
            return true;
        } else {
            return false;
        }
    }

}