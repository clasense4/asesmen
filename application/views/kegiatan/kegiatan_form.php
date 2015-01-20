<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="kegiatan_form" method="post" action="<?php echo $form_action; ?>">
	<p>
		<label for="id">Id Kegiatan:</label>
		<input type="text" class="form_field" name="id_kegiatan" size="30" value="<?php echo set_value('id_kegiatan', isset($default['id_kegiatan']) ? $default['id_kegiatan'] : ''); ?>" />
	</p>
	<?php echo form_error('id_kegiatan', '<p class="field_error">', '</p>');?>
	
	<p>
		<label for="tanggal">Nama Kegiatan:</label>
		<input type="text" class="form_field" name="nama" size="50" value="<?php echo set_value('nama', isset($default['Nama Kegiatan']) ? $default['Nama Kegiatan'] : ''); ?>" />
		
	</p>
	<?php echo form_error('nama', '<p class="field_error">', '</p>');?>	
	
	<p>
		<label for="tanggal">Intansi:</label>
		<input type="text" class="form_field" name="instansi" size="50" value="<?php echo set_value('instansi', isset($default['Instansi']) ? $default['Instansi'] : ''); ?>" />
		
	</p>
	<?php echo form_error('instansi', '<p class="field_error">', '</p>');?>
	
	
	<p>
		<label for="tanggal">Tanggal Kegiatan:</label>
		<input type="text" class="form_field" name="tanggal" size="50" value="<?php echo set_value('tanggal', isset($default['Tanggal Kegiatan']) ? $default['Tanggal Kegiatan'] : ''); ?>" />
		
	</p>
	<?php echo form_error('tanggal', '<p class="field_error">', '</p>');?>	
	
	
	<p>
		<label for="tanggal">Catatan Kegiatan:</label>
		<input type="text" class="form_field" name="note" size="100" value="<?php echo set_value('note', isset($default['Catatan Kegiatan']) ? $default['Catatan Kegiatan'] : ''); ?>" />
		
	</p>
	<?php echo form_error('note', '<p class="field_error">', '</p>');?>	
	
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