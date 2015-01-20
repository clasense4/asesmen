<?php
class Login_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    var $table = 'user';
    
    function check_user($username, $password) {
        $query = $this->db->get_where($this->table, array('username' => $username, 'password' => $password), 1, 0);
        
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        
        else {
            return FALSE;
        }
    }
}
?>