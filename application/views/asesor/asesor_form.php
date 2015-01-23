<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="asesor_form" method="post" action="<?php echo $form_action; ?>">
	<p>
		<label for="id">Id Asesor:</label>
		<input type="text" class="form_field" name="id_asesor" size="30" value="<?php echo set_value('id_asesor', isset($default['id_asesor']) ? $default['id_asesor'] : ''); ?>" />
	</p>
	<?php echo form_error('id_asesor', '<p class="field_error">', '</p>');?>
	
	<p>
		<label for="emailasesor">Nama Asesor:</label>
		<input type="text" class="form_field" name="namaasesor" size="50" value="<?php echo set_value('namaasesor', isset($default['namaasesor']) ? $default['namaasesor'] : ''); ?>" />
		
	</p>
	<?php echo form_error('namaasesor', '<p class="field_error">', '</p>');?>	
	
	<p>
		<label for="emailasesor">Pendidikan:</label>
		<input type="text" class="form_field" name="pendidikan" size="50" value="<?php echo set_value('pendidikan', isset($default['pendidikan']) ? $default['pendidikan'] : ''); ?>" />
		
	</p>
	<?php echo form_error('pendidikan', '<p class="field_error">', '</p>');?>
	
	
	<p>
		<label for="emailasesor">Email Asesor:</label>
		<input type="text" class="form_field" name="emailasesor" size="50" value="<?php echo set_value('emailasesor', isset($default['emailasesor']) ? $default['emailasesor'] : ''); ?>" />
		
	</p>
	<?php echo form_error('emailasesor', '<p class="field_error">', '</p>');?>	
	
	
	<p>
		<label for="emailasesor">Telepon Asesor:</label>
		<input type="text" class="form_field" name="telpasesor" size="100" value="<?php echo set_value('telpasesor', isset($default['telpasesor']) ? $default['telpasesor'] : ''); ?>" />
		
	</p>
	<?php echo form_error('telpasesor', '<p class="field_error">', '</p>');?>	

	
	<p>
		<label for="alamatasesor">Alamat Asesor:</label>
		<input type="text" class="form_field" name="alamatasesor" size="100" value="<?php echo set_value('alamatasesor', isset($default['alamatasesor']) ? $default['alamatasesor'] : ''); ?>" />
		
	</p>
	<?php echo form_error('alamat', '<p class="field_error">', '</p>');?>	
		
	<p>
		<input type="submit" name="submit" id="submit" value=" Simpan " />
	</p>
</form>

<?php
	if ( ! empty($link))
	{
		echo '<p id="bottom_link">';
		foreach($link as $links)
		{
			echo $links . ' ';
		}
		echo '</p>';
	}
?>