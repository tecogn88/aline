<?=$head?>
<?php echo ck_includes(); ?>
<body>
	<?=$header?>
<div class="wrapper container-fluid">
<div class="row-fluid">
	<aside id="menu_usuarios" class="span2">
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class="active"><a href="<?php echo base_url('panel/menus'); ?>" >Panel de menús<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
							<li class=""><a href="<?php echo base_url('panel/menus/crea_menu'); ?>" >Agregar menú nuevo<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
			</ul>
		</div>
	</aside>
		
<div id="body_content" class="span10 panel_usuarios">
<div class="row-fluid">
<!-- ***************** Formulario para crear nuevo articulo  *************** -->

<div class="span12">
	<form method="POST" action="<?php echo base_url('panel/menus/guarda_menu') ?>" name="frmArticuloNuevo" id="frmAddArticulo" class="form-horizontal">
	<div class="well">
		<div class="span8">
			<h2><?=$titulo_pagina?> <small> <?=$descripcion_pagina?></small></h2>
		</div>
		<a href="<?php echo base_url('panel/menus/'); ?>" style="float:right;margin-left:10px;" class="btn btn-danger">Cancelar<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a>
	   <!--  <input style="float:right;margin-left:10px;" type="submit" class="btn btn-primary" name="btnGuardar" value="Agregar nuevo menú" /> -->
	    <button style="margin-left:10px;float:right;" class="btn btn-primary" name="btnGuardar" onclick="submit">Agregar nuevo menú<span style='float:right;margin-left:10px;'><i class='icon-plus icon-white'></i></span></button>
	</div>
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
						<label for="titulo">Titulo del Menu</label>
						<input type="text" name='titulo' id='titulo' class="" value="<?php echo set_value('titulo'); ?>" >
						<label for="titulo">Id para el menu</label>
						<input type="text" name='id_css' id='id_css' class="" value="<?php echo set_value('id_css'); ?>" >
						<label for="titulo">Clase para el menu</label>
						<input type="text" name='clase' id='clase' class="" value="<?php echo set_value('clase'); ?>" >
						<label for="titulo">Atributos extra</label>
						<input type="text" name='atributo' id='atributo' class="" value="<?php echo set_value('atributo'); ?>" >
						<label for="id_post">Seleccione las paginas a asignar<br/> (Presione Ctrl para seleccionar mas de una opción)</label>
						<select class="" name="id_post[]" id="id_post" multiple>
							<?=$paginas?>
						</select>
					</div>
					<div class="span8">
						<label for="titulo">Descripción</label>
						<textarea name="descripcion" id="ckeditor"><?php echo set_value('descripcion');?></textarea>
						<?php $ck_config = array(     
							"replace" => "#ckeditor" // selector del objeto a reemplazar     
							, "options" => ck_options()     
						);
						echo jquery_ckeditor($ck_config); ?>
					</div>
				</fieldset>
			</div>

	</form> <!-- Fin formulario para crear nuevo articulo -->
 </div>

<!-- <div class="span5">
	<?=$menus?>
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
		

	</script>
</body>
</html>
