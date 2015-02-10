<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class assign_kegiatan_skor extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('helper_model', '', TRUE);
		$this->load->model('model_skor', '', TRUE);
		$this->load->model('asesi_model', '', TRUE);
		$this->load->model('asesor_model', '', TRUE);
	}

	public function index()
	{

	}

	public function add($id_kegiatan=NULL)
	{
		$data['main_view'] 		= 'assign_kegiatan_skor/assign_kegiatan_skor_table';
		$data['id_kegiatan']	= $id_kegiatan;
		// get data
		$this->db->select('*');
		$this->db->from('assign_kegiatan_skor ask');
		$this->db->join('skor sk', 'ask.id_skor = sk.id_skor','left');
		// $this->db->join('group_skor gsk', 'sk.id_group_skor = gsk.id_group_skor','left');
		$this->db->where('ask.id_kegiatan', $id_kegiatan);
		// $this->db->order_by('id_hasil', 'asc');
		$data['skor'] = $this->db->get()->result();

		$data['group_skor'] = $this->model_skor->search(NULL,NULL,'group_skor');
		// $this->helper_model->printr($data['skor']);
		$this->load->view($data['main_view'], $data);
	}
}