<?php 
echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

$flashmessage = $this->session->flashdata('message');
echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="asesor_form" method="post" action="<?php echo $form_action; ?>">
	<input type="hidden" class="form_field" name="id_asesor" size="30" required value="<?php echo set_value('id_asesor', isset($default['id_asesor']) ? $default['id_asesor'] : ''); ?>" />
	<?php /*<input type="hidden" class="form_field" name="id_kegiatan" value="<?php echo $id_kegiatan; ?>" />
	      */ ?>
	<p><label for="nama">Nama :</label><input type="text" class="form_field" name="nama" size="30" required value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" /></p>
	<?php echo form_error('nama', '<p class="field_error">', '</p>');?>
	<p><label for="noreg">No Asesor :</label><input type="text" class="form_field" name="noreg" size="30" required value="<?php echo set_value('noreg', isset($default['noreg']) ? $default['noreg'] : ''); ?>" /></p>
	<?php echo form_error('noreg', '<p class="field_error">', '</p>');?>
	<p><label for="pendidikan">Pendidikan Terakhir :</label><input type="text" class="form_field" name="pendidikan" size="30" required value="<?php echo set_value('pendidikan', isset($default['pendidikan']) ? $default['pendidikan'] : ''); ?>" /></p>
	<?php echo form_error('pendidikan', '<p class="field_error">', '</p>');?>
	<p><label for="email">E-mail :</label><input type="email" class="form_field" name="email" size="30" required value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>" /></p>
	<?php echo form_error('email', '<p class="field_error">', '</p>');?>
	<p><label for="no_telp">No Telepon :</label><input type="text" class="form_field" name="no_telp" size="30" required value="<?php echo set_value('no_telp', isset($default['no_telp']) ? $default['no_telp'] : ''); ?>" /></p>
	<?php echo form_error('no_telp', '<p class="field_error">', '</p>');?>
	<p><label for="alamat">Alamat :</label><input type="text" class="form_field" name="alamat" size="30" required value="<?php echo set_value('alamat', isset($default['alamat']) ? $default['alamat'] : ''); ?>" /></p>
	<?php echo form_error('alamat', '<p class="field_error">', '</p>');?>
	<p><label for="surat_pernyataan">Surat pernyataan :</label><input type="file" name="surat_pernyataan" required />
	<?php echo form_error('surat_pernyataan', '<p class="field_error">', '</p>');?>
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