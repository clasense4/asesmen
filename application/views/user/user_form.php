<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="user_form" method="post" action="<?php echo $form_action; ?>">
	<p>
		<label for="id">Id user:</label>
		<input type="text" class="form_field" name="id_user" size="30" value="<?php echo set_value('id_user', isset($default['id_user']) ? $default['id_user'] : ''); ?>" />
	</p>
	<?php echo form_error('id_user', '<p class="field_error">', '</p>');?>
	
	<p>
		<label for="username">username user:</label>
		<input type="text" class="form_field" name="username" size="50" value="<?php echo set_value('username', isset($default['username']) ? $default['username'] : ''); ?>" />
		
	</p>
	<?php echo form_error('username', '<p class="field_error">', '</p>');?>	
	
	<p>
		<label for="password">Password:</label>
		<input type="text" class="form_field" name="password" size="50" value="<?php echo set_value('password', isset($default['password']) ? $default['password'] : ''); ?>" />
		
	</p>
	<?php echo form_error('password', '<p class="field_error">', '</p>');?>

	
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
