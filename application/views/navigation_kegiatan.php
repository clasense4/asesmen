<ul id="menu_tab">	
	<li id="tab_kegiatan"><?php echo anchor('kegiatan', 'Kegiatan');?></li>
	<li id="tab_asesor"><?php echo anchor('asesor', 'Asesor');?></li>
	<li id="tab_kelas"><?php echo anchor('skor', 'Skor');?></li>
	<li id="tab_kelas"><?php echo anchor('user', 'User');?></li>
	<li id="tab_logout"><?php echo anchor('login/process_logout', 'Logout', array('onclick' => "return confirm('Anda yakin akan logout?')"));?></li>
</ul>
