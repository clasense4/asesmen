<?php

class user extends CI_Controller {
	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', '', TRUE);
	}
	
	/**
	 * Inisialisasi variabel untuk $title(untuk id element <body>)
	 */
	var $title = 'user';
	
	/**
	 * Memeriksa user state, jika dalam keadaan login akan menampilkan halaman user,
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
	 * Tampilkan semua data user
	 */
	function get_all()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Data User';
		$data['main_view'] = 'user/user';
		
		// Load data
		$query = $this->user_model->get_all();
		$user = $query->result();
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
			$this->table->set_heading('No', 'Id user', 'username user', 'password', 'Actions');
			$i = 0;
			
			foreach ($user as $row)
			{
				$this->table->add_row(++$i, $row->id_user, $row->username, $row->password,
										anchor('user/update/'.$row->id_user,'update',array('class' => 'update')).' '.
										anchor('user/delete/'.$row->id_user,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
			}
			$data['table'] = $this->table->generate();
		}
		else
		{
			$data['message'] = 'Tidak ditemukan satupun data user!';
		}		
		
		$data['link'] = array('link_add' => anchor('user/add/','tambah data', array('class' => 'add'))
								);
		
		// Load view
		$this->load->view('template', $data);
	}
		
	/**
	 * Hapus data user
	 */
	function delete($id_user)
	{
		$this->user_model->delete($id_user);
		$this->session->set_flashdata('message', '1 data user berhasil dihapus');
		
		redirect('user');
	}
	
	/**
	 * Pindah ke halaman tambah user
	 */
	function add()
	{		
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data User > Tambah Data';
		$data['main_view'] 		= 'user/user_form';
		$data['form_action']	= site_url('user/add_process');
		$data['link'] 			= array('link_back' => anchor('user','kembali', array('class' => 'back'))
										);
		
		$this->load->view('template', $data);
	}
	
	/**
	 * Proses tambah data user
	 */
	function add_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data User > Tambah Data';
		$data['main_view'] 		= 'user/user_form';
		$data['form_action']	= site_url('user/add_process');
		$data['link'] 			= array('link_back' => anchor('user','kembali', array('class' => 'back'))
										);
	
		// Set validation rules
		$this->form_validation->set_rules('id_user', 'Id user', 'required|numeric|max_length[2]|callback_valid_id');
		$this->form_validation->set_rules('username', 'username user', 'required|max_length[50]');
		$this->form_validation->set_rules('password', 'password', 'required|max_length[50]');
		// Jika validasi sukses
		if ($this->form_validation->run() == TRUE)
		{
			// Persiapan data
			$user = array('id_user'	=> $this->input->post('id_user'),
							'username'		=> $this->input->post('username'),
							'password'		=> $this->input->post('password'),
						);
			// Proses penyimpanan data di table user
			$this->user_model->add($user);
			
			$this->session->set_flashdata('message', 'Satu data user berhasil disimpan!');
			redirect('user/add');
		}
		// Jika validasi gagal
		else
		{		
			$this->load->view('template', $data);
		}		
	}
	
	/**
	 * Pindah ke halaman update user
	 */
	function update($id_user)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data User > Update';
		$data['main_view'] 		= 'user/user_form';
		$data['form_action']	= site_url('user/update_process');
		$data['link'] 			= array('link_back' => anchor('asesi','kembali', array('class' => 'back'))
										);
	
		// cari data dari database
		$user = $this->user_model->get_user_by_id($id_user);
				
		// buat session untuk menyimpan data primary key (id_user)
		$this->session->set_userdata('id_user', $user->id_user);
		
		// Data untuk mengisi field2 form
		$data['default']['id_user'] 	= $user->id_user;		
		$data['default']['username']		= $user->username;
		$data['default']['password']		= $user->password;		

		$this->load->view('template', $data);
	}
	
	/**
	 * Proses update data user
	 */
	function update_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data User > Update';
		$data['main_view'] 		= 'user/user_form';
		$data['form_action']	= site_url('user/update_process');
		$data['link'] 			= array('link_back' => anchor('user','kembali', array('class' => 'back'))
										);
										
		// Set validation rules
		$this->form_validation->set_rules('id_user', 'Id user', 'required|numeric|max_length[2]|callback_valid_id2');
		$this->form_validation->set_rules('username', 'username user', 'required|max_length[50]');
		$this->form_validation->set_rules('password', 'password', 'required|max_length[50]');
		
		if ($this->form_validation->run() == TRUE)
		{
			// save data
			$user = array('id_user'	=> $this->input->post('id_user'),
							'username'		=> $this->input->post('username'),
							'password'		=> $this->input->post('password'),

						);
			$this->user_model->update($this->session->userdata('id_user'), $user);
			
			$this->session->set_flashdata('message', 'Satu data user berhasil diupdate!');
			redirect('user');
		}
		else
		{		
			$this->load->view('template_kegiatan', $data);
		}
	}
	
	/**
	 * Cek apakah $id_user valid, agar tidak ganda
	 */
	function valid_id($id_user)
	{
		if ($this->user_model->valid_id($id_user) == TRUE)
		{
			$this->form_validation->set_message('valid_id', "user dengan Kode $id_user sudah terdaftar");
			return FALSE;
		}
		else
		{			
			return TRUE;
		}
	}
	
	/**
	 * Cek apakah $id_user valid, agar tidak ganda. Hanya untuk proses update data user
	 */
	function valid_id2()
	{
		// cek apakah data tanggal pada session sama dengan isi field
		// tidak mungkin seorang siswa diabsen 2 kali pada tanggal yang sama
		$current_id 	= $this->session->userdata('id_user');
		$new_id			= $this->input->post('id_user');
				
		if ($new_id === $current_id)
		{
			return TRUE;
		}
		else
		{
			if($this->user_model->valid_id($new_id) === TRUE) // cek database untuk entry yang sama memakai valid_entry()
			{
				$this->form_validation->set_message('valid_id2', "user dengan kode $new_id sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}
}
// END user Class

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */