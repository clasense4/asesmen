<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="asesi_form" method="post" action="<?php echo $form_action; ?>">
	<p>
		<label for="nomor">Nomor:</label>
		<input type="text" class="form_field" name="nomor" size="30" value="<?php echo set_value('nomor', isset($default['nomor']) ? $default['nomor'] : ''); ?>" />
	</p>
	<?php echo form_error('nomor', '<p class="field_error">', '</p>');?>
	
	<p>
		<label for="tanggal">Nama:</label>
		<input type="text" class="form_field" name="nama" size="100" value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" />
		
	</p>
	<?php echo form_error('nama', '<p class="field_error">', '</p>');?>	
	
	<p>
		<label for="tanggal">Jabatan:</label>
		<input type="text" class="form_field" name="jabatan" size="100" value="<?php echo set_value('jabatan', isset($default['jabatan']) ? $default['jabatan'] : ''); ?>" />
		
	</p>
	<?php echo form_error('jabatan', '<p class="field_error">', '</p>');?>
	
	<p>
		<label for="tanggal">Unit Kerja:</label>
		<input type="text" class="form_field" name="unit" size="100" value="<?php echo set_value('unit', isset($default['unit']) ? $default['unit'] : ''); ?>" />
		
	</p>
	<?php echo form_error('unit', '<p class="field_error">', '</p>');?>
	
	<p>
		<label for="id_kegiatan">Kegiatan:</label>
        <?php echo form_dropdown('id_kegiatan', $options_kegiatan, isset($default['id_kegiatan']) ? $default['id_kegiatan'] : ''); ?>
	</p>
	<?php echo form_error('id_kegiatan', '<p class="field_error">', '</p>');?>

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