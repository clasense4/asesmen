<?php

class user_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// Inisialisasi username tabel yang digunakan
	var $table = 'user';
	
	/**
	 * Mendapatkan semua data user, diurutkan berdasarkan id_user
	 */
	function get_user()
	{
		$this->db->order_by('id_user');
		return $this->db->get('user');
	}
	
	/**
	 * Mendapatkan data sebuah user
	 */
	function get_user_by_id($id_user)
	{
		return $this->db->get_where($this->table, array('id_user' => $id_user), 1)->row();
	}
	
	function get_all()
	{
		$this->db->order_by('id_user');
		return $this->db->get($this->table);
	}
	
	/**
	 * Menghapus sebuah data user
	 */
	function delete($id_user)
	{
		$this->db->delete($this->table, array('id_user' => $id_user));
	}
	
	/**
	 * Tambah data user
	 */
	function add($user)
	{
		$this->db->insert($this->table, $user);
	}
	
	/**
	 * Update data user
	 */
	function update($id_user, $username, $password)
	{
		$this->db->where('id_user', $id_user);
		$this->db->update($this->table, $user);
	}
	
	/**
	 * Validasi agar tidak ada user dengan id ganda
	 */
	function valid_id($id_user)
	{
		$query = $this->db->get_where($this->table, array('id_user' => $id_user));
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

/* Location: ./system/application/models/user_model.php */