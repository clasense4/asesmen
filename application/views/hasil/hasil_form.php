<script type="text/javascript">
function setNamaAsesi(){
    var x = document.getElementById("no_asesi").value;
	var data = x.split("|");
	var namaAsesi = data[0];
	var noAsesi = data[1];
    document.getElementById("nama").value = namaAsesi;
	document.getElementById("no_asesi").value = noAsesi;
}
</script>

<?php 
echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

$flashmessage = $this->session->flashdata('message');
echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="asesi_form" method="post" action="<?php echo $form_action; ?>">
	<input type="hidden" class="form_field" name="id_penilaian" size="30" value="<?php echo set_value('id_penilaian', isset($default['id_penilaian']) ? $default['id_penilaian'] : ''); ?>" />
	<input type="hidden" class="form_field" name="id_kegiatan" value="<?php echo $id_kegiatan ; ?>" />
	
	<p>
		<label for="no_peserta">Nomor Asesi :</label>
		<?php echo form_dropdown('no_asesi', $options_asesi, isset($default['no_asesi']) ? $default['no_asesi'] : '', 'id="no_asesi" onchange="setNamaAsesi();"'); ?>
	<p>
		<label for="asesi">Nama Asesi :</label>
        <input type="text" class="form_field" name="nama" id="nama" size="30" required disabled value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" />
	</p>
	<hr>
	
	<?php foreach ($group_skor as $keys => $values) {
		echo "<h1><b>".$values->nama."</b></h1>";
		foreach ($skor as $key => $value) {
			if ($values->id_group_skor == $value->id_group_skor) {
			
			echo '<p>
				<label for="skor['.$value->id_skor.']">'.$value->nama.'</label>
				<input type="number" class="form_field" name="'.$value->id_skor.'" size="1" value="" required />
			</p><br>';
			}
	
		}
		echo '<p>
				<label for="skor['.$values->id_group_skor.']">Uraian '.$values->nama.'</label>
				<textarea rows="4" cols="30" name="uraian'.$values->id_group_skor.'" value=""></textarea>
			</p><br>';
		echo "<hr>";
	}?>
	
	<p><label for="simpulan">Simpulan :</label>
	<textarea rows="4" cols="30" name="simpulan" value="<?php echo set_value('simpulan', isset($default['simpulan']) ? $default['simpulan'] : ''); ?>"></textarea></p>
	<hr>
		
	<p><label for="saran">Saran :</label>
	<textarea rows="4" cols="30" name="saran" value="<?php echo set_value('saran', isset($default['saran']) ? $default['saran'] : ''); ?>"></textarea></p>
		
	<hr>
	<p>
		<label for="asesor">Nomor Asesor :</label>
		
        <?php echo form_dropdown('asesor',  $options_asesor, isset($default['asesor']) ? $default['asesor'] : '', 'id="asesor" onchange="setNamaAsesor();"'); ?>
	</p>
	<hr>
	
	<p>
		<input type="submit" name="submit" id="submit" value=" Simpan " />
	</p>
</form>

<a href="#" onclick="history.back();return false;" onmouseover="this.style.cursor='pointer'" style="cursor: pointer;" class="back">Kembali</a>
