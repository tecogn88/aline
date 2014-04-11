<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
		<div class="row-fluid">
			<aside id="menu_usuarios" class="span2">
				<div class="tabbable tabs-left">
					<ul class="nav nav-tabs">
						<li class="active"><a href="<?php echo base_url('panel/usuarios/'); ?>" >Panel <span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
						<li class=""><a href="<?php echo base_url('panel/usuarios/nuevo_usuario'); ?>" >Agregar Usuario <span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
					</ul>
				</div>
			</aside>
			<div id="body_content" class="span10 panel_usuarios">
				<div class="row-fluid">
					<div class="well1">
						<div class="span6">
							<h2>Usuarios <small>Agrega, edita y elimina usuarios de éste sitio web</small></h2>
						</div>
						<div class="span6" style="text-align:right;">
							<a class="btn btn-primary" href="<?php echo base_url('/panel/usuarios/nuevo_usuario'); ?>">Agregar Usuario<span style='margin-left:10px;'><i class='icon-plus icon-white'></i></span></a>
						</div>
					</div>
				</div>
				<br>
				<div class="row-fluid">
					<?=$links?>
					<br>
						<?php if($usuarios == FALSE){ ?>
						<div class="alert">
						  <strong>Aún no hay usuarios creados!</strong>
						</div>
						<?php }else{ ?>
						<table class="table">
							<th><b><a href="<?php echo base_url('panel/usuarios/ordena_por_id'); ?>" rel='tooltip' title='Ordenar por usuarios por ID'>#</a></b></th>
							<th><b><a href="<?php echo base_url('panel/usuarios'); ?>" rel="tooltip" title="Ordenar usuarios por Nombre">Nombre</a></b></th>
							<th><b><a href="<?php echo base_url('panel/usuarios/ordena_por_mail'); ?>" rel="tooltip" title="Ordenar usuarios por e-mail">e-mail</a></b></th>
							<th><b><a href="<?php echo base_url('panel/usuarios/ordena_por_tipo'); ?>" rel="tooltip" title="Ordenar usuarios por Tipo">Tipo</a></b></th>
							<th><b><a href="<?php echo base_url('panel/usuarios/ordena_por_estado'); ?>" rel="tooltip" title="Ordenar usuarios por Estado">Estado</a></b></th>
							<td><b><a href="<?php echo base_url('panel/usuarios/ordena_por_fecha'); ?>" rel="tooltip" title="Ordenar usuarios por Fecha de Creación">Creado</a></b></td>
							<td><b>Eliminar</b></td>
							<?php foreach ($usuarios->result() as $usuario){ ?>
								<?php $nombre = $usuario->nombre." ".$usuario->apellidos; ?>
								<tr>
									<td><?php echo $usuario->id; ?></td>
									<td>
										<?php if(strlen( trim($nombre) ) > 40 ) { ?>
											<h4 style="margin-bottom:5px;"><a href="<?=base_url('/panel/usuarios/edita_usuario/'.$usuario->id)?>" rel="tooltip" title="Editar usuario:<br /><?=$usuario->nombre?>"><?php echo substr($nombre, 0,38).'...'; ?></a></h4>
										<?php }else{ ?>
											<h4 style="margin-bottom:5px;"><a href="<?=base_url('/panel/usuarios/edita_usuario/'.$usuario->id)?>" rel="tooltip" title="Editar usuario:<br /><?=$usuario->nombre?>"><?php echo $nombre; ?></a></h4>
										<?php } ?>
									</td>
									<td><?php echo $usuario->email; ?></td>
									<td>
										<?php if($usuario->perfil == 1){
											echo '<p class="text-success">Administrador</p>'; 
										}if($usuario->perfil == 2){
											echo '<p class="text-info">Editor</p>';
										}if($usuario->perfil == 3){
											echo '<p class="text-warning">Suscriptor</p>';
										}?>
									</td>
									<td>
										<?php if($usuario->estado == 1){ 
												echo '<span class="label label-success">activo</span> <span class="label"><a style="text-decoration:none;color:#fff;" href="'.base_url('panel/usuarios/desactivar_usuario/'.$usuario->id).'" rel="tooltip" title="Desactivar al usuario'.$usuario->nombre.'">desactivar</a></span>'; 
											}else{
												echo ' <span class="label"><a style="text-decoration:none;color:#fff;" href="'.base_url('panel/usuarios/activar_usuario/'.$usuario->id).'" rel="tooltip" title="Activar al usuario'.$usuario->nombre.'">activar</a></span> <span class="label label-warning">inactivo</span>';
											}?>
									</td>
									<td><?php echo $usuario->fecha_creacion; ?></td>
									<td><a class="btn btn-danger btn-small" href="<?=base_url('panel/usuarios/borrar_usuario/'.$usuario->id)?>" rel="tooltip" title="Borrar usuario:<br /><?=$usuario->nombre?>">eliminar</a></td>
								</tr>
							<?php } ?><!-- Fin foreach -->
						</table>
						<?php } ?>
					</div>
				</div>
			</div>
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
	<!-- End div class="wrapper container" -->
	<script type="text/javascript">
		$("a[rel='tooltip']").tooltip();
		$(function(){
			$(".btndel").click(function(e){
				e.preventDefault();
				if(!confirm("Esta seguro que desea eliminar a este usuario?")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});
	</script>
</body>
</html>
