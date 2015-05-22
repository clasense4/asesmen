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
		$this->load->library('fpdf');
		$this->load->helper('form');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
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
	 * Mendapatkan semua data hasil di database dan menampilkannya di tabel
	 */
	function get_all($offset, $id_kegiatan)
	{	
		$data['title'] = $this->title;
		$data['h2_title'] = 'Data Penilaian';
		$data['main_view'] = 'hasil/hasil';
		$data['id_kegiatan'] = $id_kegiatan;

		// Offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		$hasil = $this->model_hasil->search(NULL,NULL,'hasil_penilaian',$this->limit, $offset);
		$num_rows = $this->model_hasil->count(NULL,NULL,'hasil_penilaian');
		
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
			array_push($fields, 'No', 'Nomor Peserta' , 'Nama Peserta' , 'Nilai POTENSI', 
								'Nilai Kompetensi Inti' , 'Nilai Kompetensi Kepemimpinan' , 'Nilai Kompetensi Jabatan', 
								'Nilai Kompetensi Teknis' , 'Total Nilai', 'Rekomendasi', 'Nama Asesor', 'Action');
			$this->table->set_heading($fields);
			$data_kegiatan = $this->hasil_model->getDataByKegiatan($id_kegiatan);
			
			$i = -1 + $offset;
			
				foreach ($data_kegiatan as $row)
				{
					$data['kegiatan'] = $row->nama;				
					$this->table->add_row(++$i, $row->no_asesi, $row->nama_asesi, $row->potensi, $row->inti, $row->kepemimpinan, $row->jabatan, $row->teknis, $row->total, $row->rekomendasi, $row->nama_asesor,
											anchor('hasil/hasilpdf/'.$id_kegiatan ,'report',array('class' => 'proses')).' '.
											anchor('hasil/update/'.$row->id_penilaian.'/'.$id_kegiatan,'update',array('class' => 'update')).' '.
											anchor('hasil/delete/'.$row->id_penilaian.'/'.$id_kegiatan,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
											);
				}
			
			
			$data['table'] = $this->table->generate();
		}
		else
		{
			$data['message'] = 'Tidak ditemukan satupun data hasil!';
		}

		$data['link'] = array('link_add' => anchor('hasil/add/'.$id_kegiatan,'tambah data', array('class' => 'add'))
								);

		// Load view
		$this->load->view('template', $data);
	}

	/**
	 * Menghapus data hasil dengan nomor tertentu
	 */
	function delete($id_penilian,$id_kegiatan)
	{
		$this->hasil_model->delete($id_penilian);
		$this->session->set_flashdata('message', '1 data hasil berhasil dihapus');

		redirect('hasil/index/'.$id_kegiatan);
	}

	/**
	 * Menampilkan form tambah hasil
	 */
	function add($id_kegiatan)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Hasil Asesmen > Tambah Data';
		$data['main_view'] 		= 'hasil/hasil_form';
		$data['form_action']	= site_url('hasil/add_process/'.$id_kegiatan);
		$data['id_kegiatan'] 	= $id_kegiatan;
		$data['link'] 			= array('link_back' => anchor('hasil','kembali', array('class' => 'back'))
										);

		$asesi = $this->asesi_model->get_asesi($id_kegiatan)->result();
		$data['options_asesi'][""] = 'Pilih';
		foreach($asesi as $row)
		{
			$data['options_asesi'][$row->nama."|".$row->no_asesi] = $row->no_asesi;
		}

		$asesor = $this->asesor_model->get_asesor()->result();
		$data['options_asesor'][0] = 'Pilih';
		foreach($asesor as $row)
		{
			$data['options_asesor'][$row->nama] = $row->nama;
		}
		
		$this->db->select('*');
		$this->db->from('assign_kegiatan_skor ask');
		$this->db->join('skor sk', 'ask.id_skor = sk.id_skor','left');
		$this->db->where('ask.id_kegiatan', $id_kegiatan);
		$data['skor'] = $this->db->get()->result();
		
		$data['group_skor'] = $this->model_hasil->search(NULL,NULL,'group_skor');
		$this->load->view('template', $data);
	}
	/**
	 * Proses tambah data hasil
	 */
	function add_process($id_kegiatan)
	{
		$data['title'] 			= $this->title;
		$data['id_kegiatan'] 	= $id_kegiatan;
		$data['h2_title'] 		= 'Data Hasil Asesmen > Tambah Data';
		$data['main_view'] 		= 'hasil/hasil_form';
		$data['form_action']	= site_url('hasil/add_process');
		$data['link'] 			= array('link_back' => anchor('hasil/','kembali', array('class' => 'back'))
										);

		// data kegiatan untuk dropdown menu
		/*$asesi = $this->asesi_model->get_asesi($id_kegiatan)->result();
		foreach($asesi as $row)
		{
			$data['options_asesi'][$row->id_asesi] = $row->nama;
		}

		$asesor = $this->asesor_model->get_asesor($id_kegiatan)->result();
		foreach($asesor as $row)
		{
			$data['options_asesor'][$row->id_asesor] = $row->nama;
		}
		
		
		$this->db->select('*');
		$this->db->from('assign_kegiatan_skor ask');
		$this->db->join('skor sk', 'ask.id_skor = sk.id_skor','left');
		$this->db->where('ask.id_kegiatan', $id_kegiatan);
			$skor = $this->db->get()->result();
			$group_skor = $this->model_hasil->search(NULL,NULL,'group_skor');
			$a = 0;
			$b = 0;
		foreach ($group_skor as $keys => $values) {
		foreach ($skor as $key => $value) {
			if ($values->id_group_skor == $value->id_group_skor) {
				$p[$a] = $this->input->post('.'$value->id_skor'.');	
			}	
		}
			$p[$a] = $this->input->post('.'$values->id_group_skor'.');
		}*/
			$id_Kegiatan = $this->input->post('id_kegiatan');
			
			$p1 = $this->input->post('9');
			$p2 = $this->input->post('10');
			$p3 = $this->input->post('11');
			$p4 = $this->input->post('12');
			$p5 = $this->input->post('13');
			$p6 = $this->input->post('14');
			$p7 = $this->input->post('15');
			$p8 = $this->input->post('16');
			$p9 = $this->input->post('17');
			//add nilai potensi
			$nilai_potensi = array(
							'id_kegiatan'			=> $id_Kegiatan,
							'kecerdasan_umum'		=> $p1,
							'daya_abstraksi'		=> $p2,
							'daya_analisis'			=> $p3,
							'kerja_sama'			=> $p4,
							'kendali_emosi'			=> $p5,
							'daya_tahan'			=> $p6,
							'kepercayaan_diri'		=> $p7,
							'motivasi_kerja'			=> $p8,
							'sistematika_kerja'			=> $p9
							);
			$this->hasil_model->addPotensi($nilai_potensi);
			$uraian1 = $this->input->post('uraian1');
			$potensi= ($p1+$p2+$p3+$p4+$p5+$p6+$p7+$p8)*8/100;

			$i1 = $this->input->post('18');
			$i2 = $this->input->post('19');
			$i3 = $this->input->post('20');
			$i4 = $this->input->post('21');
			//add nilai inti
			$nilai_inti = array(
							'id_kegiatan'			=> $id_Kegiatan,
							'integritas'			=> $i1,
							'dorongan_berprestasi'	=> $i2,
							'kepentingan'			=> $i3,
							'kerja_sama'			=> $i4
							);
			$this->hasil_model->addInti($nilai_inti);
			$uraian2 = $this->input->post('uraian2');
			$inti	= (($i1+$i2+$i3+$i4)*4/100);
			
			$k1 = $this->input->post('1');
			$k2 = $this->input->post('2');
			$k3 = $this->input->post('3');
			$k4 = $this->input->post('4');
			//add nilai kepemimpinan
			$nilai_kepemimpinan = array(
							'id_kegiatan'			=> $id_Kegiatan,
							'kepemimpinan'			=> $k1,
							'pengembangan_kelompok'	=> $k2,
							'pemimpin_perubahan'			=> $k3,
							'pemahaman_strategis'			=> $k4
							);
			$this->hasil_model->addKepemimpinan($nilai_kepemimpinan);
			$uraian3 = $this->input->post('uraian3');
			$kepemimpinan	= (($k1+$k2+$k3+$k4)*4/100);
			
			$j1 = $this->input->post('5');
			$j2 = $this->input->post('6');
			$j3 = $this->input->post('7');
			$j4 = $this->input->post('8');
			//add nilai Jabatan
			$nilai_jabatan = array(
							'id_kegiatan'			=> $id_Kegiatan,
							'kualitas'				=> $j1,
							'pemikiran_analitis'	=> $j2,
							'pemikiran_konseptual'	=> $j3,
							'inisiatif'				=> $j4
							);
			$this->hasil_model->addJabatan($nilai_jabatan);
			$uraian4 = $this->input->post('uraian4');
			$jabatan	= (($k1+$k2+$k3+$k4)*4/100);
			
			$t = $this->input->post('27');
			//add nilai teknis
			$nilai_teknis = array(
							'id_kegiatan'			=> $id_Kegiatan,
							'teknis'				=> $t
							);
			$this->hasil_model->addTeknis($nilai_teknis);
			
			$uraian5 = $this->input->post('uraian5');
			$teknis	= ($t)*1/100;

			$total = $potensi+$inti+$kepemimpinan+$jabatan+$teknis;

			if ($total >= 70){
				$rekomendasi = "Telah Memenuhi Persayaratan";
			} else if ($total >= 50){
				$rekomendasi = "Belum Memenuhi Persayaratan";
			} else
			{ $rekomendasi = "Belum Memenuhi Persayaratan"; }
			
			$dataAsesi = $this->input->post('no_asesi');
			$dataAsesi_result = explode( '|' , $dataAsesi);
			$no_asesi = $dataAsesi_result[1];
			
			// save data
			$hasil = array('id_penilaian' 		=> $this->input->post('id_penilaian'),
							'id_kegiatan'		=> $this->input->post('id_kegiatan'),
							'no_asesi'			=> $no_asesi,
							'nama_asesi'		=> $this->input->post('nama'),
							'potensi'			=> $potensi,
							'uraian_potensi'	=> $uraian1,
							'inti'				=> $inti,
							'uraian_inti'		=> $uraian2,
							'kepemimpinan'		=> $kepemimpinan,
							'uraian_kepemimpinan'	=> $uraian3,
							'jabatan'			=> $jabatan,
							'uraian_jabatan'	=> $uraian4,
							'teknis'			=> $teknis,
							'uraian_teknis'		=> $uraian5,
							'total'				=> $total,
							'rekomendasi'		=> $rekomendasi,							
							'simpulan'			=> $this->input->post('simpulan'),
							'saran'				=> $this->input->post('saran'),
							'nama_asesor'		=> $this->input->post('asesor')
							);
			$this->hasil_model->add($hasil);

		$this->session->set_flashdata('message', 'Satu data hasil berhasil disimpan!');			
		redirect('hasil/index/'.$id_kegiatan);
	}

	/**
	 * Menampilkan form update data hasil
	 */
	function update($id_penilaian, $id_kegiatan)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Data Hasil Asesmen > Detail';
		$data['main_view'] 		= 'hasil/hasil_form';
		$data['form_action']	= site_url('hasil/update_process');
		$data['link'] 			= array('link_back' => anchor('hasil','kembali', array('class' => 'back'))
										);
		$data['id_kegiatan'] 	= $id_kegiatan;
		// data kegiatan untuk dropdown menu
		$asesi = $this->asesi_model->get_asesi($id_kegiatan)->result();
		$data['options_asesi'][""] = 'Pilih';
		foreach($asesi as $row)
		{
			$data['options_asesi'][$row->nama."|".$row->no_asesi] = $row->no_asesi;
		}

		$asesor = $this->asesor_model->get_asesor()->result();
		$data['options_asesor'][0] = 'Pilih';
		foreach($asesor as $row)
		{
			$data['options_asesor'][$row->nama] = $row->nama;
		}
		
		$this->db->select('*');
		$this->db->from('assign_kegiatan_skor ask');
		$this->db->join('skor sk', 'ask.id_skor = sk.id_skor','left');
		$this->db->where('ask.id_kegiatan', $id_kegiatan);
		$data['skor'] = $this->db->get()->result();
		
		$data['group_skor'] = $this->model_hasil->search(NULL,NULL,'group_skor');
		
		// cari data dari database
		$hasil = $this->hasil_model->get_hasil_by_id($id_penilaian);

		// buat session untuk menyimpan data primary key (nomor)
		$this->session->set_userdata('no_asesi', $hasil->no_asesi);

		// Data untuk mengisi field2 form
		$data['default']['id_penilaian'] 	= $hasil->id_penilaian;
		$data['default']['id_kegiatan'] 	= $hasil->id_kegiatan;
		$data['default']['no_asesi'] 	= $hasil->no_asesi;
		$data['default']['nama_asesi'] 	= $hasil->nama_asesi;
		$data['default']['potensi']	= $hasil->potensi;
		$data['default']['uraian_potensi']	= $hasil->uraian_potensi;
		$data['default']['inti']	= $hasil->inti;
		$data['default']['uraian_inti']	= $hasil->uraian_inti;
		$data['default']['kepemimpinan']	= $hasil->kepemimpinan;
		$data['default']['uraian_kepemimpinan']	= $hasil->uraian_kepemimpinan;
		$data['default']['jabatan']	= $hasil->jabatan;
		$data['default']['uraian_jabatan']	= $hasil->uraian_jabatan;
		$data['default']['teknis']	= $hasil->teknis;
		$data['uraian_teknis']	= $hasil->uraian_teknis;
		$data['default']['simpulan']	= $hasil->simpulan;
		$data['default']['saran']	= $hasil->saran;
		$data['default']['nama_asesor']	= $hasil->nama_asesor;
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
	
	function hasilpdf($id_kegiatan)
	{	
		$data['nilai_potensi'] = $this->hasil_model->getDataNilaiPotensi($id_kegiatan);
		$data['nilai_inti'] = $this->hasil_model->getDataNilaiInti($id_kegiatan);
		$data['nilai_kepemimpinan'] = $this->hasil_model->getDataNilaiKep($id_kegiatan);
		$data['nilai_jabatan'] = $this->hasil_model->getDataNilaiJab($id_kegiatan);
		$data['nilai_teknis'] = $this->hasil_model->getDataNilaiTek($id_kegiatan);
		
		$data['hasil_list'] = $this->hasil_model->getDataByKegiatan($id_kegiatan);
		$this->load->view('hasil/hasil_list_excel', $data);
	}
	
	function hasildatapdf($id_kegiatan)
	{
		$data['hasil_list'] = $this->hasil_model->getDataByKegiatan($id_kegiatan);
		$this->load->view('hasil/hasil_data_pdf', $data);
	}
	
	function hasildataxls($id_kegiatan){
		$data['hasil_list'] = $this->hasil_model->getDataByKegiatan($id_kegiatan)->result();
		$this->load->view('hasil/hasil_data_excel', $data);
	}

}
// END hasil Class

/* End of file hasil.php */
/* Location: ./system/application/controllers/hasil.php */