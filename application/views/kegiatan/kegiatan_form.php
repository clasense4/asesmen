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
	
	<p><label for="bobot_p">bobot_p</label><input type="text" class="form_field" name="bobot_p" size="30" value="<?php echo set_value('bobot_p', isset($default['bobot_p']) ? $default['bobot_p'] : ''); ?>" /></p>
	<?php echo form_error('note', '<p class="field_error">', '</p>');?>
	
	<p><label for="bobot_i">bobot_i</label><input type="text" class="form_field" name="bobot_i" size="10" value="<?php echo set_value('bobot_i', isset($default['bobot_i']) ? $default['bobot_i'] : ''); ?>" /></p>
	<?php echo form_error('bobot_i', '<p class="field_error">', '</p>');?>
	
	<p><label for="bobot_j">bobot_j</label><input type="text" class="form_field" name="bobot_j" size="10" value="<?php echo set_value('bobot_j', isset($default['bobot_j']) ? $default['bobot_j'] : ''); ?>" /></p>
	<?php echo form_error('bobot_j', '<p class="field_error">', '</p>');?>
	
	<p><label for="bobot_k">bobot_k</label><input type="text" class="form_field" name="bobot_k" size="10" value="<?php echo set_value('bobot_k', isset($default['bobot_k']) ? $default['bobot_k'] : ''); ?>" /></p>
	<?php echo form_error('bobot_k', '<p class="field_error">', '</p>');?>
	
	<p><label for="bobot_t">bobot_t</label><input type="text" class="form_field" name="bobot_t" size="10" value="<?php echo set_value('bobot_t', isset($default['bobot_t']) ? $default['bobot_t'] : ''); ?>" /></p>
	<?php echo form_error('bobot_t', '<p class="field_error">', '</p>');?>
	<hr>

	<ol>
	<?php foreach ($group_skor as $key => $value) {
		echo "<li><strong>".$value->nama."</strong></li>";
		$skor = $this->model_skor->search('id_group_skor',$value->id_group_skor,'skor');
		foreach ($skor as $key1 => $value1) {
			// $this->helper_model->printr($value1);
			echo '<p><label for="skor['.$value1->id_skor.']">'.$value1->nama.'</label><input type="text" class="form_field" name="skor['.$value1->id_skor.']" size="1" value="" /></p><br>';
		}
		echo "<hr>";
	} ?>
	</ol>
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

<script type="text/javascript">
	$('#simpan').click(function() {
		
		if(bobot_p+bobot_i+bobot_j+bobot_k+bobot_j+bobot_t== 100){
			//alert('sama');
			var url = baseUrl+"kegiatan/add_process";    
			$('#frm').attr('action',url);	
			$('#tot').attr('value',loop);	

		} else {
		
			alert('bobot berbeda, silahkan ulang kembali');
			//var url = baseUrl+"asesi/add/<?php echo $tijur; ?>";    
			$('#frm').attr('action',url);
		}
	});

});

</script>
