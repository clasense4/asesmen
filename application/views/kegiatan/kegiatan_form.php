<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="kegiatan_form" method="post" action="<?php echo $form_action; ?>">
	<input type="hidden" class="form_field" name="id_kegiatan" size="30" value="<?php echo set_value('id_kegiatan', isset($default['id_kegiatan']) ? $default['id_kegiatan'] : ''); ?>" />
	<?php echo form_error('id_kegiatan', '<p class="field_error">', '</p>');?>
	<p><label for="nama">nama</label><input type="text" class="form_field" name="nama" size="30" value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" /></p>
	<?php echo form_error('nama', '<p class="field_error">', '</p>');?>
	<p><label for="instansi">instansi</label><input type="text" class="form_field" name="instansi" size="30" value="<?php echo set_value('instansi', isset($default['instansi']) ? $default['instansi'] : ''); ?>" /></p>
	<?php echo form_error('instansi', '<p class="field_error">', '</p>');?>
	<p><label for="tanggal">tanggal</label><input type="text" class="form_field" name="tanggal" size="30" value="<?php echo set_value('tanggal', isset($default['tanggal']) ? $default['tanggal'] : ''); ?>" /></p>
	<?php echo form_error('tanggal', '<p class="field_error">', '</p>');?>
	<p><label for="proyek_mulai">proyek_mulai</label><input type="text" class="form_field" name="proyek_mulai" size="30" value="<?php echo set_value('proyek_mulai', isset($default['proyek_mulai']) ? $default['proyek_mulai'] : ''); ?>" /></p>
	<?php echo form_error('proyek_mulai', '<p class="field_error">', '</p>');?>
	<p><label for="proyek_selesai">proyek_selesai</label><input type="text" class="form_field" name="proyek_selesai" size="30" value="<?php echo set_value('proyek_selesai', isset($default['proyek_selesai']) ? $default['proyek_selesai'] : ''); ?>" /></p>
	<?php echo form_error('proyek_selesai', '<p class="field_error">', '</p>');?>
	<p><label for="note">note</label><input type="text" class="form_field" name="note" size="30" value="<?php echo set_value('note', isset($default['note']) ? $default['note'] : ''); ?>" /></p>
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