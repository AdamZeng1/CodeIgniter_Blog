<?php
/**
 * Created by PhpStorm.
 * User: adamzeng
 * Date: 2019-02-27
 * Time: 11:55
 */

class Categories extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Categories';

        $data['categories'] = $this->category_model->get_categories();

        $this->load->view('templates/header');
        $this->load->view("categories/index", $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create Category';

        $this->form_validation->set_rules('category_name', 'Category_name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view("categories/create", $data);
            $this->load->view('templates/footer');
        } else {
            $this->category_model->create_category();

            $this->session->set_flashdata('category_created','Your category has been created');

            redirect(base_url().'categories'); // 未填写
        }
    }

    public function posts($id) { // $id是category的id
        $data['title'] = $this->category_model->get_category($id)->name;


        $data['posts'] = $this->category_model->get_posts($id);

        $this->load->view('templates/header');
        $this->load->view("posts/index", $data);
        $this->load->view('templates/footer');

    }
}