<?php

class asesi extends CI_Controller {
	/**
	 * Constructor, kegiatan_model
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_asesi', '', TRUE);
		$this->load->model('helper_model', '', TRUE);
		$this->load->model('asesi_model', '', TRUE);
		$this->load->model('kegiatan_model', '', TRUE);
		$this->load->library('fpdf');
		$this->load->helper('form');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
	}

	/**
	 * Inomorialisasi variabel untuk $title(untuk id element <body>), dan
	 * $limit untuk membatasi penampilan data di tabel
	 */
	var $limit = 10;
	var $title = 'asesi';

	/**
	 * Memeriksa user state, jika dalam keadaan login akan menjalankan fungsi get_all()
	 * jika tidak akan meredirect ke halaman login
	 */
	function index($id_kegiatan)
	{
		if ($this->session->userdata('login') == TRUE)
		{
			$offset = 0;
			$this->get_all($offset, $id_kegiatan);
		}
		else
		{
			redirect('login');
		}
	}

	/**
	 * Mendapatkan semua data asesi di database dan menampilkannya di tabel
	 */
	function get_all($offset, $id_kegiatan)
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Data Asesi';
		$data['main_view'] = 'asesi/asesi';
		$data['id_kegiatan'] = $id_kegiatan;

		// Offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);

		// Load data
		// $asesi = $this->asesi_model->get_all($this->limit, $offset);
		$asesi = $this->model_asesi->search(NULL,NULL,'asesi');
		// $num_rows = $this->asesi_model->count_all();
		$num_rows = $this->model_asesi->count(NULL,NULL,'asesi');
		// $this->helper_model->printr($num_rows);
		// die;

		if ($num_rows > 0)
		{
			// Generate pagination
			$config['base_url'] = site_url('asesi/get_all');
			$config['total_rows'] = $num_rows;
			$config['per_page'] = $this->limit;
			$config['uri_segment'] = $uri_segment;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();

			// Table
			/*Set table template for alternating row 'zebra'*/
			$tmpl = array( 'table_open'    => '<table border="0" cellpadding="0" cellspacing="0">',
						  'row_alt_start'  => '<tr class="zebra">',
							'row_alt_end'    => '</tr>'
						  );
			$this->table->set_template($tmpl);

			/*Set table heading */
			$this->table->set_empty("&nbsp;");
			// $this->table->set_heading('No', 'No. Peserta', 'Nama', 'Jabatan', 'Unit', 'Instansi', 'Actions');
			$fields = array();
			array_push($fields, 'No','Nomor Peserta', 'Nama Peserta' , 'NIP', 'Pendidikan' , 'Jabatan' , 'Unit', 
								 'Action');
			$this->table->set_heading($fields);
			$data_asesi = $this->asesi_model->getDataByKegiatan($id_kegiatan);
			
			$i = 0;

			foreach ($data_asesi as $row)
			{
				$this->table->add_row(++$i, $row->no_asesi,$row->nama,$row->nip,$row->pendidikan,$row->jabatan,$row->unit,
										anchor('asesi/update/'.$row->id_asesi,'update',array('class' => 'update')).' '.
										anchor('asesi/delete/'.$row->id_asesi,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
			}
			$data['table'] = $this->table->generate();
			// die;
		}
		else
		{
			$data['message'] = 'Tidak ditemukan satupun data asesi!';
		}

		$data['link'] = array('link_add' => anchor('asesi/add/'.$id_kegiatan,'tambah data', array('class' => 'add'))
								);

		// Load view
		$this->load->view('template', $data);
	}

	/**
	 * Menghapus data asesi dengan nomor tertentu
	 */
	function delete($id_asesi)
	{
		$this->model_asesi->delete('id_asesi',$id_asesi,'asesi');
		// $this->asesi_model->delete($nomor);
		$this->session->set_flashdata('message', '1 data asesi berhasil dihapus');

		redirect('asesi');
	}

	/**
	 * Menampilkan form tambah asesi
	 */
	function add($id_kegiatan)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Asesi > Tambah Data';
		$data['main_view'] 		= 'asesi/asesi_form';
		$data['form_action']	= site_url('asesi/add_process/'.$id_kegiatan);
		$data['link'] 			= array('link_back' => anchor('asesi','kembali', array('class' => 'back'))
										);								
		$data['id_kegiatan'] = $id_kegiatan;

		$this->load->view('template', $data);
	}
	/**
	 * Proses tambah data asesi
	 */
	function add_process($id_kegiatan)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Asesi > Tambah Data';
		$data['main_view'] 		= 'asesi/asesi_form';
		$data['form_action']	= site_url('asesi/add_process');
		$data['link'] 			= array('link_back' => anchor('asesi/','kembali', array('class' => 'back'))
										);
		$data['id_kegiatan'] 	= $id_kegiatan;
		$asesi = $this->input->post();
		unset($asesi['submit']);
		unset($asesi['id_asesi']);
		$this->helper_model->printr($asesi);
		$this->asesi_model->add($asesi);
		$this->session->set_flashdata('message', 'Satu data asesi berhasil disimpan!');
		redirect('asesi/index/'.$id_kegiatan);
	}

	/**
	 * Menampilkan form update data asesi
	 */
	function update($id_asesi)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Asesi > Update';
		$data['main_view'] 		= 'asesi/asesi_form';
		$data['form_action']	= site_url('asesi/update_process');
		$data['link'] 			= array('link_back' => anchor('asesi','kembali', array('class' => 'back'))
										);

		$asesi = $this->model_asesi->search('id_asesi',$id_asesi,'asesi');
		$asesi = $asesi[0];

		// auto generate
		$this->session->set_userdata('asesi', $asesi->id_asesi); 

		$data['default']['id_asesi'] = $asesi->id_asesi;
		$data['default']['nama'] = $asesi->nama;
		$data['default']['nip'] = $asesi->nip;
		$data['default']['pendidikan'] = $asesi->pendidikan;
		$data['default']['jabatan'] = $asesi->jabatan;
		$data['default']['unit'] = $asesi->unit;
		$data['default']['foto'] = $asesi->foto;

		$this->load->view('template', $data);
	}

	/**
	 * Proses update data asesi
	 */
	function update_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Asesi > Update';
		$data['main_view'] 		= 'asesi/asesi_form';
		$data['form_action']		= site_url('asesi/update_process');
		$data['link'] 			= array('link_back' => anchor('asesi','kembali', array('class' => 'back'))
										);
		$asesi = $this->input->post();
		unset($asesi['submit']);
		// unset($asesi['id_asesi']);
		$this->helper_model->printr($asesi);
		$this->model_asesi->save($asesi,'asesi');
		$this->session->set_flashdata('message', 'Satu data asesi berhasil diupdate!');
		redirect('asesi');

	}

	/**
	 * Validasi untuk nomor, agar tidak ada asesi dengan Nomor Peserta Sama sama
	 */
	function valid_nomor($nomor)
	{
		if ($this->asesi_model->valid_nomor($nomor) == TRUE)
		{
			$this->form_validation->set_message('valid_nomor', "asesi dengan Nomor Peserta $nomor sudah terdaftar");
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
		$current_nomor 	= $this->session->userdata('nomor');
		$new_nomor		= $this->input->post('nomor');

		if ($new_nomor === $current_nomor)
		{
			return TRUE;
		}
		else
		{
			if($this->asesi_model->valid_nomor($new_nomor) === TRUE) // cek database untuk entry yang sama memakai valid_entry()
			{
				$this->form_validation->set_message('valid_nomor2', "asesi dengan nomor $new_nomor sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}
	
	function asesipdf()
	{
		$data['asesi_list'] = $this->asesi_model->get_asesi()->result();
		$this->load->view('asesi/asesi_list_pdf', $data);
	}
	
	function asesixls(){
		$data['asesi_list'] = $this->asesi_model->get_asesi()->result();
		$this->load->view('asesi/asesi_list_excel', $data);
	}

}
// END asesi Class

/* End of file asesi.php */
/* Location: ./system/application/controllers/asesi.php */