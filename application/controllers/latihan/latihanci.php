<?php
    class Latihanci extends CI_Controller {
        
        function index(){
            $this->load->model('modellatihanci');
            $data['records'] = $this->modellatihanci->tangkapdb();
            $this->load->view('viewlatihanci', $data);
            //$kata['kata1']="kata pertama";
            //$kata['kata2']="kata kedua";
            //$this->load->view('viewlatihanci',$kata);
        }
        
        //function fungsibaru(){
            //echo 'ini adalah fungsi baru';
        //}
        
        /*function aboutus(){
            $about['about']='ini adalah halaman abput us';
            $this->load->view('viewaboutus', $about);
        }*/
    }
    ?>