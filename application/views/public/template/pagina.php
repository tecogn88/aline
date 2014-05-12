<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title><?=$pagina->m_titulo;?></title>
	<meta name="description" content="<?=$pagina->m_descripcion;?>" />
	<?php $this->load->view('/public/helper/metadata_principal.php');?>
</head>
<body>
<?php $this->load->view('/public/helper/logo.php'); ?>
<?php if ($menu_top) { $this->load->view('/public/helper/menus/menu_top.php'); } ?>
<?php if ($menu_nav == TRUE) { $this->load->view('/public/helper/menus/menu_nav.php'); } ?>	
	<div id="fondo">
		<div id="back-wrapper" class="container">
			<div id="home-wrapper" class="span12">
				<div id="contenido-txt"> 
					<h2><?=$pagina->titulo;?></h2>	
					<?=$pagina->contenido;?>
				</div>  
				<div id="banners-hor">
					<?php //$this->load->view('/public/helper/banners'); ?>
				</div>
			</div>
		</div>
		<!-- Le main content -->
	<div>
	<section>
		<article></article>
	</section>
	<!-- Le sidebar -->
	<aside></aside>
</div>
<div id="footer-wrapper"></div>		
<!-- Le footer && Javascript files -->
<!-- ******************************************* -->
<!-- Le head.php  ==> location: application/views/public/helper/footer.php -->
<?php if ($menu_footer == TRUE) { $this->load->view('/public/helper/menus/menu_footer.php'); } ?>
<?php $this->load->view('public/helper/footer.php'); ?>
<!-- ******************************************* -->
<script type="text/javascript">
$('#myCarousel').carousel();
//$('.dropdown-toggle').dropdown();
</script>
</body>
</html>
