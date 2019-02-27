<?php
/**
 * Created by PhpStorm.
 * User: adamzeng
 * Date: 2019-02-27
 * Time: 18:32
 */

class Users extends CI_Controller
{
    public function register()
    {
        $data['title'] = 'Sign Up';

        $this->form_validation->set_rules("name", 'Name', 'required'); // 在视图需要添加error提醒
        $this->form_validation->set_rules("username", 'Username', 'required|callback_check_username_exists'); // 在视图需要添加error提醒
        $this->form_validation->set_rules("email", 'email', 'required|callback_check_email_exists'); // 在视图需要添加error提醒
        $this->form_validation->set_rules("password", 'Password', 'required'); // 在视图需要添加error提醒
        $this->form_validation->set_rules("password2", 'Confirm Password', 'required|matches[password]'); // 在视图需要添加error提醒

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view("users/register", $data);
            $this->load->view('templates/footer');
        } else {

            // Encrypt password
            $enc_password = md5($this->input->post('password'));
            $this->user_model->register($enc_password);


            $this->session->set_flashdata('user_registered', 'You are now registered and can log in');


            redirect('posts');
        }
    }

    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');

        if ($this->user_model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    public function check_email_exists($email) {
        $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');

        if ($this->user_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }

    }
}