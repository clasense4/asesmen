<?php 
echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

$flashmessage = $this->session->flashdata('message');
echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="skor_form" method="post" action="<?php echo $form_action; ?>">
	<input type="hidden" class="form_field" name="id_skor" size="30" value="<?php echo set_value('id_skor', isset($default['id_skor']) ? $default['id_skor'] : ''); ?>" />
	<?php echo form_error('id_skor', '<p class="field_error">', '</p>');?>
	
	<p><label for="nama">nama</label><input type="text" class="form_field" name="nama" size="30" value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" /></p>
	<?php echo form_error('nama', '<p class="field_error">', '</p>');?>
	
	<p><label for="prosentasi_skor">prosentasi_skor</label><input type="text" class="form_field" name="prosentasi_skor" size="30" value="<?php echo set_value('prosentasi_skor', isset($default['prosentasi_skor']) ? $default['prosentasi_skor'] : ''); ?>" /></p>
	<?php echo form_error('prosentasi_skor', '<p class="field_error">', '</p>');?>


	<p><label for="id_group_skor">id_group_skor</label>
		<select name="id_group_skor">
			<option value="">Select...</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="4">3</option>
			<option value="4">4</option>
			value="<?php echo set_value('id_group_skor', isset($default['id_group_skor']) ? $default['nama'] : ''); ?>" 
		</select>
	</p>

	
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
