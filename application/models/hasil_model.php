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
	var $table = 'hasil_penilaian';
	var $table_nilai_potensi = 'nilai_potensi';
	var $table_nilai_inti = 'nilai_inti';
	var $table_nilai_kepemimpinan = 'nilai_kepemimpinan';
	var $table_nilai_jabatan = 'nilai_jabatan';
	var $table_nilai_teknis = 'nilai_teknis';
	
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
	function get_hasil_by_id($id_penilaian)
	{
		return $this->db->get_where($this->table, array('id_penilaian' => $id_penilaian))->row();
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
	function delete($id_penilian)
	{
		$this->db->delete($this->table, array('id_penilaian' => $id_penilian));
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
	
	function getDataByKegiatan($id_kegiatan)
    {
        $query=$this->db->query("SELECT h.id_penilaian, h.id_kegiatan, h.no_asesi, h.nama_asesi, h.potensi, h.uraian_potensi, h.uraian_inti, h.uraian_kepemimpinan,
		h.uraian_jabatan, h.uraian_teknis, h.inti, h.kepemimpinan, h.jabatan, h.teknis, h.total, h.rekomendasi, h.nama_asesor, k.id_kegiatan ,k.nama
									FROM hasil_penilaian h, kegiatan k
									WHERE h.id_kegiatan = k.id_kegiatan AND h.id_kegiatan = $id_kegiatan
									ORDER BY no_asesi ASC
								");
        return $query->result();
    }
	
	function getDataNilaiPotensi($id_kegiatan)
    {
        $query=$this->db->query("SELECT * FROM nilai_potensi WHERE id_kegiatan = $id_kegiatan");
        return $query->result();
    }
	
	function getDataNilaiInti($id_kegiatan)
    {
        $query=$this->db->query("SELECT * FROM nilai_inti WHERE id_kegiatan = $id_kegiatan");
        return $query->result();
    }
	
	function getDataNilaiKep($id_kegiatan)
    {
        $query=$this->db->query("SELECT * FROM nilai_kepemimpinan WHERE id_kegiatan = $id_kegiatan");
        return $query->result();
    }
	
	function getDataNilaiJab($id_kegiatan)
    {
        $query=$this->db->query("SELECT * FROM nilai_jabatan WHERE id_kegiatan = $id_kegiatan");
        return $query->result();
    }
	
	function getDataNilaiTek($id_kegiatan)
    {
        $query=$this->db->query("SELECT * FROM nilai_teknis WHERE id_kegiatan = $id_kegiatan");
        return $query->result();
    }
	
	function get_hasil($id_kegiatan)
	{
		$this->db->order_by('id_penilaian');
		$this->db->where('id_kegiatan', $id_kegiatan);
		return $this->db->get('hasil_penilaian');
	}
	
	/**
	 * Menambah data nilai potensi
	 */
	function addPotensi($nilai_potensi)
	{
		$this->db->insert($this->table_nilai_potensi, $nilai_potensi);
	}
	
	/**
	 * Menambah data nilai inti
	 */
	function addInti($nilai_inti)
	{
		$this->db->insert($this->table_nilai_inti, $nilai_inti);
	}
	
	/**
	 * Menambah data nilai kepemimpinan
	 */
	function addKepemimpinan($nilai_kepemimpinan)
	{
		$this->db->insert($this->table_nilai_kepemimpinan, $nilai_kepemimpinan);
	}
	
	
	/**
	 * Menambah data nilai jabatan
	 */
	function addJabatan($nilai_jabatan)
	{
		$this->db->insert($this->table_nilai_jabatan, $nilai_jabatan);
	}
	
	
	/**
	 * Menambah data nilai teknis
	 */
	function addTeknis($nilai_teknis)
	{
		$this->db->insert($this->table_nilai_teknis, $nilai_teknis);
	}
	
	
	
}
// END hasil_model Class

/* End of file hasil_model.php */
/* Location: ./system/application/models/hasil_model.php */