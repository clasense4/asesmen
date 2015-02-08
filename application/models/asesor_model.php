<?php

class asesor_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// Inisialisasi namaasesor tabel yang digunakan
	var $table = 'asesor';

	/**
	 * Mendapatkan semua data asesor, diurutkan berdasarkan id_asesor
	 */
	function get_asesor()
	{
		$this->db->order_by('id_asesor');
		return $this->db->get('asesor');
	}
	
	/**
	 * Mendapatkan data sebuah asesor
	 */
	function get_asesor_by_id($id_asesor)
	{
		return $this->db->get_where($this->table, array('id_asesor' => $id_asesor), 1)->row();
	}
	
	function get_all()
	{
		$this->db->order_by('id_asesor');
		return $this->db->get($this->table);
	}
	
	/**
	 * Menghapus sebuah data asesor
	 */
	function delete($id_asesor)
	{
		$this->db->delete($this->table, array('id_asesor' => $id_asesor));
	}
	
	/**
	 * Tambah data asesor
	 */
	function add($asesor)
	{
		$this->db->insert($this->table, $asesor);
	}
	
	/**
	 * Update data asesor
	 */
	function update($id_asesor, $asesor)
	{
		// $this->printr($id_asesor);
		// $this->printr($asesor);
		// die;
        // $this->title   = $_POST['title'];
        // $this->content = $_POST['content'];
        // $this->date    = time();

        // $this->db->update('entries', $this, array('id' => $_POST['id']));

		// $this->db->where('id_asesor', $id_asesor);
        // $this->namaasesor = $namaasesor;
		$this->db->update($this->table, $asesor, array('id_asesor' => $id_asesor));
	}
	
	/**
	 * Validasi agar tidak ada asesor dengan id ganda
	 */
	function valid_id($id_asesor)
	{
		$query = $this->db->get_where($this->table, array('id_asesor' => $id_asesor));
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

/* Location: ./system/application/models/asesor_model.php */