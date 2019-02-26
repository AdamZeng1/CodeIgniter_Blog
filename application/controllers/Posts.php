<?php
/**
 * Created by PhpStorm.
 * User: adamzeng
 * Date: 2019-02-25
 * Time: 13:27
 */

class Posts extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Latest Posts';

        $data['posts'] = $this->post_model->get_posts();

//        print_r($data['posts']);

        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
    }


    public function view($slug = NULL)
    {
        $data['post'] = $this->post_model->get_posts($slug);

        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = $data['post']['title'];


        $this->load->view('templates/header');
        $this->load->view("posts/view", $data);
        $this->load->view('templates/footer');

    }

    public function create()
    {
        $data['title'] = 'Create Post';

        $data['categories'] = $this->post_model->get_categories();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules("body", 'Body', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view("posts/create", $data);
            $this->load->view('templates/footer');
        } else {
            // Upload Image
            $config['upload_path'] = './assets/images/posts';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';
            $this->load->library('upload', $config);


            if(!$this->upload->do_upload()){
                $errors = array('error' => $this->upload->display_errors());
                $post_image = 'noimage.jpg';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }

            $this->post_model->create_posts($post_image);
            redirect(base_url() . 'posts/');
        }
    }

    public function delete($id)
    {
        $this->post_model->delete_posts($id);
        redirect(base_url() . 'posts/');
    }

    public function edit($slug)
    {
        $data['post'] = $this->post_model->get_posts($slug);

        $data['categories'] = $this->post_model->get_categories(); // get all categories

        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = 'Edit Post';


        $this->load->view('templates/header');
        $this->load->view("posts/edit", $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $this->post_model->update_posts($id);
        redirect(base_url() . 'posts/');
    }
}