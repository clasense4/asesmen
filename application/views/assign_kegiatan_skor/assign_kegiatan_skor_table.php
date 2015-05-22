	<ol>
	<?php 
	foreach ($group_skor as $keys => $values) {
		echo "<h1>".$values->nama."</h1>";
		foreach ($skor as $key => $value) {
			if ($values->id_group_skor == $value->id_group_skor) {
			echo '<p>
				<label for="skor['.$value->id_skor.']">'.$value->nama.'</label>
				<input type="text" class="form_field" name="skor['.$value->id_skor.']" size="1" value="" />
			</p><br>';
			}
	
		}
			echo '<p>
				<label for="skor['.$values->id_group_skor.']">Uraian '.$values->nama.'</label>
				<textarea type="text" class="form_field" name="uraian" size="35" value="" />
			</p><br>';
		echo "<hr>";
	}
	// foreach ($skor as $key => $value) {
	// 	// $this->helper_model->printr($value);
	// 	// echo "<li><strong>".$value->nama."</strong></li>";
	// 	echo '<p><label for="skor['.$value->id_skor.']">'.$value->nama.'</label><input type="text" class="form_field" name="skor['.$value->id_skor.']" size="1" value="" /></p><br>';
	// 	// foreach ($skor as $key1 => $value1) {
	// 	// 	$this->helper_model->printr($skor);
	// 	// 	// echo '<p><label for="skor['.$value1->id_skor.']">'.$value1->nama.'</label><input type="text" class="form_field" name="skor['.$value1->id_skor.']" size="1" value="" /></p><br>';
	// 	// }
	// 	// echo "<hr>";
	// } 
	?>
	</ol>