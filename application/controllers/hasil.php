<?php

class hasil extends CI_Controller {
	/**
	 * Constructor, kegiatan_model
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('helper_model', '', TRUE);
		$this->load->model('model_hasil', '', TRUE);
		$this->load->model('hasil_model', '', TRUE);
		$this->load->model('asesi_model', '', TRUE);
		$this->load->model('asesor_model', '', TRUE);
		$this->load->model('kegiatan_model', '', TRUE);
	}

	/**
	 * Inomorialisasi variabel untuk $title(untuk id element <body>), dan
	 * $limit untuk membatasi penampilan data di tabel
	 */
	var $limit = 10;
	var $title = 'hasil';

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
	 * Mendapatkan semua data hasil di database dan menampilkannya di tabel
	 */
	function get_all($offset = 0)
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Data Hasil Asesmen';
		$data['main_view'] = 'hasil/hasil';
		$kegiatanSession = $this->session->userdata('kegiatan_aktif');

		// Offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);

		// Load data
		// $hasil = $this->hasil_model->get_all($this->limit, $offset);
		// $num_rows = $this->hasil_model->count_all();
		$hasil = $this->model_hasil->search(NULL,NULL,'hasil',$this->limit, $offset);
		$num_rows = $this->model_hasil->count(NULL,NULL,'hasil');

		if ($num_rows > 0)
		{
			// Generate pagination
			$config['base_url'] = site_url('hasil/get_all');
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
			$fields = array();
			array_push($fields, 'No');
			$table_fields = $this->db->list_fields('hasil');
			foreach ($table_fields as $key => $value) {
			array_push($fields,$value);
			}
			array_push($fields, 'actions');
			$this->table->set_heading($fields);
			// $this->table->set_heading('No', 'Id Hasil','Nomor Peserta', 'Potensi', 'Kompetensi Inti', 'Teknis', 'Total', 'Rekomendasi', 'Asesor', 'Action');
			$i = 0 + $offset;

			foreach ($hasil as $row)
			{
				$this->table->add_row(++$i, $row->id_hasil,$row->nomor,$row->id_kegiatan,$row->id_lead_asesor,
										// anchor('hasil/view/'.$row->id_hasil,'view',array('class' => 'view')).' '.
										anchor('hasil/update/'.$row->id_hasil,'update',array('class' => 'update')).' '.
										anchor('hasil/delete/'.$row->id_hasil,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
			}
			$data['table'] = $this->table->generate();
		}
		else
		{
			$data['message'] = 'Tidak ditemukan satupun data hasil!';
		}

		$data['link'] = array('link_add' => anchor('hasil/add/','tambah data', array('class' => 'add'))
								);

		// Load view
		$this->load->view('template', $data);
	}

	/**
	 * Menghapus data hasil dengan nomor tertentu
	 */
	function delete($nomor)
	{
		$this->hasil_model->delete($nomor);
		$this->session->set_flashdata('message', '1 data hasil berhasil dihapus');

		redirect('hasil');
	}

	/**
	 * Menampilkan form tambah hasil
	 */
	function add()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Hasil Asesmen > Tambah Data';
		$data['main_view'] 		= 'hasil/hasil_form';
		$data['form_action']	= site_url('hasil/add_process');
		$data['link'] 			= array('link_back' => anchor('hasil','kembali', array('class' => 'back'))
										);

		// data kegiatan untuk dropdown menu
		$kegiatan = $this->kegiatan_model->get_kegiatan()->result();
		$data['options_kegiatan'][0] = 'Pilih';
		foreach($kegiatan as $row)
		{
			$data['options_kegiatan'][$row->id_kegiatan] = $row->nama;
		}

		$asesi = $this->asesi_model->get_asesi()->result();
		$data['options_asesi'][0] = 'Pilih';
		foreach($asesi as $row)
		{
			$data['options_asesi'][$row->id_asesi] = $row->nama;
		}

		$asesor = $this->asesor_model->get_asesor()->result();

		// array_push($data['options_asesor'][0], 'Pilih');
		$data['options_asesor'][0] = 'Pilih';
		foreach($asesor as $row)
		{
			$data['options_asesor'][$row->id_asesor] = $row->nama;
		}
		$data['group_skor'] = $this->model_hasil->search(NULL,NULL,'group_skor');
		$this->load->view('template', $data);
	}
	/**
	 * Proses tambah data hasil
	 */
	function add_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Hasil Asesmen > Tambah Data';
		$data['main_view'] 		= 'hasil/hasil_form';
		$data['form_action']	= site_url('hasil/add_process');
		$data['link'] 			= array('link_back' => anchor('hasil/','kembali', array('class' => 'back'))
										);
		/**
		 * Input ke 2 tabel,
		 * assign_hasil & assign_skor
		 */
		$this->db->trans_start();
		$assign_hasil = array(
			'id_asesi' => $this->input->post('asesi'),
			'id_asesor' => $this->input->post('asesor'),
			'id_kegiatan' => $this->input->post('kegiatan'),
		);
		// $this->helper_model->printr($assign_hasil);
		// $this->model_hasil->save($assign_hasil,'assign_hasil');
		$this->model_hasil->insert_ignore($assign_hasil,'assign_hasil');
		// die;
		$skor = $this->input->post('skor');
		// $this->helper_model->printr($this->input->post());die;
		foreach ($skor as $key => $value) {
			$data = array(
				'id_kegiatan' => $this->input->post('kegiatan'),
				'id_asesi' => $this->input->post('asesi'),
				'id_skor' => $key,
				'nilai' => $value,
			);
			// $this->helper_model->printr($data);
			try {
				// $this->model_hasil->save($data,'assign_skor');
				$this->model_hasil->insert_ignore($data,'assign_skor');
			} catch (Exception $e) {
				echo "Duplicate";
			}

		}
		$this->db->trans_complete();
		// die;

		$this->session->set_flashdata('message', 'Satu data hasil berhasil disimpan!');
		redirect('hasil');

		die;
		// data kegiatan untuk dropdown menu
		$asesi = $this->asesi_model->get_asesi()->result();
		foreach($asesi as $row)
		{
			$data['options_asesi'][$row->nomor] = $row->nama;
		}

		$asesor = $this->asesor_model->get_asesor()->result();
		foreach($asesor as $row)
		{
			$data['options_asesor'][$row->id_asesor] = $row->namaasesor;
		}

		// Set validation rules
		// $this->form_validation->set_rules('id_hasil', 'id_hasil', 'required');
		$this->form_validation->set_rules('nomor', 'nomor', 'required');
		$this->form_validation->set_rules('p1', 'p1', 'required');
		$this->form_validation->set_rules('p2', 'p2', 'required');
		$this->form_validation->set_rules('p3', 'p3', 'required');
		$this->form_validation->set_rules('p4', 'p4', 'required');
		$this->form_validation->set_rules('p5', 'p5', 'required');
		$this->form_validation->set_rules('p6', 'p6', 'required');
		$this->form_validation->set_rules('p7', 'p7', 'required');
		$this->form_validation->set_rules('p8', 'p8', 'required');
		$this->form_validation->set_rules('i1', 'i1', 'required');
		$this->form_validation->set_rules('i2', 'i2', 'required');
		$this->form_validation->set_rules('i3', 'i3', 'required');
		$this->form_validation->set_rules('i4', 'i4', 'required');
		$this->form_validation->set_rules('i5', 'i5', 'required');
		$this->form_validation->set_rules('t', 't', 'required');
		$this->form_validation->set_rules('id_asesor', 'id_asesor', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$p1 = $this->input->post('p1');
			$p2 = $this->input->post('p2');
			$p3 = $this->input->post('p3');
			$p4 = $this->input->post('p4');
			$p5 = $this->input->post('p5');
			$p6 = $this->input->post('p6');
			$p7 = $this->input->post('p7');
			$p8 = $this->input->post('p8');
			$potensi= ($p1+$p2+$p3+$p4+$p5+$p6+$p7+$p8)*20/100;

			$i1 = $this->input->post('i1');
			$i2 = $this->input->post('i2');
			$i3 = $this->input->post('i3');
			$i4 = $this->input->post('i4');
			$i5 = $this->input->post('i5');
			$inti	= (($i1+$i2+$i3+$i4+$i5)*40/100);

			$t = $this->input->post('t');
			$teknis	= ($t)*40/100;

			$total = $potensi+$inti+$teknis;

			if ($total >= 70){
				$rekomendasi = "Telah Memenuhi Persayaratan";
			} elseif ($total >= 50){
				$rekomendasi = "Belum Memenuhi Persayaratan";
			} else
			{ $rekomendasi = "Belum Memenuhi Persayaratan"; }

			// save data
			$hasil = array('id_hasil' 			=> $this->input->post('id_hasil'),
							'nomor'		=> $this->input->post('nomor'),
							'p1'		=> $this->input->post('p1'),
							'p2'		=> $this->input->post('p2'),
							'p3'		=> $this->input->post('p3'),
							'p4'		=> $this->input->post('p4'),
							'p5'		=> $this->input->post('p5'),
							'p6'		=> $this->input->post('p6'),
							'p7'		=> $this->input->post('p7'),
							'p8'		=> $this->input->post('p8'),
							'potensi'	=> $potensi,
							'i1'		=> $this->input->post('i1'),
							'i2'		=> $this->input->post('i2'),
							'i3'		=> $this->input->post('i3'),
							'i4'		=> $this->input->post('i4'),
							'i5'		=> $this->input->post('i5'),
							'inti'		=> $inti,
							't'		=> $this->input->post('t'),
							'teknis'	=> $teknis,
							'total'		=> $total,
							'rekomendasi'	=> $rekomendasi,
							'id_asesor'	=> $this->input->post('id_asesor')
							);
			$this->hasil_model->add($hasil);

			$this->session->set_flashdata('message', 'Satu data hasil berhasil disimpan!');
			redirect('hasil');
		}
		else
		{
			$data['default']['nomor'] = $this->input->post('nomor');
			$this->load->view('template', $data);
		}
	}

	/**
	 * Menampilkan form update data hasil
	 */
	function update($id_hasil)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Hasil Asesmen > Detail';
		$data['main_view'] 		= 'hasil/hasil_form';
		$data['form_action']	= site_url('hasil/update_process');
		$data['link'] 			= array('link_back' => anchor('hasil','kembali', array('class' => 'back'))
										);

		// data kegiatan untuk dropdown menu
		$asesi = $this->asesi_model->get_asesi()->result();
		foreach($asesi as $row)
		{
			$data['options_asesi'][$row->nomor] = $row->nama;
		}

		$asesor = $this->asesor_model->get_asesor()->result();
		foreach($asesor as $row)
		{
			$data['options_asesor'][$row->id_asesor] = $row->namaasesor;
		}

		// cari data dari database
		$hasil = $this->hasil_model->get_hasil_by_id($id_hasil);

		// buat session untuk menyimpan data primary key (nomor)
		$this->session->set_userdata('nomor', $hasil->nomor);

		// Data untuk mengisi field2 form
		$data['default']['id_hasil'] 	= $hasil->id_hasil;
		$data['default']['nomor'] 	= $hasil->nomor;
		$data['default']['p1'] 		= $hasil->p1;
		$data['default']['p2'] 		= $hasil->p2;
		$data['default']['p3']		= $hasil->p3;
		$data['default']['p4']		= $hasil->p4;
		$data['default']['p5']		= $hasil->p5;
		$data['default']['p6']		= $hasil->p6;
		$data['default']['p7']		= $hasil->p7;
		$data['default']['p8']		= $hasil->p8;
		$data['default']['potensi']	= $hasil->potensi;
		$data['default']['i1'] 		= $hasil->i1;
		$data['default']['i2'] 		= $hasil->i2;
		$data['default']['i3']		= $hasil->i3;
		$data['default']['i4']		= $hasil->i4;
		$data['default']['i5']		= $hasil->i5;
		$data['default']['inti']	= $hasil->inti;
		$data['default']['t']		= $hasil->t;
		$data['default']['teknis']	= $hasil->teknis;
		$data['default']['total']	= $hasil->total;
		$data['default']['rekomendasi']	= $hasil->rekomendasi;
		$data['default']['id_asesor']	= $hasil->id_asesor;
		$this->load->view('template', $data);
	}

	/**
	 * Proses update data hasil
	 */
	function update_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Hasil Asesmen > Update';
		$data['main_view'] 		= 'hasil/hasil_form';
		$data['form_action']	= site_url('hasil/update_process');
		$data['link'] 			= array('link_back' => anchor('hasil','kembali', array('class' => 'back'))
										);
		// data kegiatan untuk dropdown menu
		$kegiatan = $this->kegiatan_model->get_kegiatan()->result();
		foreach($kegiatan as $row)
		{
			$data['options_kegiatan'][$row->id_kegiatan] = $row->id_kegiatan;
		}

		// $this->printr($this->input->post());
		// die;
		// Set validation rules
		$this->form_validation->set_rules('id_hasil', 'id_hasil', 'required');
		$this->form_validation->set_rules('nomor', 'nomor', 'required');
		$this->form_validation->set_rules('p1', 'p1', 'required');
		$this->form_validation->set_rules('p2', 'p2', 'required');
		$this->form_validation->set_rules('p3', 'p3', 'required');
		$this->form_validation->set_rules('p4', 'p4', 'required');
		$this->form_validation->set_rules('p5', 'p5', 'required');
		$this->form_validation->set_rules('p6', 'p6', 'required');
		$this->form_validation->set_rules('p7', 'p7', 'required');
		$this->form_validation->set_rules('p8', 'p8', 'required');
		$this->form_validation->set_rules('i1', 'i1', 'required');
		$this->form_validation->set_rules('i2', 'i2', 'required');
		$this->form_validation->set_rules('i3', 'i3', 'required');
		$this->form_validation->set_rules('i4', 'i4', 'required');
		$this->form_validation->set_rules('i5', 'i5', 'required');
		$this->form_validation->set_rules('t', 't', 'required');
		$this->form_validation->set_rules('id_asesor', 'id_asesor', 'required');


		// jika proses validasi sukses, maka lanjut mengupdate data
		if ($this->form_validation->run() == TRUE)
		{
			$p1 = $this->input->post('p1');
			$p2 = $this->input->post('p2');
			$p3 = $this->input->post('p3');
			$p4 = $this->input->post('p4');
			$p5 = $this->input->post('p5');
			$p6 = $this->input->post('p6');
			$p7 = $this->input->post('p7');
			$p8 = $this->input->post('p8');
			$potensi= ($p1+$p2+$p3+$p4+$p5+$p6+$p7+$p8)*20/100;

			$i1 = $this->input->post('i1');
			$i2 = $this->input->post('i2');
			$i3 = $this->input->post('i3');
			$i4 = $this->input->post('i4');
			$i5 = $this->input->post('i5');
			$inti	= (($i1+$i2+$i3+$i4+$i5)*40/100);

			$t = $this->input->post('t');
			$teknis	= ($t)*40/100;

			$total = $potensi+$inti+$teknis;

			if ($total >= 70){
				$rekomendasi = "Telah Memenuhi Persyaratan";
			}elseif ($total >= 50){
				$rekomendasi = "Belum Memenuhi Persyaratan";
			}else
			{ $rekomendasi = "Belum Memenuhi Persyaratan"; }

		// save data
			$absen = array('id_hasil' 			=> $this->input->post('id_hasil'),
							'nomor'		=> $this->input->post('nomor'),
							'p1'		=> $this->input->post('p1'),
							'p2'		=> $this->input->post('p2'),
							'p3'		=> $this->input->post('p3'),
							'p4'		=> $this->input->post('p4'),
							'p5'		=> $this->input->post('p5'),
							'p6'		=> $this->input->post('p6'),
							'p7'		=> $this->input->post('p7'),
							'p8'		=> $this->input->post('p8'),
							'potensi'	=> $potensi,
							'i1'		=> $this->input->post('i1'),
							'i2'		=> $this->input->post('i2'),
							'i3'		=> $this->input->post('i3'),
							'i4'		=> $this->input->post('i4'),
							'i5'		=> $this->input->post('i5'),
							'inti'		=> $inti,
							't'		=> $this->input->post('t'),
							'teknis'	=> $teknis,
							'total'		=> $total,
							'rekomendasi'	=> $rekomendasi,
							'id_asesor'	=> $this->input->post('id_asesor')
						);
			$this->hasil_model->update($this->session->userdata('nomor'), $hasil);

			// set pesan
			$this->session->set_flashdata('message', 'Satu data hasil berhasil diupdate!');

			redirect('hasil');
		}
		else
		{
			$data['default']['id_kegiatan'] = $this->input->post('id_kegiatan');
			$this->load->view('template', $data);
		}
	}

	/**
	 * Validasi untuk nomor, agar tidak ada hasil dengan Nomor Peserta Sama sama
	 */
	function valid_nomor($id_hasil)
	{
		if ($this->hasil_model->valid_nomor($id_hasil) == TRUE)
		{
			$this->form_validation->set_message('valid_nomor', "hasil dengan Nomor Peserta $nomor sudah terdaftar");
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
		$current_id_hasil 	= $this->session->userdata('id_hasil');
		$new_id_hasil		= $this->input->post('id_hasil');

		if ($new_id_hasil === $current_id_hasil)
		{
			return TRUE;
		}
		else
		{
			if($this->hasil_model->valid_nomor($new_id_hasil) === TRUE) // cek database untuk entry yang sama memakai valid_entry()
			{
				$this->form_validation->set_message('valid_nomor2', "id_hasil dengan nomor $new_id_hasil sudah terdaftar");
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}

}
// END hasil Class

/* End of file hasil.php */
/* Location: ./system/application/controllers/hasil.php */