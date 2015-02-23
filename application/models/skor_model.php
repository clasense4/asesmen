<?php

class skor_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// Inisialisasi namaskor tabel yang digunakan
	var $table = 'skor';

	/**
	 * Mendapatkan semua data skor, diurutkan berdasarkan id_skor
	 */
	function get_skor()
	{
		$this->db->order_by('id_skor');
		return $this->db->get('skor');
	}
	
	/**
	 * Mendapatkan data sebuah skor
	 */
	function get_skor_by_id($id_skor)
	{
		return $this->db->get_where($this->table, array('id_skor' => $id_skor), 1)->row();
	}
	
	function get_all()
	{
		$this->db->order_by('id_skor');
		return $this->db->get($this->table);
	}
	
	/**
	 * Menghapus sebuah data skor
	 */
	function delete($id_skor)
	{
		$this->db->delete($this->table, array('id_skor' => $id_skor));
	}
	
	/**
	 * Tambah data skor
	 */
	function add($skor)
	{
		$this->db->insert($this->table, $skor);
	}
	
	/**
	 * Update data skor
	 */
	function update($id_skor, $skor)
	{
		$this->db->update($this->table, $skor, array('id_skor' => $id_skor));
	}
	
	/**
	 * Validasi agar tidak ada skor dengan id ganda
	 */
	function valid_id($id_skor)
	{
		$query = $this->db->get_where($this->table, array('id_skor' => $id_skor));
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

/* Location: ./system/application/models/skor_model.php */
