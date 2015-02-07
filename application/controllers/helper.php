<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Helper extends CI_Controller {
	public function index()
	{
		echo "Helper controller";
	}

	public function test_field_metadata($table)
	{
		$fields = $this->db->field_data($table);

		foreach ($fields as $field)
		{
		   echo $field->name."<br>";
		   echo $field->type."<br>";
		   echo $field->max_length."<br>";
		   echo $field->primary_key."<br>";
		}
	}

	function print_form_by_column($column=NULL)
	{
		$string = '<p>
			<label for="'.$column.'">'.$column.'</label><input type="text" class="form_field" name="'.$column.'" size="30" value="
			<?php echo set_value(\''.$column.'\', isset($default[\''.$column.'\']) ? $default[\''.$column.'\'] : \'\'); ?>" />
		</p>

		<?php echo form_error(\''.$column.'\', \'<p class="field_error">\', \'</p>\');?>';
		echo htmlentities($string);
	}

	function print_form_by_table($table=NULL)
	{
		// get table columns
		$columns = $this->db->list_fields($table);
		foreach ($columns as $key => $column) {
			$string1 = '<p><label for="'.$column.'">'.$column.'</label><input type="text" class="form_field" name="'.$column.'" size="30" value="<?php echo set_value(\''.$column.'\', isset($default[\''.$column.'\']) ? $default[\''.$column.'\'] : \'\'); ?>" /></p>';
			echo htmlentities($string1);
			echo "<br>";
			$string2 = '<?php echo form_error(\''.$column.'\', \'<p class="field_error">\', \'</p>\');?>';
			echo htmlentities($string2);
			echo "<br>";
		}
	}

	function print_session($table)
	{
		$string ='
		$this->session->set_userdata(\''.$table.'\', $'.$table.'->id_'.$table.');
		';
		echo htmlentities($string);
		echo "<br>";
		$columns = $this->db->list_fields($table);
		foreach ($columns as $key => $column) 
		{
			$string = '$data[\'default\'][\''.$column.'\'] = $'.$table.'->'.$column.';';
			echo "<br>";
			echo htmlentities($string);
		}
		// // Data untuk mengisi field2 form
		// $data['default']['nomor'] 		= $asesi->nomor;
		// $data['default']['nama'] 		= $asesi->nama;
		// $data['default']['jabatan'] 		= $asesi->jabatan;
		// $data['default']['unit'] 		= $asesi->unit;
		// $data['default']['id_kegiatan']	= $asesi->id_kegiatan;
		// ';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/helper.php */