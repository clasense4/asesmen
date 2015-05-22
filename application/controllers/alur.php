<?php

class alur extends CI_Controller {
	/**
	 * Constructor, kegiatan_model
	 */
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Inomorialisasi variabel untuk $title(untuk id element <body>), dan
	 * $limit untuk membatasi penampilan data di tabel
	 */
	var $title = 'Alur';

	/**
	 * Memeriksa user state, jika dalam keadaan login akan menjalankan fungsi get_all()
	 * jika tidak akan meredirect ke halaman login
	 */
	function index()
	{
		if ($this->session->userdata('login') == TRUE)
		{
			$offset = 0;
			$this->get_all();
		}
		else
		{
			redirect('login');
		}
	}

	/**
	 * Mendapatkan semua data asesi di database dan menampilkannya di tabel
	 */
	function get_all()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Alur Penggunaan Sistem';
		$data['main_view'] = 'alur';

		// Load view
		$this->load->view('template_kegiatan', $data);
	}

	/**
	 * Menghapus data asesi dengan nomor tertentu
	 */

}
// END asesi Class

/* End of file asesi.php */
/* Location: ./system/application/controllers/asesi.php */