<?php $this->load->view('/public/helper/head.php'); ?>
	<?php $this->load->view('/public/helper/logo.php'); ?>
	<?php if ($menu_top) { $this->load->view('/public/helper/menus/menu_top.php'); } ?>
	<?php if ($menu_nav == TRUE) { $this->load->view('/public/helper/menus/menu_nav.php'); } ?>
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="span12 titulos">
					<h2 class="principal"><span>Contacto</span></h2>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<h2>Contáctenos</h2>
						<form>
							<fieldset>
						  <p><h3><b>Muchas gracias!</b></h3></p><p><?=$this->configuration->titulo?> le agradece por habernos contactado.<br />Muy pornto tendrá noticias de nosotros.</p>
						  <a class="btn" href="<?php echo base_url('contacto') ?>">Regresar</a>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if ($menu_footer == TRUE) { $this->load->view('/public/helper/menus/menu_footer.php'); } ?>
	<?php $this->load->view('public/helper/footer.php'); ?>
	</body>
</html>
