<?php
/**
 * Created by PhpStorm.
 * User: adamzeng
 * Date: 2019-02-27
 * Time: 12:13
 */

class Category_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_categories()
    {
        $this->db->order_by('name');

        $query = $this->db->get('categories');

        return $query->result_array();

    }

    public function create_category()
    {
        $data = array(
            'name' => $this->input->post('category_name'),
        );

        return $this->db->insert('categories', $data);
    }

    public function get_category($id)
    {
        $query = $this->db->get_where('categories', array('id' => $id)); // first slug is item in database
        return $query->row(); // 返回的是一行数据
    }

    public function get_posts($id)
    {
//        $this->db->order_by('id', 'DESC');
        $this->db->join('categories','categories.id=posts.category_id');

        $query = $this->db->get_where('posts', array('category_id' => $id));
        return $query->result_array(); // 返回对象数组

    }
}