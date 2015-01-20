<?php

class kegiatan_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// Inisialisasi nama tabel yang digunakan
	var $table = 'kegiatan';
	
	/**
	 * Mendapatkan semua data kegiatan, diurutkan berdasarkan id_kegiatan
	 */
	function get_kegiatan()
	{
		$this->db->order_by('id_kegiatan');
		return $this->db->get('kegiatan');
	}
	
	/**
	 * Mendapatkan data sebuah kegiatan
	 */
	function get_kegiatan_by_id($id_kegiatan)
	{
		return $this->db->get_where($this->table, array('id_kegiatan' => $id_kegiatan), 1)->row();
	}
	
	function get_all()
	{
		$this->db->order_by('id_kegiatan');
		return $this->db->get($this->table);
	}
	
	/**
	 * Menghapus sebuah data kegiatan
	 */
	function delete($id_kegiatan)
	{
		$this->db->delete($this->table, array('id_kegiatan' => $id_kegiatan));
	}
	
	/**
	 * Tambah data kegiatan
	 */
	function add($kegiatan)
	{
		$this->db->insert($this->table, $kegiatan);
	}
	
	/**
	 * Update data kegiatan
	 */
	function update($id_kegiatan, $nama, $instansi, $tanggal, $note)
	{
		$this->db->where('id_kegiatan', $id_kegiatan);
		$this->db->update($this->table, $kegiatan);
	}
	
	/**
	 * Validasi agar tidak ada kegiatan dengan id ganda
	 */
	function valid_id($id_kegiatan)
	{
		$query = $this->db->get_where($this->table, array('id_kegiatan' => $id_kegiatan));
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

/* Location: ./system/application/models/kegiatan_model.php */