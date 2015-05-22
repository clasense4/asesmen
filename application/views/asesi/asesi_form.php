<?php 
echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

$flashmessage = $this->session->flashdata('message');
echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="asesi_form" method="post" action="<?php echo $form_action; ?>">
	<input type="hidden" class="form_field" name="id_asesi" value="<?php echo set_value('id_asesi', isset($default['id_asesi']) ? $default['id_asesi'] : ''); ?>" />
	<input type="hidden" class="form_field" name="id_kegiatan" value="<?php echo $id_kegiatan; ?>" />
	
	<p><label for="no_asesi">No Asesi :</label><input type="text" class="form_field" required name="no_asesi" size="30" value="<?php echo set_value('no_asesi', isset($default['no_asesi']) ? $default['no_asesi'] : ''); ?>" /></p>
	<?php echo form_error('nama', '<p class="field_error">', '</p>');?>
	<p><label for="nama">Nama :</label><input type="text" class="form_field" name="nama" size="30" required value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" /></p>
	<?php echo form_error('nama', '<p class="field_error">', '</p>');?>
	<p><label for="nip">NIP :</label><input type="text" class="form_field" name="nip" size="30"  required value="<?php echo set_value('nip', isset($default['nip']) ? $default['nama'] : ''); ?>" /></p>
	<?php echo form_error('nip', '<p class="field_error">', '</p>');?>
	<p><label for="pendidikan">Pendidikan :</label><input type="text" class="form_field" name="pendidikan" required size="30" value="<?php echo set_value('pendidikan', isset($default['pendidikan']) ? $default['pendidikan'] : ''); ?>" /></p>
	<?php echo form_error('pendidikan', '<p class="field_error">', '</p>');?>
	<p><label for="jabatan">Jabatan :</label><input type="text" class="form_field" name="jabatan" size="30" required value="<?php echo set_value('jabatan', isset($default['jabatan']) ? $default['jabatan'] : ''); ?>" /></p>
	<?php echo form_error('jabatan', '<p class="field_error">', '</p>');?>
	<p><label for="unit">Unit :</label><input type="text" class="form_field" name="unit" size="30" required value="<?php echo set_value('unit', isset($default['unit']) ? $default['unit'] : ''); ?>" /></p>
	<?php echo form_error('unit', '<p class="field_error">', '</p>');?>
	<p><label for="foto">Foto :</label><input type="file" name="foto" required />
	<?php echo form_error('foto', '<p class="field_error">', '</p>');?>

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