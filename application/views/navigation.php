<ul id="menu_tab">
	<li id="tab_alur"><?php echo anchor('alur', 'Alur');?></li>
	<li id="tab_kegiatan"><?php echo anchor('kegiatan', 'Kegiatan');?></li>
	<li id="tab_hasil"><?php echo anchor('hasil/index/'.$id_kegiatan, 'Penilaian');?></li>
	<li id="tab_laporan"><?php echo anchor('laporan', 'Laporan');?></li>
	<li id="tab_asesi"><?php echo anchor('asesi/index/'.$id_kegiatan, 'Asesi');?></li>
	<li id="tab_logout"><?php echo anchor('login/process_logout', 'Logout', array('onclick' => "return confirm('Anda yakin akan logout?')"));?></li>
</ul>