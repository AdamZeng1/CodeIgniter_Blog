<?php

/**
 * Created by PhpStorm.
 * User: adamzeng
 * Date: 2019-02-25
 * Time: 13:44
 */
class Post_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function get_posts($slug = FALSE)
    {
        if ($slug === FALSE) { // query all posts
            $this->db->order_by('posts.id', 'DESC');
            $this->db->join('categories','categories.id=posts.category_id');

            $query = $this->db->get('posts');
            return $query->result_array();
        }


        $query = $this->db->get_where('posts', array('slug' => $slug)); // first slug is item in database
        // the second $slug is the parameter of this method

        return $query->row_array();
    }

    public function create_posts($post_image)
    {
        $slug = url_title($this->input->post('title'));


        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'body' => $this->input->post('body'),
            'user_id'=>$this->session->userdata('user_id'),
            'post_image'=>$post_image, // add post_image field
            'category_id' => $this->input->post('category_id'),
        );

        return $this->db->insert('posts', $data); // posts为table name
    }

    public function delete_posts($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('posts');
        return true;
    }

    public function update_posts($id)
    {
        $slug = url_title($this->input->post('title')); // post means POST method I thought

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'body' => $this->input->post('body'),
            'category_id' => $this->input->post('category_id'),
        );
        $this->db->where('id', $id);
        $this->db->update('posts', $data);
    }

    public function get_categories()
    {
        $this->db->order_by('name');

        $query = $this->db->get('categories');

        return $query->result_array();
    }
}