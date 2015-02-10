<?php 
echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

$flashmessage = $this->session->flashdata('message');
echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="asesi_form" method="post" action="<?php echo $form_action; ?>">
	<input type="hidden" class="form_field" name="id_hasil" size="30" value="<?php echo set_value('id_hasil', isset($default['id_hasil']) ? $default['id_hasil'] : ''); ?>" />
	<?php echo form_error('id_hasil', '<p class="field_error">', '</p>');?>
	<p>
		<label for="kegiatan">Kegiatan :</label>
		<?php $js = 'id="kegiatan-change" onChange=""'; ?>
        <?php echo form_dropdown('kegiatan', $options_kegiatan, isset($default['kegiatan']) ? $default['kegiatan'] : '', $js); ?>
        <!-- <div id="add-asesi">Add Asesi</div> -->
	</p>
	<p>
		<label for="asesi">asesi :</label>
        <?php echo form_dropdown('asesi', $options_asesi, isset($default['asesi']) ? $default['asesi'] : ''); ?>
	</p>
	<p>
		<label for="asesor">asesor :</label>
        <?php echo form_dropdown('asesor', $options_asesor, isset($default['asesor']) ? $default['asesor'] : ''); ?>
	</p>
	<hr>
	<div id="result"></div>
	<div id="result2-container"></div>
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
<script>
    $(document).ready(function() {
		$("#kegiatan-change").bind("change", function() {
			var id_kegiatan = $(this).val();
			// console.log('clear');
			$( "#result" ).load( "<?php echo base_url(). "index.php/assign_kegiatan_skor/add/"; ?>" + id_kegiatan );
			// $( "#result" ).empty();
			// $( "#result2-container" ).empty();
		});
		// $("#add-asesi").bind("click", function() {
		// 	var id_kegiatan = $('#kegiatan-change').val();
		// 	console.log("execute " + id_kegiatan);
		// 	var data = $( "#result2-container" ).load( "<?php echo base_url(). "index.php/assign_kegiatan_skor/add/"; ?>" + id_kegiatan ).html();
		// 	console.log(data);
		// 	$(data).appendTo("#result");
		// 	// $( "#result2-container" ).remove();
		// });
    });
</script>