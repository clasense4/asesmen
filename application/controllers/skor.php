<?php

class skor extends CI_Controller {
	/**
	 * Constructor, kegiatan_model
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_skor', '', TRUE);
		$this->load->model('helper_model', '', TRUE);
	}

	/**
	 * Inisialisasi variabel untuk $title(untuk id element <body>)
	 */
	var $title = 'asesor';

	function index()
	{
		if ($this->session->userdata('login') == TRUE)
		{
			$this->get_all();
		}
		else
		{
			redirect('login');
		}
	}

	/**
	 * Tampilkan semua data skor
	 */
	function get_all()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Data Skor';
		$data['main_view'] = 'basic_table';

		// Load data
		$skor = $this->model_skor->search(NULL,NULL,'skor');
		$num_rows = $this->model_skor->count(NULL,NULL,'skor');
		// $this->helper_model->printr($skor);die;

		if ($num_rows > 0)
		{
			// Table
			/*Set table template for alternating row 'zebra'*/
			$tmpl = array( 'table_open'    => '<table border="0" cellpadding="0" cellspacing="0">',
						  'row_alt_start'  => '<tr class="zebra">',
							'row_alt_end'    => '</tr>'
						  );
			$this->table->set_template($tmpl);

			/*Set table heading */
			$this->table->set_empty("&nbsp;");

			$fields = array();
			array_push($fields, 'No');
			$table_fields = $this->db->list_fields('skor');
			foreach ($table_fields as $key => $value) {
			array_push($fields,$value);
			}
			array_push($fields, 'actions');
			$this->table->set_heading($fields);
			$i = 0;

			foreach ($skor as $row)
			{
				$this->table->add_row(++$i, $row->id_skor,$row->nama,$row->prosentasi_skor,$row->id_group_skor,
										anchor('skor/update/'.$row->id_skor,'update',array('class' => 'update')).' '.
										anchor('skor/delete/'.$row->id_skor,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
			}
			$data['table'] = $this->table->generate();
		}
		else
		{
			$data['message'] = 'Tidak ditemukan satupun data skor!';
		}

		$data['link'] = array('link_add' => anchor('skor/add/','tambah data', array('class' => 'add'))
								);

		// Load view
		$this->load->view('template_kegiatan', $data);
	}

}