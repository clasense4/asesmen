<?php
    class Latihan5crudci extends CI_Controller {
        function __construct() {
            parent::__construct();
            $this->load->view('viewlatihancrud');
        }
        
        function tambahdata() {
            $data = array(
                'judul' => $this->input->post('judul'),
                'konten' => $this->input->post('konten')
            );
            
            $this->modellatihancrudci->tambah_data($data);
            $this->index();
        }
    }
?>