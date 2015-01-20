<?php
class hasil_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// Inomorialisasi nama tabel hasil
	var $table = 'hasil';
	
	/**
	 * Mendapatkan data semua hasil
	 */
	function get_all($limit, $offset)
	{
		$this->db->select('hasil.id_hasil, asesi.nomor, hasil.p1, hasil.p2, hasil.p3, hasil.p4, hasil.p5, hasil.p6, hasil.p7, hasil.p8, hasil.potensi, hasil.i1, hasil.i2, hasil.i3, hasil.i4, hasil.i5, hasil.inti, hasil.t, hasil.teknis, hasil.total, hasil.rekomendasi, asesor.namaasesor');
		$this->db->from($this->table);
		$this->db->join('asesi', 'asesi.nomor = hasil.nomor');
		$this->db->join('asesor', 'asesor.id_asesor = hasil.id_asesor');
		$this->db->limit($limit, $offset);
		$this->db->order_by('id_hasil', 'asc');
		return $this->db->get()->result();
	}
	
	/**
	 * Mendapatkan data seorang hasil dengan nomor tertentu
	 */
	function get_hasil_by_id($id_hasil)
	{
		return $this->db->get_where($this->table, array('id_hasil' => $id_hasil))->row();
	}
	
	/**
	 * Menghitung jumlah baris tabel hasil
	 */
	function count_all()
	{
		return $this->db->count_all($this->table);
	}
	
	/**
	 * Menghapus data hasil tertentu
	 */
	function delete($id_hasil)
	{
		$this->db->delete($this->table, array('id_hasil' => $id_hasil));
	}
	
	/**
	 * Menambah data hasil
	 */
	function add($hasil)
	{
		$this->db->insert($this->table, $hasil);
	}
	
	/**
	 * Update data hasil
	 */
	function update($id_hasil, $hasil)
	{
		$this->db->where('id_hasil', $id_hasil);
		$this->db->update($this->table, $hasil);
	}
	
	/**
	 * Cek nomor agar tidak ada data hasil yang sama
	 */
	function valid_nomor($nomor)
	{
		$query = $this->db->get_where($this->table, array('nomor' => $nomor));
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
// END hasil_model Class

/* End of file hasil_model.php */
/* Location: ./system/application/models/hasil_model.php */