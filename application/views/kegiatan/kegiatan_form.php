<script type="text/javascript">
function validate(){
	var nama=document.getElementById('nama');
		if((nama.value==null)||(nama.value=="")){
		alert("Masukan Nama Kegiatan");
		return false;
		}
	var instansi=document.getElementById('instansi');
		if((instansi.value==null)||(instansi.value=="")){
		alert("Masukan instansi Kegiatan");
		return false;
		}
	var tanggal=document.getElementById('tanggal');
		if((tanggal.value==null)||(tanggal.value=="")){
		alert("Masukan tanggal Kegiatan");
		return false;
		}
	var proyek_mulai=document.getElementById('proyek_mulai');
		if((proyek_mulai.value==null)||(proyek_mulai.value=="")){
		alert("Masukan proyek_mulai Kegiatan");
		return false;
		}
	var proyek_selesai=document.getElementById('proyek_selesai');
		if((proyek_selesai.value==null)||(proyek_selesai.value=="")){
		alert("Masukan proyek_selesai Kegiatan");
		return false;
		}
	var bobot_p = document.getElementById('bobot_p');
		if((bobot_p.value==null)||(bobot_p.value=="")){
		alert("Masukan bobot potensi");
		return false;
		}
	var bobot_i = document.getElementById('bobot_i');
		if((bobot_i.value==null)||(bobot_i.value=="")){
		alert("Masukan bobot inti");
		return false;
		}
	var bobot_j = document.getElementById('bobot_j');
		if((bobot_j.value==null)||(bobot_j.value=="")){
		alert("Masukan bobot jabatan");
		return false;
		}
	var bobot_k = document.getElementById('bobot_k');
		if((bobot_k.value==null)||(bobot_k.value=="")){
		alert("Masukan bobot kepemimpinan");
		return false;
		}
	var bobot_t = document.getElementById('bobot_t');
		if((bobot_t.value==null)||(bobot_t.value=="")){
		alert("Masukan bobot teknis");
		return false;
		}
	var str0  = tanggal.value;
	var str1  = proyek_mulai.value;
	var str2  = proyek_selesai.value;
	var dt0   = parseInt(str0.substring(0,2),10); 
	var mon0  = parseInt(str0.substring(3,5),10);
	var yr0   = parseInt(str0.substring(6,10),10); 
	var dt1   = parseInt(str1.substring(0,2),10); 
	var mon1  = parseInt(str1.substring(3,5),10);
	var yr1   = parseInt(str1.substring(6,10),10); 
	var dt2   = parseInt(str2.substring(0,2),10); 
	var mon2  = parseInt(str2.substring(3,5),10); 
	var yr2   = parseInt(str2.substring(6,10),10); 
	var date0 = new Date(yr0, mon0, dt0); 
	var date1 = new Date(yr1, mon1, dt1); 
	var date2 = new Date(yr2, mon2, dt2); 
	
        if ( date2 <= date0 && date1 <= date0) ){
			 alert("tanggal Mulai proyek dan akhir proyek harus melebihi tanggal kegiatan....! "); 
			 return false;
        }
		
		if ( date2 <= date1 ){
			 alert("tanggal Mulai proyek harus melebihi tanggal selesai proyek....! "); 
			 return false;
        }
		
	var p = parseInt(bobot_p.value);
	var i = parseInt(bobot_i.value);
	var j = parseInt(bobot_j.value);
	var k = parseInt(bobot_k.value);
	var t = parseInt(bobot_t.value);
	var allDataBobot = (p+i+j+k+t);
		if (allDataBobot <= 100){
			alert("Nilai bobot Harus lebih dari 100....! ");
			return false;
		}	 
	
}
	
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jacs.js"></script>

<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="kegiatan_form" action="<?php echo $form_action; ?>" onsubmit="return validate()" method="post" >
	<input type="hidden" class="form_field" name="id_kegiatan" size="30" value="<?php echo set_value('id_kegiatan', isset($default['id_kegiatan']) ? $default['id_kegiatan'] : ''); ?>" />
	<?php echo form_error('id_kegiatan', '<p class="field_error">', '</p>');?>
	
	<p><label for="nama">Nama :</label>
	<textarea rows="2" cols="40" name="nama" value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>"></textarea></p>
			
	<p><label for="instansi">Instansi :</label>
	<textarea rows="2" cols="40" name="instansi" value="<?php echo set_value('instansi', isset($default['instansi']) ? $default['instansi'] : ''); ?>"></textarea></p>

	<p><label for="tanggal">Tanggal:</label>
	<input type="text" class="form_field" name="tanggal" id="tanggal" size="20" value="<?php echo set_value('tanggal', isset($default['tanggal']) ? $default['tanggal'] : ''); ?>" />
	<a href=# onclick=JACS.show(document.forms[0].elements['tanggal'],event);>
	<img src="<?php echo base_url(); ?>assets/css/images/calendar.png" alt="calendar" border="0"></a></p>
	
	<p><label for="proyek_mulai">Tgl Mulai Proyek:</label>
	<input type="text" class="form_field" name="proyek_mulai" id="proyek_mulai" size="20" value="<?php echo set_value('proyek_mulai', isset($default['proyek_mulai']) ? $default['proyek_mulai'] : ''); ?>" />
	<a href=# onclick=JACS.show(document.forms[0].elements['proyek_mulai'],event);>
	<img src="<?php echo base_url(); ?>assets/css/images/calendar.png" alt="calendar" border="0"></a></p>
	
	<p>	<label for="proyek_selesai">Tgl Selesai Proyek:</label>
	<input type="text" class="form_field" name="proyek_selesai" id="proyek_selesai" size="20" value="<?php echo set_value('proyek_selesai', isset($default['proyek_selesai']) ? $default['proyek_selesai'] : ''); ?>" />
	<a href=# onclick=JACS.show(document.forms[0].elements['proyek_selesai'],event);>
	<img src="<?php echo base_url(); ?>assets/css/images/calendar.png" alt="calendar" border="0"></a></p>
	
	<p><label for="note">Note :</label><input type="text" class="form_field" name="note" id="note" size="20" value="<?php echo set_value('note', isset($default['note']) ? $default['note'] : ''); ?>" /></p>
	
	<p>
		<label for="id_asesor">Team Leader:</label>
        <?php echo form_dropdown('id_asesor', $options_teamleader, isset($default['id_asesor']) ? $default['id_asesor'] : ''); ?>
	</p>
	
	<p><label for="bobot_p">% Potensi :</label>
	<input type="text" class="form_field" name="bobot_p" id="bobot_p" size="4" value="<?php echo set_value('bobot_p', isset($default['bobot_p']) ? $default['bobot_p'] : ''); ?>" /></p>
	
	<p><label for="bobot_i">% Komp. Inti :</label>
	<input type="text" class="form_field" name="bobot_i" id="bobot_i" size="4" value="<?php echo set_value('bobot_i', isset($default['bobot_i']) ? $default['bobot_i'] : ''); ?>" /></p>
	
	<p><label for="bobot_j">% Komp. Jabatan :</label>
	<input type="text" class="form_field" name="bobot_j" id="bobot_j" size="4" value="<?php echo set_value('bobot_j', isset($default['bobot_j']) ? $default['bobot_j'] : ''); ?>" /></p>
	
	<p><label for="bobot_k">% Komp. Kepemimpinan :</label>
	<input type="text" class="form_field" name="bobot_k" id="bobot_k" size="4" value="<?php echo set_value('bobot_k', isset($default['bobot_k']) ? $default['bobot_k'] : ''); ?>" /></p>
	
	<p><label for="bobot_t">% Komp. Teknis :</label>
	<input type="text" class="form_field" name="bobot_t" id="bobot_t" size="4" value="<?php echo set_value('bobot_t', isset($default['bobot_t']) ? $default['bobot_t'] : ''); ?>" /></p>
	<hr>
	<ol>
	
	<?php foreach ($group_skor as $key => $value) {
		echo "<li><strong>".$value->nama."</strong></li>";
		$skor = $this->model_skor->search('id_group_skor',$value->id_group_skor,'skor');
		foreach ($skor as $key1 => $value1) {
			 //$this->helper_model->printr($value1);
			echo '<p><label for="skor['.$value1->id_skor.']">'.$value1->nama.'</label><input type="checkbox" class="form_field" name="skor['.$value1->id_skor.']" value="" /></p><br>';
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