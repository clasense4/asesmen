<?php 
echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

$flashmessage = $this->session->flashdata('message');
echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="asesi_form" method="post" action="<?php echo $form_action; ?>">
	<input type="hidden" class="form_field" name="id_asesi" size="30" value="<?php echo set_value('id_asesi', isset($default['id_asesi']) ? $default['id_asesi'] : ''); ?>" />
	<?php echo form_error('id_asesi', '<p class="field_error">', '</p>');?>
	<p><label for="nama">nama</label><input type="text" class="form_field" name="nama" size="30" value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" /></p>
	<?php echo form_error('nama', '<p class="field_error">', '</p>');?>
	<p><label for="nip">nip</label><input type="text" class="form_field" name="nip" size="30" value="<?php echo set_value('nip', isset($default['nip']) ? $default['nama'] : ''); ?>" /></p>
	<?php echo form_error('nip', '<p class="field_error">', '</p>');?>
	<p><label for="pendidikan">pendidikan</label><input type="text" class="form_field" name="pendidikan" size="30" value="<?php echo set_value('pendidikan', isset($default['pendidikan']) ? $default['pendidikan'] : ''); ?>" /></p>
	<?php echo form_error('pendidikan', '<p class="field_error">', '</p>');?>
	<p><label for="jabatan">jabatan</label><input type="text" class="form_field" name="jabatan" size="30" value="<?php echo set_value('jabatan', isset($default['jabatan']) ? $default['jabatan'] : ''); ?>" /></p>
	<?php echo form_error('jabatan', '<p class="field_error">', '</p>');?>
	<p><label for="unit">unit</label><input type="text" class="form_field" name="unit" size="30" value="<?php echo set_value('unit', isset($default['unit']) ? $default['unit'] : ''); ?>" /></p>
	<?php echo form_error('unit', '<p class="field_error">', '</p>');?>
	<p><label for="foto">foto</label><input type="file" name="foto" required />
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
