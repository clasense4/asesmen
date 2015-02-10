<?php

if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class super_model extends CI_Model
{
    public $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = get_Class($this);
        $this->load->database();
    }

	public function save($data,$tablename="",$get_id=0)
	{
	    if($tablename=="")
	    {
	        $tablename = $this->table;
	    }
	    $op = 'update';
	    $keyExists = FALSE;
	    $fields = $this->db->field_data($tablename);

	    foreach ($fields as $field)
	    {
	        if($field->primary_key==1)
	        {
	            $keyExists = TRUE;
	            if(isset($data[$field->name]))
	            {
	                $this->db->where($field->name, $data[$field->name]);
	            }
	            else
	            {
	                $op = 'insert';
	            }
	        }
	    }
	    if($keyExists && $op=='update')
	    {
	        $this->db->set($data);
	        $this->db->update($tablename);
	        if($this->db->affected_rows()==1)
	        {
	            return $this->db->affected_rows();
	        }
	    }
	    $this->db->insert($tablename,$data);
	    if ($get_id == 1) {
		    return $this->db->insert_id();
	    }
	    else {
	    	return $this->db->affected_rows();
	    }
	}

	function search($conditions=NULL,$value=NULL,$tablename="",$limit=500,$offset=0)
	{
	    if($tablename=="")
	    {
	        $tablename = $this->table;
	    }
	    if($conditions != NULL)
	        $this->db->where($conditions, $value);

	    $query = $this->db->get($tablename,$limit,$offset=0);
	    return $query->result();
	}

	function count($conditions=NULL,$value=NULL,$tablename="",$limit=500,$offset=0)
	{
	    if($tablename=="")
	    {
	        $tablename = $this->table;
	    }
	    if($conditions != NULL)
	        $this->db->where($conditions, $value);

	    $query = $this->db->get($tablename,$limit,$offset=0);
	    return count($query->result());
	}

	function insert($data,$tablename="")
	{
	    if($tablename=="")
	        $tablename = $this->table;
	    $this->db->insert($tablename,$data);
	    return $this->db->affected_rows();
	}

	function update($data,$conditions,$tablename="")
	{
	    if($tablename=="")
	        $tablename = $this->table; $this->db->where($conditions);
	    $this->db->update($tablename,$data);
	    return $this->db->affected_rows();
	}

	function delete($conditions,$value,$tablename="")
	{
	    if($tablename=="")
	        $tablename = $this->table;
	    $this->db->where($conditions,$value);
	    $this->db->delete($tablename);
	    return $this->db->affected_rows();
	}

	/**
    * Prepare INSERT IGNORE SQL query
    * @param Array $data Array in form of "Column" => "Value", ... 
    * @return Null
    */
    function insert_ignore(array $data, $table) {
        $_prepared = array();

        foreach ($data as $col => $val)
            $_prepared[$this->db->_escape_identifiers($col)] = $this->db->escape($val); 
        $query = 'INSERT IGNORE INTO `'.$table.'` ('.implode(',',array_keys($_prepared)).') VALUES('.implode(',',array_values($_prepared)).');';
        echo $query."<br>";
        $this->db->query($query);
    }
}