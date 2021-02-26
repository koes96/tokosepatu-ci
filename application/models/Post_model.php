<?php
class Post_model extends CI_Model {

    public function getPosts($limit,$start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('produk');
        return $query->result();
    }

    public function getPostsCount()
    {
        $this->db->select('id_produk');
        $this->db->from('produk');
        return $this->db->count_all_results();
    }

}