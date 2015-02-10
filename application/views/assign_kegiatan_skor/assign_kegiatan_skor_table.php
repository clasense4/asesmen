	<ol>
	<?php
	foreach ($group_skor as $keys => $values) {
		echo "<h1>".$values->nama."</h1>";
		foreach ($skor as $key => $value) {
			if ($values->id_group_skor == $value->id_group_skor) {
			echo '<p><label for="skor['.$value->id_skor.']">'.$value->nama.'</label>
			<input type="text" class="form_field" name="skor['.$value->id_skor.']" size="1" value="" /></p><br>';
			}
		}
		echo "<hr>";
	}
	?>
	</ol>