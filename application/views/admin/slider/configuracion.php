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
						<?php echo $this->session->flashdata('warning'); ?>
					</div>
					<div class="well">
						<div class="row-fluid">
					  		<div class="span3">
							  	<label><h4>Ancho</h4></label>
							  	<input type="text" name="slider_ancho" value="<?=$slider_ancho?>">
							  	<label><h4>Alto</h4></label>
							  	<input type="text" name="slider_alto" value="<?=$slider_alto?>">
							</div>
							<div class="span3">
								<label><h4>Velocidad de efecto <small>(en milisegundos)</small></h4></label>
								<input type="text" name="velocidad" value="<?=$velocidad?>">
								<?php $slides = $this->db->count_all('slider'); ?>
								<label><h4>Slide inicial <small>(Hay <?=$slides?> slides)</small></h4></label>
								<input type="text" name="slide_i" value="<?=$slide_i?>">
							</div>
							<div class="span3">
							  	<label><h4>Automatico</h4></label>
							  	<div class="btn-group" data-toggle="buttons-radio">
									<?php $checado_auto = ''; $checado_auto1 = ''; if ($auto == 1) {$checado_auto1 = 'active';}else{$checado_auto = 'active';} ?>
								  <button id='auto_si' type="button" class="btn btn-inverse <?php echo $checado_auto1 ?>"><i id='icon_auto_si' class="icon-ok icon-white"></i></button>
								  <button id='auto_no' type="button" class="btn btn-inverse <?php echo $checado_auto ?>"><i id='icon_auto_no' class="icon-ban-circle icon-white"></i></button>
								</div>
								<input name="auto" id="auto" type="hidden" value="<?php echo $auto ?>">
								<label><h4>Rotacion infinita</h4></label>
								<div class="btn-group" data-toggle="buttons-radio">
									<?php $checado_inf = ''; $checado_inf1 = ''; if ($infinito == 1) {$checado_inf1 = 'active';}else{$checado_inf = 'active';} ?>
								  <button id='inf_si' type="button" class="btn btn-inverse <?php echo $checado_inf1 ?>"><i id='icon_inf_si' class="icon-ok icon-white"></i></button>
								  <button id='inf_no' type="button" class="btn btn-inverse <?php echo $checado_inf ?>"><i id='icon_inf_no' class="icon-ban-circle icon-white"></i></button>
								</div>
								<input name="infinito" id="infinito" type="hidden" value="<?php echo $infinito ?>">
							</div>
							<div class="span3">
								<label><h4>Aleatorio</h4></label>
								<div class="btn-group" data-toggle="buttons-radio">
									<?php $checado_ale = ''; $checado_ale1 = ''; if ($aleatorio == 1) {$checado_ale1 = 'active';}else{$checado_ale = 'active';} ?>
								  <button id='alea_si' type="button" class="btn btn-inverse <?php echo $checado_ale1 ?>"><i id='icon_alea_si' class="icon-ok icon-white"></i></button>
								  <button id='alea_no' type="button" class="btn btn-inverse <?php echo $checado_ale ?>"><i id='icon_alea_no' class="icon-ban-circle icon-white"></i></button>
								</div>
								<input name="aleatorio" id="aleatorio" type="hidden" value="<?php echo $aleatorio ?>">
								<label><h4>Mostrar controles</h4></label>
								<div class="btn-group" data-toggle="buttons-radio">
									<?php $checado_ctrls = ''; $checado_ctrls1 = ''; if ($controles == 1) {$checado_ctrls1 = 'active';}else{$checado_ctrls = 'active';} ?>
								  <button id='ctrls_si' type="button" class="btn btn-inverse <?php echo $checado_ale1 ?>"><i id='icon_ctrls_si' class="icon-ok icon-white"></i></button>
								  <button id='ctrls_no' type="button" class="btn btn-inverse <?php echo $checado_ale ?>"><i id='icon_ctrls_no' class="icon-ban-circle icon-white"></i></button>
								</div>
								<input name="controles" id="controles" type="hidden" value="<?php echo $controles ?>">
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
	<!-- End div class="wrapper container" -->
<script type="text/javascript">
	$(document).on("ready",function(){
		$( "#cambio" ).delay(3500).slideUp('slow');

		if($('#auto').val() == 1){$('#icon_auto_no').removeClass('icon-white');}
		else{$('#icon_auto_si').removeClass('icon-white');}
		if($('#infinito').val() == 1){$('#icon_inf_no').removeClass('icon-white');}
		else{$('#icon_inf_si').removeClass('icon-white');}
		if($('#aleatorio').val() == 1){$('#icon_alea_no').removeClass('icon-white');}
		else{$('#icon_alea_si').removeClass('icon-white');}
		if($('#controles').val() == 1){$('#icon_ctrls_no').removeClass('icon-white');}
		else{$('#icon_ctrls_si').removeClass('icon-white');}
	});
	$("#auto_si").on("click",function(){$("#auto").val(1);$('#icon_auto_no').removeClass('icon-white');$('#icon_auto_si').addClass('icon-white');});
	$("#auto_no").on("click",function(){$("#auto").val(0);$('#icon_auto_si').removeClass('icon-white');$('#icon_auto_no').addClass('icon-white');});
	$("#inf_si").on("click",function(){$("#infinito").val(1);$('#icon_inf_no').removeClass('icon-white');$('#icon_inf_si').addClass('icon-white');});
	$("#inf_no").on("click",function(){$("#infinito").val(0);$('#icon_inf_si').removeClass('icon-white');$('#icon_inf_no').addClass('icon-white');});
	$("#alea_si").on("click",function(){$("#aleatorio").val(1);$('#icon_alea_no').removeClass('icon-white');$('#icon_alea_si').addClass('icon-white');});
	$("#alea_no").on("click",function(){$("#aleatorio").val(0);$('#icon_alea_si').removeClass('icon-white');$('#icon_alea_no').addClass('icon-white');});
	$("#ctrls_si").on("click",function(){$("#controles").val(1);$('#icon_ctrls_no').removeClass('icon-white');$('#icon_ctrls_si').addClass('icon-white');});
	$("#ctrls_no").on("click",function(){$("#controles").val(0);$('#icon_ctrls_si').removeClass('icon-white');$('#icon_ctrls_no').addClass('icon-white');});
</script>
</body>
</html>
