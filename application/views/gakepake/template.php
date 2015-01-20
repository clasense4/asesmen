<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Sistem Penilaian Potensi dan Kompetensi</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link href="<?php echo base_url() ?>css/images/icon.png" rel="shortcut icon" />
	
	<!-- js -->
	<script src="<?php echo base_url().'development-bundle/jquery-1.3.2.js' ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'development-bundle/ui/ui.core.js' ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'development-bundle/ui/ui.datepicker.js' ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'development-bundle/ddsmoothmenu.js' ?>" type="text/javascript"></script>
	<!-- css -->
	<link href="<?php echo base_url() ?>css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url().'development-bundle/themes/base/ui.all.css' ?>" rel="stylesheet" type="text/css"  />
	<link href="<?php echo base_url().'development-bundle/ddsmoothmenu.css' ?>" rel="stylesheet" type="text/css"  />
	
	

	<script type="text/javascript">
		$(document).ready(function(){
			$("#tanggal").datepicker({
				changeMonth : true,
				changeYear	: true,
				dateFormat:"yy/mm/dd"
			});
		});
		
	</script>
	
	
	<script src="<?php //echo base_url().'js/jquery.jcarousel.min.js';?>"  type="text/javascript" charset="utf-8"></script>
	<script src="<?php //echo base_url().'js/functions.js';?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<!-- Begin Wrapper -->
	<div id="wrapper">
		<!-- Begin Shell -->
		<div class="shell">
			<div id="top"></div>
			<!-- Begin Main -->
			<div id="main">
				<!-- Begin Inner -->
				<div class="inner">
					<!-- Begin Header -->
					<div id="header">
						<h1 id="logo"><a class="notext" href="#" title="asesmen">Asessment Center</a></h1>
					</div>
					<!-- End Header -->
					<!-- Begin Navigation -->
					<!--<div id="navigation"> -->
						<?php $this->load->view('navigation'); ?> <br>
				<!--</div>-->
					<!-- End Navigation -->
					<!-- Begin Testimonial --
					<div id="testimonial">
						<h4>&ldquo;Memberikan pelayanan terbaik untuk tercapainya kepuasan pelanggan dengan jaminan kualitas pekerjaan, kecepatan, ketepatan dan harga yang kompetitif.&rdquo;</h4>
					</div>
					<!-- End Testimonial -->
					<!-- Begin Main -->
					<div id="content">
						<?php isset($main_view)?$this->load->view($main_view):"";?>
						<?php echo isset($custom_view)?$custom_view:""; ?>
					</div>
					<!-- End Content -->
				</div>
				<!-- End Inner -->
			</div>
			<!-- End Main -->
			<div id="bottom">&nbsp;</div>
			<!-- Begin Footer -->
			<div id="footer">
				<?php $this->load->view('footer'); ?>
			</div>
			<!-- End Footer -->
		</div>
		<!-- End Shell -->
	</div>
	<!-- End Wrapper -->
</body>
<script type="text/javascript">
ddsmoothmenu.init({
 mainmenuid: "smoothmenu1", //menu DIV id
 orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
 classname: 'ddsmoothmenu', //class added to menu's outer DIV
 customtheme: ["#E8DCB5", "#C9B381"],
 contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});	
</script>

</html>