<?php

class asesi extends CI_Controller {
	/**
	 * Constructor, kegiatan_model
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('asesi_model', '', TRUE);
		$this->load->model('kegiatan_model', '', TRUE);
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
	 * Mendapatkan semua data asesi di database dan menampilkannya di tabel
	 */
	function get_all($offset = 0)
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Data Asesi';
		$data['main_view'] = 'asesi/asesi';
		
		// Offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// Load data
		$asesi = $this->asesi_model->get_all($this->limit, $offset);
		$num_rows = $this->asesi_model->count_all();
		
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
			$this->table->set_heading('No', 'No. Peserta', 'Nama', 'Jabatan', 'Unit', 'Instansi', 'Actions');
			$i = 0 + $offset;
			
			foreach ($asesi as $row)
			{
				$this->table->add_row(++$i, $row->nomor, $row->nama, $row->jabatan, $row->unit, $row->nama,
										anchor('asesi/update/'.$row->nomor,'update',array('class' => 'update')).' '.
										anchor('asesi/delete/'.$row->nomor,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
			}
			$data['table'] = $this->table->generate();
		}
		else
		{
			$data['message'] = 'Tidak ditemukan satupun data asesi!';
		}		
		
		$data['link'] = array('link_add' => anchor('asesi/add/','tambah data', array('class' => 'add'))
								);
		
		// Load view
		$this->load->view('template', $data);
	}
	
	/**
	 * Menghapus data asesi dengan nomor tertentu
	 */
	function delete($nomor)
	{
		$this->asesi_model->delete($nomor);
		$this->session->set_flashdata('message', '1 data asesi berhasil dihapus');
		
		redirect('asesi');
	}
	
	/**
	 * Menampilkan form tambah asesi
	 */
	function add()
	{		
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Asesi > Tambah Data';
		$data['main_view'] 		= 'asesi/asesi_form';
		$data['form_action']	= site_url('asesi/add_process');
		$data['link'] 			= array('link_back' => anchor('asesi','kembali', array('class' => 'back'))
										);
										
		// data kegiatan untuk dropdown menu
		$kegiatan = $this->kegiatan_model->get_kegiatan()->result();
		foreach($kegiatan as $row)
		{
			$data['options_kegiatan'][$row->id_kegiatan] = $row->nama;
		}
		
		$this->load->view('template', $data);
	}
	/**
	 * Proses tambah data asesi
	 */
	function add_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Asesi > Tambah Data';
		$data['main_view'] 		= 'asesi/asesi_form';
		$data['form_action']	= site_url('asesi/add_process');
		$data['link'] 			= array('link_back' => anchor('asesi/','kembali', array('class' => 'back'))
										);
										
		// data kegiatan untuk dropdown menu
		$kegiatan = $this->kegiatan_model->get_kegiatan()->result();
		foreach($kegiatan as $row)
		{
			$data['options_kegiatan'][$row->id_kegiatan] = $row->nama;
		}
		
		// Set validation rules
		$this->form_validation->set_rules('nomor', 'Nomor Peserta', 'required|exact_length[4]|numeric|callback_valid_nomor');
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|max_length[50]');
		$this->form_validation->set_rules('unit', 'Unit Kerja', 'required|max_length[50]');
		$this->form_validation->set_rules('id_kegiatan', 'Kegiatan', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			// save data
			$asesi = array('nomor' 		=> $this->input->post('nomor'),
							'nama'		=> $this->input->post('nama'),
							'jabatan'		=> $this->input->post('jabatan'),
							'unit'		=> $this->input->post('unit'),
							'id_kegiatan'	=> $this->input->post('id_kegiatan')
						);
			$this->asesi_model->add($asesi);
			
			$this->session->set_flashdata('message', 'Satu data asesi berhasil disimpan!');
			redirect('asesi/add');
		}
		else
		{	
			$data['default']['id_kegiatan'] = $this->input->post('id_kegiatan');
			$this->load->view('template', $data);
		}		
	}
	
	/**
	 * Menampilkan form update data asesi
	 */
	function update($nomor)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Asesi > Update';
		$data['main_view'] 		= 'asesi/asesi_form';
		$data['form_action']	= site_url('asesi/update_process');
		$data['link'] 			= array('link_back' => anchor('asesi','kembali', array('class' => 'back'))
										);
										
		// data kegiatan untuk dropdown menu
		$kegiatan = $this->kegiatan_model->get_kegiatan()->result();
		foreach($kegiatan as $row)
		{
			$data['options_kegiatan'][$row->id_kegiatan] = $row->kegiatan;
		}
		
		// cari data dari database
		$asesi = $this->asesi_model->get_asesi_by_id($asesi);
		
		// buat session untuk menyimpan data primary key (nomor)
		$this->session->set_userdata('nomor', $asesi->nomor);
		
		// Data untuk mengisi field2 form
		$data['default']['nomor'] 		= $asesi->nomor;
		$data['default']['nama'] 		= $asesi->nama;		
		$data['default']['jabatan'] 		= $asesi->jabatan;
		$data['default']['unit'] 		= $asesi->unit;
		$data['default']['id_kegiatan']	= $asesi->id_kegiatan;
				
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
		$data['form_action']	= site_url('asesi/update_process');
		$data['link'] 			= array('link_back' => anchor('asesi','kembali', array('class' => 'back'))
										);
										
		// data kegiatan untuk dropdown menu
		$kegiatan = $this->kegiatan_model->get_kegiatan()->result();
		foreach($kegiatan as $row)
		{
			$data['options_kegiatan'][$row->id_kegiatan] = $row->kegiatan;
		}
			
		// Set validation rules
		$this->form_validation->set_rules('nomor', 'Nomor Peserta', 'required|exact_length[4]|numeric|callback_valid_nomor2');
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|max_length[50]');
		$this->form_validation->set_rules('unit', 'Unit Kerja', 'required|max_length[50]');
		$this->form_validation->set_rules('id_kegiatan', 'Kegiatan', 'required');
		
		// jika proses validasi sukses, maka lanjut mengupdate data
		if ($this->form_validation->run() == TRUE)
		{
			// save data
			$absen = array('nomor' 		=> $this->input->post('nomor'),
							'nama'		=> $this->input->post('nama'),
							'jabatan'	=> $this->input->post('jabatan'),
							'unit'	=> $this->input->post('unit'),
							'id_kegiatan'	=> $this->input->post('id_kegiatan')
						);
			$this->asesi_model->update($this->session->userdata('nomor'), $asesi);
						
			// set pesan
			$this->session->set_flashdata('message', 'Satu data asesi berhasil diupdate!');
			
			redirect('asesi');
		}
		else
		{
			$data['default']['id_kegiatan'] = $this->input->post('id_kegiatan');
			$this->load->view('template', $data);
		}
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

}
// END asesi Class

/* End of file asesi.php */
/* Location: ./system/application/controllers/asesi.php */