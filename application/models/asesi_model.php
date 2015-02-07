<?php
class asesi_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// Inomorialisasi nama tabel asesi
	var $table = 'asesi';
	
	/**
	 * Mendapatkan data semua asesi
	 */
	function get_asesi()
	{
		$this->db->order_by('id_asesi');
		return $this->db->get('asesi');
	}
	
	function get_all_asesi()
	{
		$this->db->select('*');
		$this->db->from('assign_asesi');
	}

	function get_all($limit, $offset)
	{
		$this->db->select('asesi.nomor, asesi.nama as namaasesi, asesi.jabatan,asesi.unit, kegiatan.nama');
		$this->db->from($this->table);
		$this->db->join('kegiatan', 'kegiatan.id_kegiatan = asesi.id_kegiatan');
		$this->db->limit($limit, $offset);
		$this->db->order_by('nomor', 'asc');
		return $this->db->get()->result();
	}
	
	/**
	 * Mendapatkan data seorang asesi dengan nomor tertentu
	 */
	function get_asesi_by_id($nomor)
	{
		return $this->db->get_where($this->table, array('nomor' => $nomor))->row();
	}
	
	/**
	 * Menghitung jumlah baris tabel asesi
	 */
	function count_all()
	{
		return $this->db->count_all($this->table);
	}
	
	/**
	 * Menghapus data asesi tertentu
	 */
	function delete($nomor)
	{
		$this->db->delete($this->table, array('nomor' => $nomor));
	}
	
	/**
	 * Menambah data asesi
	 */
	function add($asesi)
	{
		$this->db->insert($this->table, $asesi);
	}
	
	/**
	 * Update data asesi
	 */
	function update($nomor, $asesi)
	{
		$this->db->where('nomor', $nomor);
		$this->db->update($this->table, $asesi);
	}
	
	/**
	 * Cek nomor agar tidak ada data asesi yang sama
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
// END asesi_model Class

/* End of file asesi_model.php */
/* Location: ./system/application/models/asesi_model.php */