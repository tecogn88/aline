<?=$head?>
<?php echo ck_includes(); ?>
<body>
	<?=$header?>
<div class="wrapper container-fluid">
<div class="row-fluid">
	<aside id="menu_usuarios" class="span2">
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class=""><a href="<?php echo base_url('panel/post/'); ?>" >Panel de articulos<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
				<li class=""><a href="<?php echo base_url('panel/post/crea_articulo'); ?>" >Agregar articulo<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
				<li class="active"><a href="<?php echo base_url('panel/post/panel_categorias'); ?>" >Panel de categorias<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
				<li class=""><a href="<?php echo base_url('panel/post/crea_categoria'); ?>" >Crear categoria<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
			</ul>
		</div>
	</aside>
		
<div id="body_content" class="span10 panel_usuarios">
	<div class="page-header">
		<h2><?=$titulo_pagina?> <small> <?=$descripcion_pagina?></small></h2>
	</div>
<div class="row-fluid">
<!-- ***************** Formulario para crear nuevo articulo  *************** -->
<div class="span12">
	<form method="POST" action="<?php echo base_url('panel/post/actualizar_categoria/'.$id_categoria); ?>" enctype="multipart/form-data" name="frmArticuloNuevo" id="frmAddArticulo" class="form-horizontal">	
	<div class="well">
		<a href="<?php echo base_url('panel/post/panel_categorias'); ?>" style="margin-left:10px;float:right;" class="btn btn-danger">Cancelar<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a>
	    <!-- <input style="margin-left:10px;float:right;" type="submit" class="btn btn-primary" name="btnGuardar" value="Guardar" /> -->
	    <button style="margin-left:10px;float:right;" class="btn btn-primary" name="btnGuardar" onclick="submit">Guardar<span style='float:right;margin-left:10px;'><i class='icon-ok-sign icon-white'></i></span></button>
	</div>
		<input type="hidden" name="id_categoria" value="<?php echo $id_categoria; ?>">
		<div class="row-fluid">
			<div class="well">
			<?php if (validation_errors()): ?>
				<div class="alert alert-error">
					<button type="button" style="position: relative;top: -2px;line-height: 18px;right:0px;" class="close" data-dismiss="alert">&times;</button>
					<h3>Atención!</h3>
					<ul>
						<?php echo validation_errors('<li><span class="label label-important">', '</span></li>'); ?>
					</ul>
				</div>
			<?php endif ?>
				<fieldset>
					<div class="span3">
							<label for="titulo">Titulo de la categoría</label>
							<input type="text" name='titulo' id='titulo' class="span12" value="<?php echo $titulo_categoria ?>" >
							<label>Imagen</label>
								<a href="#" class="thumbnail">
									<img src="<?php echo base_url('assets/img/'.$imagen); ?>" width="300px">
								</a>
							<input type="file" name="imagen" id="imagen"><br />
							<?php //echo $catalogo->id; ?>
						</div>
					<div class="span9">
							<label for="titulo">Descripción</label>
							<textarea name="descripcion" id="ckeditor"><?php echo $descripcion;?></textarea>
							<?php $ck_config = array(     
							"replace" => "#ckeditor" // selector del objeto a reemplazar     
							, "options" => ck_options()     
							);
							echo jquery_ckeditor($ck_config); ?>
					</div>
				</fieldset>
			</div>
		</div>
	<input name="imagen_old" type="hidden" value="<?=$imagen?>">
	</form> <!-- Fin formulario para crear nuevo articulo -->
 </div>

<!-- <div class="span5">
	<?=$categorias?>
</div> -->



</div>  <!-- Fin Row fluid  contenedor del form-->
</div>	<!-- Fin body_content -->
		
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
</div> <!-- Row fluid general" -->
</div>	<!-- End div class="wrapper container" -->

	<script type="text/javascript">
		$("a[rel='tooltip']").tooltip();

		$(function(){
			$(".btndel").click(function(e){
				e.preventDefault();
				if(!confirm("Esta seguro que desea eliminar a este menú?")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});

		$(document).on("ready",function(){
			var valores_post = "<?php echo $id_post; ?>";
			var arrayvalores = valores_post.split('|');
			$("#id_post").val(arrayvalores);
		});
		

	</script>
</body>
</html>
