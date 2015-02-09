<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');
class model_hasil extends super_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public $table = 'hasil';
}