<?php $this->load->view('/public/helper/head.php'); ?>
	<?php $this->load->view('/public/helper/main_menu.php'); ?>
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="span12 titulos">
					<h2 class="principal"><span>Contacto</span></h2>
				</div>
				<div class="row-fluid">
						<div class="span9">
						<div class="left-linea">
							<h3 class="acervo">Guadalajara</h3>
							<p class="linesspearator">Octavio de Alva<br>
							Av. Patria 555A-1<br>
							Jardines Universidad 45110<br>
							Zapopan, Jalisco<br>
							<b>Tel: 33 31106626</b><br>
							<b>Tel: 33 36736195</b><br>
							e-mail: miguel.sanz@grupolighting.com.mx<br>
							</p>					
						</div>
						<div class="left-linea sin">	
							<h3 class="acervo">Representante Veracruz y Puebla</h3>
							<p class="linesspearator">Rosaura Basarte<br>
							<b>Tel: (229) 9312553</b><br>
							<b>Cel: (229) 2509575</b><br>
							Mail: rosauraventas@grupolighting.com.mx<br>
							</p>
						</div>
						<div class="left-linea">
						<h3 class="acervo">Ciudad de México</h3>
							<p class="linesspearator">
								Epsilon # 235 <br>
								Romero de Terreros CP 04310<br>
								 México, D.F. <br>
								<b>Tel: (55) 5339 1470 </b><br>
								<b>Fax: (55) 5554 5552 </b><br>
								<b>Lada: 01800 720 0070</b>
							</p>
						</div>
						<div class="left-linea sin">
							<h3 class="acervo">Riviera Maya</h3>
							<p class="linesspearator">
								Constituyentes entre 105 y 110 Av Nte. <br>
								Playa del Carmen  Cancún, Q. Roo <br>
								EDO. DE MÉXICO <br>
								<b>Tel: (984) 803-9803 <br>
								Fax: (984) 859-2727</b><br>
								Mail: lourdesventas@grupolighting.com.mx
							</p>
						</div>
					</div>
					<div class="span3 bordertop">
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
	<?php $this->load->view('public/helper/footer.php'); ?>
	</body>
</html>
