<?php
/**
 * Created by PhpStorm.
 * User: adamzeng
 * Date: 2019-02-27
 * Time: 15:21
 */

class Comment_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_comment($post_id)
    {
        $slug = $this->input->post('slug');

//        $post_id = $this->post_model->get_posts($slug);

        $data = array(
            'post_id' => $post_id,
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'body' => $this->input->post('body'),
        );

        $this->db->insert('comments', $data);
    }

    public function get_comments($post_id)
    {
        $query = $this->db->get_where('comments',array('post_id'=>$post_id));
        return $query->result_array();
    }


}