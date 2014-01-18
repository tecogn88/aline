<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
		<!-- Display messages -->
		<?php if(isset($success)){ ?>
			<div class="row-fluid">
				<div class="span12 alert alert-success">
					<?php echo $success; ?>
				</div>
			</div>
		<?php } ?>
		<?php if(isset($error)){ ?>
			<div class="row-fluid">
				<div class="span12 alert alert-error">
					<?php echo $error; ?>
				</div>
			</div>
		<?php } ?>
		<!-- Fin display messages -->
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<?php echo $columna_izq; ?>					
				</aside>
				<div id="body_content" class="span10 panel_usuarios">
					<form action="<?php echo base_url('panel/slider/GuardaConfiguracion'); ?>" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="row-fluid">
						<div class="well">
							<div class="span8">
								<h2>Configuracion del slider</h2>
							</div>
							<a href="<?php echo base_url('panel/slider/'); ?>" class="btn btn-danger" style="float:right;margin-left:10px;">Terminar<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a>
							<button style="margin-left:10px;float:right;" class="btn btn-primary" name="btnGuardar" onclick="submit">Guardar configuración<span style='float:right;margin-left:10px;'><i class='icon-plus icon-white'></i></span></button>
							<!-- <a id="btn_crea_banner" class="btn btn-primary" href="<?php echo base_url('panel/slider/nuevoSlide'); ?>" style="float:right;margin-left:10px;">Nuevo slide</a> -->
						</div>
					</div>
					<div class="well">
						<div class="row-fluid">
					  		<div class="span3">
							  	<label><h5>
							  		Ancho
							  	</h5></label>
							  	<input type="text" name="slider_ancho" value="<?=$slider_ancho?>">
							  	<label><h5>
							  		Alto
							  	</h5></label>
							  	<input type="text" name="slider_alto" value="<?=$slider_alto?>">
							  	<label><h5>
							  		Automatico
							  	</h5></label>
							  	<?php $sel = ''; $sel1 = '';
							  	if ($auto == 'true') {
							  		$sel = 'selected';
							  	}else{
							  		$sel1 = 'selected';
							  	}
							  	?>
							  	<select name="auto" id="auto">
									<option value="true" <?=$sel?>>Si</option>
									<option value="false" <?=$sel1?>>No</option>
								</select>
							</div>
							<div class="span4">
								<label><h5>
									Velocidad del efecto<small>(en milisegundos, 1000 = 1 segundo)</small>
								</h5></label>
								<input type="text" name="velocidad" value="<?=$velocidad?>">
								<label><h5>
							  		Rotacion infinita
							  	</h5></label>
							  	<?php $inf = ''; $inf1 = '';
							  	if ($infinito == 'true') {
							  		$inf = 'selected';
							  	}else{
							  		$inf1 = 'selected';
							  	}
							  	?>
							  	<select name="infinito" id="infinito">
									<option value="true" <?=$inf?>>Si</option>
									<option value="false" <?=$inf1?>>No</option>
								</select>
								<label><h5>Iniciar en el slide</h5></label>
								<?php $slides = $this->db->count_all('slider'); ?>
								<small>(Existen <?=$slides?> slides)<br>el slide1 corresponde al número 0</small><br>
								<input type="text" name="slide_i" value="<?=$slide_i?>">
							</div>
							<div class="span4">
								<label><h5>
							  		Aleatorio
							  	</h5></label>
							  	<?php $alea = ''; $alea1 = '';
							  	if ($aleatorio == 'true') {
							  		$alea = 'selected';
							  	}else{
							  		$alea1 = 'selected';
							  	}
							  	?>
							  	<select name="aleatorio" id="aleatorio">
									<option value="true" <?=$alea?>>Si</option>
									<option value="false" <?=$alea1?>>No</option>
								</select>
								<label><h5>
							  		Mostrar controles
							  	</h5></label>
							  	<?php $cont = ''; $cont1 = '';
							  	if ($controles == 'true') {
							  		$cont = 'selected';
							  	}else{
							  		$cont1 = 'selected';
							  	}
							  	?>
							  	<select name="controles" id="controles">
									<option value="true" <?=$cont?>>Si</option>
									<option value="false" <?=$cont1?>>No</option>
								</select>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
	<!-- End div class="wrapper container" -->
<script type="text/javascript"></script>
</body>
</html>
