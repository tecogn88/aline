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
					<?php echo form_open_multipart(base_url('panel/slider/nuevoSlide')); ?>
					<div class="row-fluid">
						<div class="well">
							<div class="span8">
								<h2>Agregar nuevo slide</h2>
							</div>
							<a href="<?php echo base_url('panel/slider/'); ?>" class="btn btn-danger" style="float:right;margin-left:10px;">Cancelar<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a>
							<button style="margin-left:10px;float:right;" class="btn btn-primary" name="btnGuardar" onclick="submit">Agregar<span style='float:right;margin-left:10px;'><i class='icon-plus icon-white'></i></span></button>
							<!-- <a id="btn_crea_banner" class="btn btn-primary" href="<?php echo base_url('panel/slider/nuevoSlide'); ?>" style="float:right;margin-left:10px;">Nuevo slide</a> -->
						</div>
					</div>
					<div class="well">
						<div class="row-fluid">
							<div class="span3">
								<?php
								echo form_label('Nombre', 'nombre');
								echo form_input('nombre', set_value('nombre'));
								echo form_error('nombre');
								echo form_label('Link', 'link');
								echo form_input('link', set_value('link'));
								echo form_label('Imagen', 'imagen');
								echo form_upload('imagen'); ?>
							</div>
							<div class="span8">
								<?php echo form_label('Texto', 'descripcion');
								echo form_textarea('descripcion', set_value('descripcion')); ?>
							</div>
						</div>
					</div>
					<?php echo form_close(); 
					?>
				</div>
			</div>
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
	<!-- End div class="wrapper container" -->
<script type="text/javascript"></script>
</body>
</html>
