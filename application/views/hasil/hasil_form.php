<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="asesi_form" method="post" action="<?php echo $form_action; ?>">
	<p>
		<label for="id_hasil">id_hasil:</label>
		<input type="text" class="form_field" name="id_hasil" size="30" value="<?php echo set_value('id_hasil', isset($default['id_hasil']) ? $default['id_hasil'] : ''); ?>" />
	</p>
	<?php echo form_error('id_hasil', '<p class="field_error">', '</p>');?>

	<p>
		<label for="nomor">Nomor Peserta:</label>
        <?php echo form_dropdown('nomor', $options_asesi, isset($default['nomor']) ? $default['nomor'] : ''); ?>
	</p>
	<?php echo form_error('nomor', '<p class="field_error">', '</p>');?>
	
	<p>
		<label for="tanggal">p1:</label>
		<input type="text" class="form_field" name="p1" size="8" value="<?php echo set_value('p1', isset($default['p1']) ? $default['p1'] : ''); ?>" />
		
	</p>
	<?php echo form_error('p1', '<p class="field_error">', '</p>');?>	
	
	<p>
		<label for="tanggal">p2:</label>
		<input type="text" class="form_field" name="p2" size="8" value="<?php echo set_value('p2', isset($default['p2']) ? $default['p2'] : ''); ?>" />
		
	</p>
	<?php echo form_error('p2', '<p class="field_error">', '</p>');?>
		
	<p>
		<label for="tanggal">p3:</label>
		<input type="text" class="form_field" name="p3" size="8" value="<?php echo set_value('p3', isset($default['p3']) ? $default['p3'] : ''); ?>" />
	</p>
	<?php echo form_error('p3', '<p class="field_error">', '</p>');?>
		
	<p>
		<label for="tanggal">p4:</label>
		<input type="text" class="form_field" name="p4" size="8" value="<?php echo set_value('p4', isset($default['p4']) ? $default['p4'] : ''); ?>" />	
	</p>
	<?php echo form_error('p4', '<p class="field_error">', '</p>');?>
		
	<p>
		<label for="tanggal">p5:</label>
		<input type="text" class="form_field" name="p5" size="8" value="<?php echo set_value('p5', isset($default['p5']) ? $default['p5'] : ''); ?>" />
	</p>
	<?php echo form_error('p5', '<p class="field_error">', '</p>');?>
		
	<p>
		<label for="tanggal">p6:</label>
		<input type="text" class="form_field" name="p6" size="8" value="<?php echo set_value('p6', isset($default['p6']) ? $default['p6'] : ''); ?>" />
	</p>
	<?php echo form_error('p6', '<p class="field_error">', '</p>');?>
		
	<p>
		<label for="tanggal">p7:</label>
		<input type="text" class="form_field" name="p7" size="8" value="<?php echo set_value('p7', isset($default['p7']) ? $default['p7'] : ''); ?>" />	
	</p>
	<?php echo form_error('p7', '<p class="field_error">', '</p>');?>
		
	<p>
		<label for="tanggal">p8:</label>
		<input type="text" class="form_field" name="p8" size="8" value="<?php echo set_value('p8', isset($default['p8']) ? $default['p8'] : ''); ?>" />
	</p>
	<?php echo form_error('p8', '<p class="field_error">', '</p>');?>

	<p>
		<label for="tanggal">i1:</label>
		<input type="text" class="form_field" name="i1" size="8" value="<?php echo set_value('i1', isset($default['i1']) ? $default['i1'] : ''); ?>" />
	</p>
	<?php echo form_error('i1', '<p class="field_error">', '</p>');?>
		
	<p>
		<label for="tanggal">i2:</label>
		<input type="text" class="form_field" name="i2" size="8" value="<?php echo set_value('i2', isset($default['i2']) ? $default['i2'] : ''); ?>" />
		
	</p>
	<?php echo form_error('i2', '<p class="field_error">', '</p>');?>
		
	<p>
		<label for="tanggal">i3:</label>
		<input type="text" class="form_field" name="i3" size="8" value="<?php echo set_value('i3', isset($default['i3']) ? $default['i3'] : ''); ?>" />
		
	</p>
	<?php echo form_error('i3', '<p class="field_error">', '</p>');?>
		
	<p>
		<label for="tanggal">i4:</label>
		<input type="text" class="form_field" name="i4" size="8" value="<?php echo set_value('i4', isset($default['i4']) ? $default['i4'] : ''); ?>" />
		
	</p>
	<?php echo form_error('i4', '<p class="field_error">', '</p>');?>
		
	<p>
		<label for="tanggal">i5:</label>
		<input type="text" class="form_field" name="i5" size="8" value="<?php echo set_value('i5', isset($default['i5']) ? $default['i5'] : ''); ?>" />
		
	</p>
	<?php echo form_error('i5', '<p class="field_error">', '</p>');?>

		
	<p>
		<label for="tanggal">t:</label>
		<input type="text" class="form_field" name="t" size="8" value="<?php echo set_value('t', isset($default['t']) ? $default['t'] : ''); ?>" />
		
	</p>
	<?php echo form_error('t', '<p class="field_error">', '</p>');?>
		
	<p>
		<label for="id_asesor">Asesor:</label>
        <?php echo form_dropdown('id_asesor', $options_asesor, isset($default['id_asesor']) ? $default['id_asesor'] : ''); ?>
	</p>
	<?php echo form_error('id_asesor', '<p class="field_error">', '</p>');?>

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