<div id="smoothmenu1">
<ul>
	<li id="tab_kegiatan"><?php echo anchor('kegiatan', 'Kegiatan');?></li>
	<li id="tab_hasil"><?php echo anchor('hasil', 'Hasil Asesmen');?></li>
	<li id="tab_laporan"><?php echo anchor('laporan', 'Laporan');?></li>
	<li id="tab_asesi"><?php echo anchor('asesi', 'Asesi');?></li>
	<li id="tab_asesor"><?php echo anchor('asesor', 'Asesor');?></li>
	<li id="tab_kelas"><?php echo anchor('user', 'User');?></li>
	<li id="tab_logout"><?php echo anchor('login/process_logout', 'Logout', array('onclick' => "return confirm('Anda yakin akan logout?')"));?></li>
</ul>

</div>					