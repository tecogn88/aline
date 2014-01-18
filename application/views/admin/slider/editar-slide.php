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
					<?php echo form_open_multipart('panel/slider/editaSlide/'.$slide->id); ?>
					 <div class="row-fluid">
						<div class="well">
							<div class="span8">
								<h2>Edición de slide <small>edita la información e imagen del slide</small></h2>
							</div>
							<a href="<?php echo base_url('panel/slider/'); ?>" class="btn btn-danger" style="float:right;margin-left:10px;">Cancelar<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a>
							<!-- <a id="btn_crea_banner" class="btn btn-warning" href="<?php echo base_url('panel/slider/nuevoSlide'); ?>">Nuevo slide</a> -->
							 <button style="margin-left:10px;float:right;" class="btn btn-primary" name="btnGuardar" onclick="submit">Actualizar<span style='float:right;margin-left:10px;'><i class='icon-ok-sign icon-white'></i></span></button>
						</div>
					</div> 
					<div class="well">
						<div class="row-fluid">
							<div class="span3">
							<?php
								echo form_label('Nombre', 'nombre');
								echo form_input('nombre', set_value('nombre',$slide->nombre));
								echo form_label('Link', 'link');
								echo form_input('link', set_value('link',$slide->link));
								echo form_label('Texto', 'descripcion');
								echo form_textarea('descripcion', set_value('descripcion',$slide->descripcion));?>
							</div>
							<div class="span8">
								<?php 
								echo form_label('Texto de liga', 't_link');
								echo form_input('t_link', set_value('t_link',$slide->t_link));
								echo form_label('Imagen', 'imagen'); ?>
								<img src="<?php echo base_url('assets/img/slider/'.$slide->imagen); ?>">
								<br><br>
								<?php echo form_upload('imagen'/*, set_value('imagen'),$slide->imagen)*/);?>
							</div>
						</div>
						<?php 
							echo form_close();
						?>
					</div>
				</div>
			</div>
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
	<!-- End div class="wrapper container" -->
<script type="text/javascript"></script>
</body>
</html>
