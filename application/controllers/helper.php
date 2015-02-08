<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Helper extends CI_Controller {
	public function index()
	{
		$tables = $this->db->list_tables();

		foreach ($tables as $table)
		{
			echo "<h2>Menu $table: </h2>".
			"<ol>".
			"<li><a href=\"helper/get_field/$table\" target=\"_blank\">Get Fields from Table (helper/get_field/$table</a></li>".
			"<li><a href=\"helper/get_field_metadata/$table\" target=\"_blank\">Get Fields Metadata from Table (helper/get_field_metadata/$table</a></li>".
			"<li><a href=\"helper/print_form_by_column\" target=\"_blank\">Print form by Column from Table (helper/print_form_by_column/{column}</a></li>".
			"<li><a href=\"helper/print_form_by_table/$table\" target=\"_blank\">Print form from Table (helper/print_form_by_table/$table</a></li>".
			"<li><a href=\"helper/print_crud_process/$table\" target=\"_blank\">Print CRUD Process from Table (helper/print_crud_process/$table</a></li>".
			"</ol><hr>";
		}
	}

	function get_field($table)
	{
		$fields = $this->db->list_fields($table);
		foreach ($fields as $field)
		{
		   // echo $this->helper_model->strip_underscore($field). ",";
		   echo "\$row->".$field. ",";
		}
	}

	public function get_field_metadata($table)
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

	function print_crud_process($table)
	{
		echo "<h2>Place it in add_process</h2>";
		echo "\$".$table." = \$this->input->post();"."<br>".
		"unset(\$".$table."['submit']);"."<br>".
		"unset(\$".$table."['id_".$table."']);"."<br>".
		"\$this->helper_model->printr(\$".$table.");"."<br>".
		"\$this->".$table."_model->add(\$".$table.");"."<br>".
		"\$this->session->set_flashdata('message', 'Satu data ".$table." berhasil disimpan!');"."<br>".
		"redirect('".$table."');";
		echo "<hr>";

		echo "<h2>Place it in update</h2>";
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

		echo "<h2>Place it in update_process</h2>";
		echo "\$".$table." = \$this->input->post();"."<br>".
		"unset(\$".$table."['submit']);"."<br>".
		"\$this->helper_model->printr(\$".$table.");"."<br>".
		"\$this->model_".$table."->save(\$".$table.",'".$table."');"."<br>".
		"\$this->session->set_flashdata('message', 'Satu data ".$table." berhasil diupdate!');"."<br>".
		"redirect('".$table."');";
		echo "<hr>";

		echo "<h2>Place it in delete</h2>";
		echo "\$this->model_".$table."->delete('id_".$table."',\$id_".$table.",'".$table."');";
		echo "<br>";
		echo "\$this->session->set_flashdata('message', '1 data ".$table." berhasil dihapus');";
		echo "<br>";
		echo "redirect('".$table."');";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/helper.php */