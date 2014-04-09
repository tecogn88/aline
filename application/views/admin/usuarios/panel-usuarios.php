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
					<div class="well"><?=$links?>	
					<hr>
						<?php if($usuarios == FALSE){ ?>
							<p>Aún no hay usuarios creados.</p>
						<?php }else{ ?>
						<div class="row-fluid">
							<?php $contador = 0; ?>
							<?php foreach ($usuarios->result() as $usuario){ ?>
								<?php $contador++; $nombre = $usuario->nombre." ".$usuario->apellidos; ?>
								<div class="span2 thumbnail well text-center">
									<?php if(strlen( trim($nombre) ) > 20 ) { ?>
										<h4 style="margin-bottom:5px;"><?php echo substr($nombre, 0,15).'...'; ?></h4>
									<?php }else{ ?>
										<h4 style="margin-bottom:5px;"><?php echo $nombre; ?></h4>
									<?php } ?>
									<?php if ($usuario->imagen){ ?>
										<img src="<?php echo base_url('assets/media/usuarios/'.$usuario->imagen); ?>" style="max-width:120px;max-height:130px;">
									<?php }else{ ?>
										<img src="<?php echo base_url('assets/admin/img/ico/retina/man_64.png'); ?>" style="margin: 26px auto 10px auto;">
										<?php } ?>
									<br>
									<p>
										<a class="badge badge-success" href="<?=base_url('/panel/usuarios/edita_usuario/'.$usuario->id)?>" rel="tooltip" title="Editar usuario:<br /><?=$usuario->nombre?>"><i class="icon-edit icon-white"></i></a>
										<a class="badge badge-important btndel" href="<?=base_url('panel/usuarios/borrar_usuario/'.$usuario->id)?>" rel="tooltip" title="Borrar usuario:<br /><?=$usuario->nombre?>"><i class="icon-remove icon-white"></i></a>
									</p>
								</div>
								<?php if ($contador%6 == 0): ?>
									</div><div class="row-fluid">
								<?php endif ?> 
							<?php } ?><!-- Fin foreach -->
						</div>
						<?php } ?>
					</div>
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
