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
            $this->db->order_by('id','DESC');

            $query = $this->db->get('posts');
            return $query->result_array();
        }


        $query = $this->db->get_where('posts', array('slug' => $slug)); // first slug is item in database
        // the second $slug is the parameter of this method

        return $query->row_array();
    }

    public function create_posts()
    {
        $slug = url_title($this->input->post('title'));


        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'body' => $this->input->post('body'),
        );

        return $this->db->insert('posts',$data); // posts为tablename
    }
}