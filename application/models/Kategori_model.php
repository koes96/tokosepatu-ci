<?php

/**
 * 
 */
class Kategori_model extends CI_Model
{
	function tampil_kategori()
	{
		//$this->db->order_by('nama_mitra','DESC');
		return $this->db->from('kategori')->get()->result();
	}

	function Getid($idk='')
	{
		return $this->db->get_where('kategori', array('id_kategori' => $idk))->row();
	}

	function hapus_mitra($idk)
	{
		$this->db->delete('kategori', array('id_kategori' => $idk));
	}
}