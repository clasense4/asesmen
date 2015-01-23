<?php

class asesor extends CI_Controller {
	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('asesor_model', '', TRUE);
	}
	
	/**
	 * Inisialisasi variabel untuk $title(untuk id element <body>)
	 */
	var $title = 'asesor';

	/**
	 * Helper Class
	 */
	function printr($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}

	/**
	 * Memeriksa user state, jika dalam keadaan login akan menampilkan halaman asesor,
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
	 * Tampilkan semua data asesor
	 */
	function get_all()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Data Asesor';
		$data['main_view'] = 'asesor/asesor';
		
		// Load data
		$query = $this->asesor_model->get_all();
		$asesor = $query->result();
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
			$this->table->set_heading('No', 'Id Asesor', 'Nama Asesor', 'Penidikan', 'Email', 'No. Telepon', 'Alamat', 'Actions');
			$i = 0;
			
			foreach ($asesor as $row)
			{
				$this->table->add_row(++$i, $row->id_asesor, $row->namaasesor, $row->pendidikan, $row ->emailasesor, $row->telpasesor, $row->alamatasesor,
										anchor('asesor/update/'.$row->id_asesor,'update',array('class' => 'update')).' '.
										anchor('asesor/delete/'.$row->id_asesor,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
			}
			$data['table'] = $this->table->generate();
		}
		else
		{
			$data['message'] = 'Tidak ditemukan satupun data asesor!';
		}		
		
		$data['link'] = array('link_add' => anchor('asesor/add/','tambah data', array('class' => 'add'))
								);
		
		// Load view
		$this->load->view('template_kegiatan', $data);
	}
		
	/**
	 * Hapus data asesor
	 */
	function delete($id_asesor)
	{
		$this->asesor_model->delete($id_asesor);
		$this->session->set_flashdata('message', '1 data asesor berhasil dihapus');
		
		redirect('asesor');
	}
	
	/**
	 * Pindah ke halaman tambah asesor
	 */
	function add()
	{		
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Asesor > Tambah Data';
		$data['main_view'] 		= 'asesor/asesor_form';
		$data['form_action']		= site_url('asesor/add_process');
		$data['link'] 			= array('link_back' => anchor('asesor','kembali', array('class' => 'back'))
										);
		
		$this->load->view('template', $data);
	}
	
	/**
	 * Proses tambah data asesor
	 */
	function add_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Asesor > Tambah Data';
		$data['main_view'] 		= 'asesor/asesor_form';
		$data['form_action']		= site_url('asesor/add_process');
		$data['link'] 			= array('link_back' => anchor('asesor','kembali', array('class' => 'back'))
										);
	
		// Set validation rules
		$this->form_validation->set_rules('id_asesor', 'Id asesor', 'required|numeric|max_length[2]|callback_valid_id');
		$this->form_validation->set_rules('namaasesor', 'namaasesor asesor', 'required|max_length[50]');
		$this->form_validation->set_rules('pendidikan', 'pendidikan', 'required|max_length[50]');
		$this->form_validation->set_rules('emailasesor', 'emailasesor', 'required|max_length[50]');
		$this->form_validation->set_rules('telpasesor', 'Telp. Asesor', 'required|max_length[50]');
		$this->form_validation->set_rules('alamatasesor', 'Alamat Asesor', 'required|max_length[50]');
		// Jika validasi sukses
		if ($this->form_validation->run() == TRUE)
		{
			// Persiapan data
			$asesor = array('id_asesor'	=> $this->input->post('id_asesor'),
							'namaasesor'		=> $this->input->post('namaasesor'),
							'pendidikan'		=> $this->input->post('pendidikan'),
							'emailasesor'		=> $this->input->post('emailasesor'),
							'telpasesor'		=> $this->input->post('telpasesor'),
							'alamatasesor'		=> $this->input->post('alamatasesor')
						);
			// Proses penyimpanan data di table asesor
			$this->asesor_model->add($asesor);
			
			$this->session->set_flashdata('message', 'Satu data asesor berhasil disimpan!');
			redirect('asesor/add');
		}
		// Jika validasi gagal
		else
		{		
			$this->load->view('template', $data);
		}		
	}
	
	/**
	 * Pindah ke halaman update asesor
	 */
	function update($id_asesor)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Asesor > Update';
		$data['main_view'] 		= 'asesor/asesor_form';
		$data['form_action']		= site_url('asesor/update_process');
		$data['link'] 			= array('link_back' => anchor('asesi','kembali', array('class' => 'back'))
										);
	
		// cari data dari database
		$asesor = $this->asesor_model->get_asesor_by_id($id_asesor);
				
		// buat session untuk menyimpan data primary key (id_asesor)
		$this->session->set_userdata('id_asesor', $asesor->id_asesor);
		
		// Data untuk mengisi field2 form
		$data['default']['id_asesor'] 	= $asesor->id_asesor;		
		$data['default']['namaasesor']		= $asesor->namaasesor;
		$data['default']['pendidikan']		= $asesor->pendidikan;		
		$data['default']['emailasesor']		= $asesor->emailasesor;
		$data['default']['telpasesor']		= $asesor->telpasesor;
		$data['default']['alamatasesor']	= $asesor->alamatasesor;
		$this->load->view('template', $data);
	}
	
	/**
	 * Proses update data asesor
	 */
	function update_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Asesor > Update';
		$data['main_view'] 		= 'asesor/asesor_form';
		$data['form_action']	= site_url('asesor/update_process');
		$data['link'] 			= array('link_back' => anchor('asesor','kembali', array('class' => 'back'))
										);
										
		// Set validation rules
		$this->form_validation->set_rules('id_asesor', 'Id asesor', 'required|numeric|max_length[2]|callback_valid_id2');
		$this->form_validation->set_rules('namaasesor', 'namaasesor asesor', 'required|max_length[50]');
		$this->form_validation->set_rules('pendidikan', 'pendidikan', 'required|max_length[50]');
		$this->form_validation->set_rules('emailasesor', 'emailasesor', 'required|max_length[50]');
		$this->form_validation->set_rules('telpasesor', 'Telp. Asesor', 'required|max_length[50]');
		$this->form_validation->set_rules('alamatasesor', 'alamatasesor', 'required|max_length[50]');
		
		if ($this->form_validation->run() == TRUE)
		{
			// save data
			$asesor = array('id_asesor'	=> $this->input->post('id_asesor'),
							'namaasesor'		=> $this->input->post('namaasesor'),
							'pendidikan'		=> $this->input->post('pendidikan'),
							'emailasesor'		=> $this->input->post('emailasesor'),
							'telpasesor'		=> $this->input->post('telpasesor'),
							'alamatasesor'		=> $this->input->post('alamatasesor')
						);
			$this->asesor_model->update($this->session->userdata('id_asesor'), $asesor);
			
			$this->session->set_flashdata('message', 'Satu data asesor berhasil diupdate!');
			redirect('asesor');
		}
		else
		{		
			$this->load->view('template', $data);
		}
	}
	
	/**
	 * Cek apakah $id_asesor valid, agar tidak ganda
	 */
	function valid_id($id_asesor)
	{
		if ($this->asesor_model->valid_id($id_asesor) == TRUE)
		{
			$this->form_validation->set_message('valid_id', "asesor dengan Kode $id_asesor sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}
	
	/**
	 * Cek apakah $id_asesor valid, agar tidak ganda. Hanya untuk proses update data asesor
	 */
	function valid_id2()
	{
		// cek apakah data emailasesor pada session sama dengan isi field
		// tidak mungkin seorang siswa diabsen 2 kali pada emailasesor yang sama
		$current_id 	= $this->session->userdata('id_asesor');
		$new_id			= $this->input->post('id_asesor');
				
		if ($new_id === $current_id)
		{
			return TRUE;
		}
		else
		{
			if($this->asesor_model->valid_id($new_id) === TRUE) // cek database untuk entry yang sama memakai valid_entry()
			{
				$this->form_validation->set_message('valid_id2', "asesor dengan kode $new_id sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}
}
// END asesor Class

/* End of file asesor.php */
/* Location: ./system/application/controllers/asesor.php */