<?php
class Latihan2ci extends CI_Controller {
    function index() {
        $this->load->model('modellatihan2ci');
        $hasil['data'] = $this->modellatihan2ci->tangkapdb();
        $this->load->view('viewlatihan2ci',$hasil);
    }
}
?>