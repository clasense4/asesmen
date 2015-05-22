<?php

	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';
	
	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
	
	echo anchor('hasil/hasildataxls/'.$id_kegiatan, 'Download Excel', array('class' => 'excel')).' | '.
	anchor('hasil/hasildatapdf/'.$id_kegiatan, 'Download Pdf', array('class' => 'pdf'));
	echo "<br> <br>";
	
	echo ! empty($pagination) ? '<p id="pagination">' . $pagination . '</p>' : '';
	echo ! empty($table) ? $table : '';
	
	if ( ! empty($link))
	{
		echo '<p id="bottom_link">';
		foreach($link as $links)
		{
			echo $links . ' ';
		}
		echo '</p>';
	}
