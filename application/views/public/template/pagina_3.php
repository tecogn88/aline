<?php $this->load->view('/public/helper/head.php'); ?>
<?php $this->load->view('/public/helper/logo.php'); ?>
<?php if ($menu_top) { $this->load->view('/public/helper/menus/menu_top.php'); } ?>
<?php if ($menu_nav == TRUE) { $this->load->view('/public/helper/menus/menu_nav.php'); } ?>	
<div class="container">
	<div class="row">
		<div class="titulos">
			<h2 class="principal"><span><?=$pagina->titulo;?></span></h2>
		</div>	
	</div>	
	<div class="row">	
			<?php if ($pagina->imagen != '' && strlen($pagina->imagen) > 5): ?>
			<img src="<?php echo base_url('assets/img/'.$pagina->imagen); ?>">
			<?php endif ?>
			<p><?=$pagina->contenido;?></p>
	</div>
</div>
<?php if ($menu_footer == TRUE) { $this->load->view('/public/helper/menus/menu_footer.php'); } ?>
<?php $this->load->view('public/helper/footer.php'); ?>
</body>
</html>
