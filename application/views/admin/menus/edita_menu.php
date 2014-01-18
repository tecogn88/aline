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
	<form method="POST" action="<?php echo base_url('panel/menus/guarda_edicion_menu') ?>" name="frmArticuloNuevo" id="frmAddArticulo" class="form-horizontal">
		<input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>">
		<div class="well">
			<div class="span8">
				<h2><?=$titulo_pagina?> <small> <?=$descripcion_pagina?></small></h2>
			</div>
			<a href="<?php echo base_url('panel/menus/'); ?>" style="float:right;margin-left:10px;" class="btn btn-danger">Cancelar<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a>
		    <button style="margin-left:10px;float:right;" class="btn btn-primary" name="btnGuardar" onclick="submit">Guardar<span style='float:right;margin-left:10px;'><i class='icon-ok-sign icon-white'></i></span></button>
		</div>
		<div class="well">
		<?php echo validation_errors('<div class="error"><span class="label label-important">', '</span></div>'); echo '<br/>'; ?>
			<fieldset>
				<div class="span3">
					<label for="titulo"><h4>Titulo del Menu</h4></label>
					<input type="text" name='titulo' id='titulo' class="" value="<?php echo $titulo_menu ?>" >
					<label for="titulo"><h4>Id para el menu</h4></label>
					<input type="text" name='id_css' id='id_css' class="" value="<?php echo $id_css ?>" >
					<label for="titulo"><h4>Clase para el menu</h4></label>
					<input type="text" name='clase' id='clase' class="" value="<?php echo $clase; ?>" >
					<label for="titulo"><h4>Atributos extra</h4></label>
					<input type="text" name='atributo' id='atributo' class="" value="<?php echo $atributos; ?>" >				
					<!-- <label for="id_post">Seleccione las paginas a asignar<br/> (Presione Ctrl para seleccionar mas de una opción)</label>
					<select class="" name="id_post[]" id="id_post" multiple>
						<?=$paginas?>
					</select> -->
					<label><h4>Ubicación del menú</h4></label>
					<select name="ubicacion" id="ubicacion">
						<!-- <option value="top">top</option>
						<option value="topleft">top left</option> -->
						<option value="topright">top</option>
						<option value="nav">nav</option>
						<!-- <option value="left">left</option>
						<option value="right">right</option> -->
						<option value="bottom">footer</option>
						<!-- <option value="footer">footer</option> -->
						<option value="footer1">footer 1</option>
						<option value="footer2">footer 2</option>
						<option value="footer3">footer 3</option>
						<option value="footer4">footer 4</option>
						<!-- <option value="debugger">debugger</option> -->
					</select>
				</div>
				<div class="span9">
					<h4>Vista previa de ubicación</h4>
					
					<div class="well-ubicacion">
						<div class="row-fluid top">
							<div class="span4 top-left">
								<!-- <div class="tmp-pos" data-position="topleft">
									<ul class="nav nav-pills">
									  <li class="active">
									    <a href="#">Home</a>
									  </li>
									  <li><a href="#">About</a></li>
									  <li><a href="#">Help</a></li>
									  <li><a href="#">Link</a></li>
									</ul>
								</div> -->
							</div>
							<div class="span4 top">
								<!-- <div class="tmp-pos" data-position="top">
									<ul class="nav nav-pills">
									  <li class="active">
									    <a href="#">Home</a>
									  </li>
									  <li><a href="#">About</a></li>
									  <li><a href="#">Help</a></li>
									  <li><a href="#">Link</a></li>
									</ul>
								</div> -->
							</div>
							<div class="span4 top-right">
								<div class="tmp-pos" data-position="topright">
									<ul class="nav nav-pills">
									  <li class="active">
									    <a href="#">Home</a>
									  </li>
									  <li><a href="#">About</a></li>
									  <li><a href="#">Help</a></li>
									  <li><a href="#">Link</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="row-fluid nav">
							<div class="tmp-pos" data-position="nav">
								<div class="navbar navbar-inverse">
								  <div class="navbar-inner">
								    <ul class="nav">
								      <li class="active"><a href="#">Home</a></li>
								      <li><a href="#">Link</a></li>
								      <li><a href="#">Link</a></li>
								    </ul>
								  </div>
								</div>
							</div>
						</div>
						<div class="row-fluid article">
							<div class="span3 left">
								<!-- <div class="tmp-pos" data-position="left">
									<div class="well">
										<ul class="nav nav-list">
										  <li class="nav-header"><h4>Menu title</h4></li>
										  <li class="active"><a href="#">Home</a></li>
										  <li><a href="#">Library</a></li>
										</ul>
									</div>
								</div> -->
							</div>
							<div class="span6" style="opacity:0.3;">
								<div class="well content">
									<h1>Content</h1>
								</div>
							</div>
							<div class="span3 right">
								<!-- <div class="tmp-pos" data-position="right">
									<div class="well">
										<ul class="nav nav-list">
										  <li class="nav-header"><h4>Menu title</h4></li>
										  <li class="active"><a href="#">Home</a></li>
										  <li><a href="#">Library</a></li>
										</ul>
									</div>
								</div> -->
							</div>
						</div>
						<div class="row-fluid bottom">
							<div class="tmp-pos" data-position="bottom">
								<div class="navbar navbar-inverse">
								  <div class="navbar-inner">
								    <ul class="nav">
								      <li class="active"><a href="#">Home</a></li>
								      <li><a href="#">Link</a></li>
								      <li><a href="#">Link</a></li>
								    </ul>
								  </div>
								</div>
							</div>
						</div>
						<!-- <div class="row-fluid footer">
							<div class="span4"></div>
							<div class="span4 footer">
								<div class="tmp-pos" data-position="footer">
									<ul class="nav nav-pills">
									  <li class="active">
									    <a href="#">Home</a>
									  </li>
									  <li><a href="#">About</a></li>
									  <li><a href="#">Help</a></li>
									  <li><a href="#">Link</a></li>
									</ul>
								</div>
							</div>
						</div> -->
						<div class="row-fluid footer4pos">
							<div class="span3 footer1">
								<div class="tmp-pos" data-position="footer1">
									<div class="well">
										<ul class="nav nav-list">
										  <li class="nav-header"><h4>Menu title</h4></li>
										  <li class="active"><a href="#">Home</a></li>
										  <li><a href="#">Library</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="span3 footer2">
								<div class="tmp-pos" data-position="footer2">
									<div class="well">
										<ul class="nav nav-list">
										  <li class="nav-header"><h4>Menu title</h4></li>
										  <li class="active"><a href="#">Home</a></li>
										  <li><a href="#">Library</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="span3 footer3">
								<div class="tmp-pos" data-position="footer3">
									<div class="well">
										<ul class="nav nav-list">
										  <li class="nav-header"><h4>Menu title</h4></li>
										  <li class="active"><a href="#">Home</a></li>
										  <li><a href="#">Library</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="span3 footer4">
								<div class="tmp-pos" data-position="footer4">
									<div class="well">
										<ul class="nav nav-list">
										  <li class="nav-header"><h4>Menu title</h4></li>
										  <li class="active"><a href="#">Home</a></li>
										  <li><a href="#">Library</a></li>
										</ul>
									</div>
								</div>	
							</div>
						</div>
						<!-- <div class="row-fluid debugger">
							<div class="span4"></div>
							<div class="span4">
								<div class="tmp-pos" data-position="debugger">
									<ul class="nav nav-pills">
									  <li class="active">
									    <a href="#">Home</a>
									  </li>
									  <li><a href="#">About</a></li>
									  <li><a href="#">Help</a></li>
									  <li><a href="#">Link</a></li>
									</ul>
								</div>
							</div>
						</div> -->
					</div>
					<!-- <label for="titulo">Descripción</label>
					<textarea name="descripcion" id="ckeditor"><?php echo $descripcion;?></textarea> -->
					<?php //$ck_config = array(     
							//"replace" => "#ckeditor"  
							//, "options" => ck_options()     
						//);
						//echo jquery_ckeditor($ck_config); ?>
				</div>
				<input id="ubicacion_sel" name="ubicacion_sel" type="hidden" value="<?php echo $ubicacion;?>">

			</fieldset>

	</div>
	</form> <!-- Fin formulario para crear nuevo articulo -->
 </div>

<!-- <div class="span5">
	<?=$menus?>
</div>
 -->


</div>  <!-- Fin Row fluid  contenedor del form-->
</div>	<!-- Fin body_content -->
		
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
</div> <!-- Row fluid general" -->
</div>	<!-- End div class="wrapper container" -->

	<style>
	.opacidad1{
		opacity: 1;
	}
	.opacidad, .tmp-pos{
		opacity: 0.1;
	}
	</style>

	<script type="text/javascript">

		$(document).on('ready',function(){
			var _ubicacionsel = $("#ubicacion_sel").val();
			$(".tmp-pos[data-position="+_ubicacionsel+"]").removeClass( "tmp-pos" ).addClass( "opacidad1" );
			$("#ubicacion").val(_ubicacionsel);
		});

		$("#ubicacion").on('change',function(){
			var _valor = $(this).val();
			$(".opacidad1").removeClass("opacidad1").addClass( "tmp-pos" );
			$(".tmp-pos[data-position="+_valor+"]").removeClass( "tmp-pos" ).addClass( "opacidad1" );
		});

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
