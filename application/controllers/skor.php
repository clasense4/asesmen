<?php

class skor extends CI_Controller {
	/**
	 * Constructor, kegiatan_model
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_skor', '', TRUE);
		$this->load->model('skor_model', '', TRUE);
		$this->load->model('helper_model', '', TRUE);
	}

	/**
	 * Inisialisasi variabel untuk $title(untuk id element <body>)
	 */
	var $title = 'skor';

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

	/**
	 * Menghapus data skor dengan nomor tertentu
	 */
	function delete($id_skor)
	{
		$this->model_skor->delete('id_skor',$id_skor,'skor');
		$this->session->set_flashdata('message', '1 data skor berhasil dihapus');

		redirect('skor');
	}

	/**
	 * Menampilkan form tambah skor
	 */
	function add()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Skor > Tambah Data';
		$data['main_view'] 		= 'skor/skor_form';
		$data['form_action']		= site_url('skor/add_process');
		$data['link'] 			= array('link_back' => anchor('skor','kembali', array('class' => 'back'))
										);

		$this->load->view('template', $data);
	}
	/**
	 * Proses tambah data skor
	 */
	function add_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Skor > Tambah Data';
		$data['main_view'] 		= 'skor/skor_form';
		$data['form_action']		= site_url('skor/add_process');
		$data['link'] 			= array('link_back' => anchor('skor/','kembali', array('class' => 'back'))
										);
		$skor = $this->input->post();
		unset($skor['submit']);
		unset($skor['id_skor']);
		$this->helper_model->printr($skor);
		$this->skor_model->add($skor);
		$this->session->set_flashdata('message', 'Satu data skor berhasil disimpan!');
		redirect('skor');

	}

	/**
	 * Menampilkan form update data skor
	 */
	function update($id_skor)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Skor > Update';
		$data['main_view'] 		= 'skor/skor_form';
		$data['form_action']		= site_url('skor/update_process');
		$data['link'] 			= array('link_back' => anchor('skor','kembali', array('class' => 'back'))
										);

		$skor = $this->model_skor->search('id_skor',$id_skor,'skor');
		$skor = $skor[0];

		// auto generate
		$this->session->set_userdata('skor', $skor->id_skor); 

		$data['default']['id_skor'] = $skor->id_skor;
		$data['default']['nama'] = $skor->nama;
		$data['default']['prosentasi_skor'] = $skor->prosentasi_skor;
		$data['default']['id_group_skor'] = $skor->id_group_skor;
		$this->load->view('template', $data);
	}

	/**
	 * Proses update data skor
	 */
	function update_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Skor > Update';
		$data['main_view'] 		= 'skor/skor_form';
		$data['form_action']		= site_url('skor/update_process');
		$data['link'] 			= array('link_back' => anchor('skor','kembali', array('class' => 'back'))
										);
		$skor = $this->input->post();
		unset($skor['submit']);
		// unset($skor['id_skor']);
		$this->helper_model->printr($skor);
		$this->model_skor->save($skor,'skor');
		$this->session->set_flashdata('message', 'Satu data skor berhasil diupdate!');
		redirect('skor');

	}

	/**
	 * Validasi untuk nomor, agar tidak ada skor dengan Nomor Peserta Sama sama
	 */
	function valid_nomor($nomor)
	{
		if ($this->skor_model->valid_nomor($nomor) == TRUE)
		{
			$this->form_validation->set_message('valid_nomor', "skor dengan Nama Skor $nama sudah terdaftar");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	// cek apakah valid untuk update?
	function valid_nomor2()
	{
		// cek agar tidak ada nomor ganda, khusus untuk proses update
		$current_nomor 	= $this->session->userdata('id_skor');
		$new_nomor	= $this->input->post('id_skor');

		if ($new_nomor === $current_nomor)
		{
			return TRUE;
		}
		else
		{
			if($this->skor_model->valid_nomor($new_id) === TRUE) // cek database untuk entry yang sama memakai valid_entry()
			{
				$this->form_validation->set_message('valid_nomor2', "skor dengan nomor $new_id sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}

}
// END skor Class

/* End of file skor.php */
/* Location: ./system/application/controllers/s.php */
