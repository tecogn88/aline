<?=$head?>
<body>
	<?=$header?>
<div class="wrapper container-fluid">
<div class="row-fluid">
	<aside id="menu_usuarios" class="span2">
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class="active"><a href="<?php echo base_url('panel/banners/crea_banner'); ?>" >Panel de Banners</a></li>
			</ul>
		</div>
	</aside>	
<div id="body_content" class="span10 panel_usuarios">
	<form method="POST" action="<?php echo base_url('panel/banners/guarda_banner/'.$banner->id); ?>" id="frmAddUsuario" class="form-horizontal" enctype="multipart/form-data">
	<div class="well">
		<div class="row-fluid">
			<div class="span9">
				<h2>Imagen del banner <?php echo $banner->nombre; ?> <small> Agrega la imagen de tu banner</small></h2>
			</div>
			<div class="pull-right">
		    	<button class="btn btn-primary" name="btnGuardar" onclick="submit">Guardar edición<span style='float:right;margin-left:10px;'><i class='icon-plus icon-white'></i></span></button>
		    	<a class="btn btn-danger" href="<?php echo base_url('panel/banners'); ?>">Cancelar <i class="icon-ban-circle icon-white"></i></a>
			</div>
		</div>
	</div>
	<div class="well">
		<div class="row-fluid">
			<?php if (validation_errors()): ?>
				<div class="alert alert-error">
					<button type="button" style="position: relative;top: -2px;line-height: 18px;right:0px;" class="close" data-dismiss="alert">&times;</button>
					<h3>Verifique los campos requeridos!</h3>
					<ul>
						<?php echo validation_errors('<li><span class="label label-important">', '</span></li>'); ?>
					</ul>
				</div>
			<?php endif ?>
			<div class="span3">
				<label>Nombre del banner</label>
				<input name="nombre" type="text" value="<?php echo $banner->nombre; ?>">
				<label>Posición</label>
				<select name="ubicacion" id="ubicacion">
					<option value=''>-- Selecione la posicion --</option>
					<!-- <option value="top">top</option> -->
					<option value="topleft">top left</option>
					<option value="topright">top right</option>
					<option value="nav">nav</option>
					<!-- <option value="left">left</option>
					<option value="right">right</option> -->
					<option value="bottom">footer</option>
					<!-- <option value="footer">footer</option> -->
					<!-- <option value="footer1">footer 1</option>
					<option value="footer2">footer 2</option>
					<option value="footer3">footer 3</option>
					<option value="footer4">footer 4</option> -->
					<!-- <option value="debugger">debugger</option> -->
				</select>
				<label>Link</label>
				<input name="link" type="text">
				<label>Imagen</label>
				<input name="imagen" type="file">
			</div>
			<div class="span9">
				<h4>Vista previa de ubicación</h4>
					<input id="ubicacion_sel" name="ubicacion_sel" type="hidden" value="<?php echo $banner->ubicacion;?>">
					<div class="well-ubicacion">
						<div class="row-fluid top" style="height:100px;">
							<div class="span4 top-left">
								<div class="tmp-pos" data-position="topleft">
									<div class="thumbnail-white-centered">
										<img src="<?php echo base_url('assets/media/banners/'.$banner->imagen); ?>">
									</div>
								</div>
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
									<div class="thumbnail-white-centered">
										<img src="<?php echo base_url('assets/media/banners/'.$banner->imagen); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="tmp-pos2" style="opacity:0.9;">
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
						<div class="row-fluid nav span6">
							<div class="tmp-pos" data-position="nav">
								<div class="thumbnail-white-centered">
									<img src="<?php echo base_url('assets/media/banners/'.$banner->imagen); ?>">
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
							<div class="span6" style="opacity:0.9;">
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
								<div class="thumbnail-white-centered">
									<img src="<?php echo base_url('assets/media/banners/'.$banner->imagen); ?>">
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
			</div>
		</div>
	</div>
	</form> <!-- Fin formulario para crear nuevo articulo -->
<!-- ***************** Formulario para crear nuevo articulo  *************** -->

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
		opacity: 0.01;
	}
	</style>
	<script type="text/javascript">
	$(".collapse").collapse();
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
				if(!confirm("Esta seguro que desea eliminar este catálogo?")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});
	</script>
</body>
</html>
