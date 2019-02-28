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

        $post_id = $data['post']['id'];

        $data['comments'] = $this->comment_model->get_comments($post_id);

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
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('/users/login');
        }

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
            $this->upload->do_upload('userfile'); //使用do_upload('上传框的name')方法进行上传
            var_dump($this->upload->do_upload());

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $post_image = 'noimage.png';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }

            $this->post_model->create_posts($post_image);

            // Set message
            $this->session->set_flashdata('post_created','Your post has been created');

            redirect(base_url() . 'posts/');
        }
    }

    public function delete($id)
    {
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('/users/login');
        }

        $this->post_model->delete_posts($id);

        $this->session->set_flashdata('post_deleted','post has been deleted');

        redirect(base_url() . 'posts/');
    }

    public function edit($slug)
    {
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('/users/login');
        }

        $data['post'] = $this->post_model->get_posts($slug);

        // Check the user
        if ($this->session->userdata('user_id')!=$data['post']['user_id']) {
            redirect('posts');
        }

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
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('/users/login');
        }

        $this->post_model->update_posts($id);

        $this->session->set_flashdata('post_updated','Your post has been updated');

        redirect(base_url() . 'posts/');
    }
}