<?php

class kegiatan extends CI_Controller {
	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('helper_model', '', TRUE);
		$this->load->model('model_kegiatan', '', TRUE);
		$this->load->model('model_skor', '', TRUE);
		$this->load->model('kegiatan_model', '', TRUE);
	}

	/**
	 * Inisialisasi variabel untuk $title(untuk id element <body>)
	 */
	var $title = 'kegiatan';

	/**
	 * Memeriksa user state, jika dalam keadaan login akan menampilkan halaman kegiatan,
	 * jika tidak akan meredirect ke halaman login
	 */
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
	 * Tampilkan semua data kegiatan
	 */
	function get_all()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Data Kegiatan';
		$data['main_view'] = 'kegiatan/kegiatan';

		// Load data
		$query = $this->kegiatan_model->get_all();
		$kegiatan = $query->result();
		$num_rows = $query->num_rows();

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
			// $this->table->set_heading('No', 'Id Kegiatan', 'Nama Kegiatan', 'Instansi', 'Tanggal', 'Catatan', 'Actions');
			$fields = array();
			array_push($fields, 'No');
			$table_fields = $this->db->list_fields('kegiatan');
			foreach ($table_fields as $key => $value) {
			array_push($fields,$value);
			}
			array_push($fields, 'actions');
			$this->table->set_heading($fields);
			$i = 0;

			foreach ($kegiatan as $row)
			{
				$this->table->add_row(++$i, $row->id_kegiatan,$row->nama,$row->instansi,$row->tanggal,$row->proyek_mulai,$row->proyek_selesai,$row->note,
										anchor('hasil/index/','proses', array('class' => 'proses')).' '.
										anchor('kegiatan/update/'.$row->id_kegiatan,'update',array('class' => 'update')).' '.
										anchor('kegiatan/delete/'.$row->id_kegiatan,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
			}
			$data['table'] = $this->table->generate();
		}
		else
		{
			$data['message'] = 'Tidak ditemukan satupun data kegiatan!';
		}

		$data['link'] = array('link_add' => anchor('kegiatan/add/','tambah data', array('class' => 'add'))
								);

		// Load view
		$this->load->view('template_kegiatan', $data);
	}

	/**
	 * Hapus data kegiatan
	 */
	function delete($id_kegiatan)
	{
		$this->model_kegiatan->delete('id_kegiatan',$id_kegiatan,'kegiatan');
		$this->session->set_flashdata('message', '1 data kegiatan berhasil dihapus');
		redirect('kegiatan');
	}

	/**
	 * Pindah ke halaman tambah kegiatan
	 */
	function add()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Kegiatan > Tambah Data';
		$data['main_view'] 		= 'kegiatan/kegiatan_form';
		$data['form_action']	= site_url('kegiatan/add_process');
		$data['link'] 			= array('link_back' => anchor('kegiatan','kembali', array('class' => 'back'))
										);
		// get group
		$data['group_skor'] = $this->model_skor->search(NULL,NULL,'group_skor');
		$this->load->view('template', $data);
	}

	/**
	 * Proses tambah data kegiatan
	 */
	function add_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Kegiatan > Tambah Data';
		$data['main_view'] 		= 'kegiatan/kegiatan_form';
		$data['form_action']	= site_url('kegiatan/add_process');
		$data['link'] 			= array('link_back' => anchor('kegiatan','kembali', array('class' => 'back'))
										);

		$kegiatan = $this->input->post();
		$skor = $kegiatan['skor'];
		unset($kegiatan['skor']);
		unset($kegiatan['submit']);
		unset($kegiatan['id_kegiatan']);
		$kegiatan['id_kegiatan'] = $this->model_kegiatan->save($kegiatan,'kegiatan',1);
		// $this->helper_model->printr($ids);
		// die;
		// $kegiatan['id_kegiatan'] = $this->db->insert_id();
		foreach ($skor as $key => $value) {
			// $this->helper_model->printr($value);
			$var = array(
					'id_kegiatan' => $kegiatan['id_kegiatan'],
					'id_skor' => (int)$key
					);
			// $this->helper_model->printr($key);
			$this->model_kegiatan->save($var,'assign_kegiatan_skor');
		}
		// die;

		$this->session->set_flashdata('message', 'Satu data kegiatan berhasil disimpan!');
		redirect('kegiatan');

		// // Set validation rules
		// $this->form_validation->set_rules('id_kegiatan', 'Id kegiatan', 'required|numeric|max_length[2]|callback_valid_id');
		// $this->form_validation->set_rules('nama', 'Nama Kegiatan', 'required|max_length[50]');
		// $this->form_validation->set_rules('instansi', 'Instansi', 'required|max_length[50]');
		// $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|max_length[50]');
		// $this->form_validation->set_rules('note', 'Catatan', 'required|max_length[50]');
		// // Jika validasi sukses
		// if ($this->form_validation->run() == TRUE)
		// {
		// 	// Persiapan data
		// 	$kegiatan = array('id_kegiatan'	=> $this->input->post('id_kegiatan'),
		// 					'nama'		=> $this->input->post('nama'),
		// 					'instansi'		=> $this->input->post('instansi'),
		// 					'tanggal'		=> $this->input->post('tanggal'),
		// 					'note'		=> $this->input->post('note')
		// 				);
		// 	// Proses penyimpanan data di table kegiatan
		// 	$this->kegiatan_model->add($kegiatan);

		// 	$this->session->set_flashdata('message', 'Satu data kegiatan berhasil disimpan!');
		// 	redirect('kegiatan/add');
		// }
		// // Jika validasi gagal
		// else
		// {
		// 	$this->load->view('template', $data);
		// }
	}

	/**
	 * Pindah ke halaman update kegiatan
	 */
	function update($id_kegiatan)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Kegiatan > Update';
		$data['main_view'] 		= 'kegiatan/kegiatan_form';
		$data['form_action']	= site_url('kegiatan/update_process');
		$data['link'] 			= array('link_back' => anchor('asesi','kembali', array('class' => 'back'))
										);

		// cari data dari database
		$kegiatan = $this->model_kegiatan->search('id_kegiatan',$id_kegiatan,'kegiatan');
		$kegiatan = $kegiatan[0];
		$this->session->set_userdata('kegiatan', $kegiatan->id_kegiatan);
		$data['default']['id_kegiatan'] = $kegiatan->id_kegiatan;
		$data['default']['nama'] = $kegiatan->nama;
		$data['default']['instansi'] = $kegiatan->instansi;
		$data['default']['tanggal'] = $kegiatan->tanggal;
		$data['default']['proyek_mulai'] = $kegiatan->proyek_mulai;
		$data['default']['proyek_selesai'] = $kegiatan->proyek_selesai;
		$data['default']['note'] = $kegiatan->note;
		$this->load->view('template', $data);
	}

	/**
	 * Proses update data kegiatan
	 */
	function update_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Kegiatan > Update';
		$data['main_view'] 		= 'kegiatan/kegiatan_form';
		$data['form_action']	= site_url('kegiatan/update_process');
		$data['link'] 			= array('link_back' => anchor('kegiatan','kembali', array('class' => 'back'))
										);

		$kegiatan = $this->input->post();
		unset($kegiatan['submit']);
		$this->helper_model->printr($kegiatan);
		$this->model_kegiatan->save($kegiatan,'kegiatan');
		$this->session->set_flashdata('message', 'Satu data kegiatan berhasil diupdate!');
		redirect('kegiatan');
		// // Set validation rules
		// $this->form_validation->set_rules('id_kegiatan', 'Id kegiatan', 'required|numeric|max_length[2]|callback_valid_id2');
		// $this->form_validation->set_rules('nama', 'Nama Kegiatan', 'required|max_length[50]');
		// $this->form_validation->set_rules('instansi', 'Instansi', 'required|max_length[50]');
		// $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|max_length[50]');
		// $this->form_validation->set_rules('note', 'Catatan', 'required|max_length[50]');

		// if ($this->form_validation->run() == TRUE)
		// {
		// 	// save data
		// 	$kegiatan = array('id_kegiatan'	=> $this->input->post('id_kegiatan'),
		// 					'nama'		=> $this->input->post('nama'),
		// 					'instansi'		=> $this->input->post('instansi'),
		// 					'tanggal'		=> $this->input->post('tanggal'),
		// 					'note'		=> $this->input->post('note')
		// 				);
		// 	$this->kegiatan_model->update($this->session->userdata('id_kegiatan'), $kegiatan);

		// 	$this->session->set_flashdata('message', 'Satu data kegiatan berhasil diupdate!');
		// 	redirect('kegiatan');
		// }
		// else
		// {
		// 	$this->load->view('template', $data);
		// }
	}

	/**
	 * Cek apakah $id_kegiatan valid, agar tidak ganda
	 */
	function valid_id($id_kegiatan)
	{
		if ($this->kegiatan_model->valid_id($id_kegiatan) == TRUE)
		{
			$this->form_validation->set_message('valid_id', "kegiatan dengan Kode $id_kegiatan sudah terdaftar");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * Cek apakah $id_kegiatan valid, agar tidak ganda. Hanya untuk proses update data kegiatan
	 */
	function valid_id2()
	{
		// cek apakah data tanggal pada session sama dengan isi field
		// tidak mungkin seorang siswa diabsen 2 kali pada tanggal yang sama
		$current_id 	= $this->session->userdata('id_kegiatan');
		$new_id			= $this->input->post('id_kegiatan');

		if ($new_id === $current_id)
		{
			return TRUE;
		}
		else
		{
			if($this->kegiatan_model->valid_id($new_id) === TRUE) // cek database untuk entry yang sama memakai valid_entry()
			{
				$this->form_validation->set_message('valid_id2', "kegiatan dengan kode $new_id sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}
}
// END kegiatan Class

/* End of file kegiatan.php */
/* Location: ./system/application/controllers/kegiatan.php */