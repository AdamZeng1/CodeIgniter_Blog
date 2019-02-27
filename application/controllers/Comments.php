<?php
/**
 * Created by PhpStorm.
 * User: adamzeng
 * Date: 2019-02-27
 * Time: 15:20
 */

class Comments extends CI_Controller
{
    public function create()
    {
        $slug = $this->input->post('slug');
        $data['post'] = $this->post_model->get_posts($slug); // 重新获得数组，重新渲染

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view("posts/view", $data);
            $this->load->view('templates/footer');
        } else {
            $this->comment_model->create_comment($data['post']['id']);
            redirect(base_url().'posts/'.$slug);
        }

    }
}