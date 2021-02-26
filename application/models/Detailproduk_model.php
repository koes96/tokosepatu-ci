<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detailproduk_model extends CI_Model {

	var $table = 'detailproduk';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_by_id($iddetail)
	{
		$this->db->from($this->table);
		$this->db->where('id_detailproduk',$iddetail);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($datadetail)
	{
		$this->db->insert($this->table, $datadetail);
		return $this->db->insert_id();
	}

	public function update($where, $datadetail)
	{
		$this->db->update($this->table, $datadetail, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('produk_detailproduk', $id);
		$this->db->delete($this->table);
	}


}
