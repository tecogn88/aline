<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class="active"><a href="<?php echo base_url('panel/post/panel_paginas'); ?>" >Panel de páginas<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
							<li class=""><a href="<?php echo base_url('panel/post/crea_pagina'); ?>" >Agregar página<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
						</ul>
					</div>
				</aside>
		
				<div id="body_content" class="span10 panel_usuarios">
					<div class="well">
						<div class="row-fluid">
							<div class="span6">
								<h2>Páginas <small>Crea, edita y elimina nuevas páginas estaticas.</small></h2>
							</div>
							<div class="pull-right">
								<a class="btn btn-primary" href="<?php echo base_url('/panel/post/crea_pagina'); ?>">Agregar Página<span style='margin-left:10px;'><i class='icon-plus icon-white'></i></span></a>
							</div>
						</div>
					</div>	
					<div class="row-fluid">
						<?php if(!$paginas){ ?>
							<div class="alert">
								<h3>No se han encontrado páginas de contenido!</h3>
							</div>
						<?php }else{ ?>
							<?php $contador = 0; ?>
							<?php foreach ($paginas as $pagina){ ?>
								<?php $contador++; ?>
								<div class="span3 thumbnail" style="text-align:center;">
									<div class="well">
										<?php if(strlen( trim($pagina->titulo) ) > 20 ) { ?>
											<h3 style="margin-bottom:5px;"><?php echo substr($pagina->titulo, 0,15).'...'; ?></h3>
										<?php }else{ ?>
											<h3 style="margin-bottom:5px;"><?php echo $pagina->titulo; ?></h3>
										<?php } ?>
									</div>
									<p><small><i><?php echo $this->alinecms->dameFechaPublicacion($pagina->fecha_publicacion); ?></i></small></p>
									<?php if ($autor) { ?>
										<p>Por: <b><?php echo $autor->row('nombre').' '.$autor->row('apellidos'); ?></b></p>
									<?php } ?>
									<?php if($pagina->etiquetas){ ?>
										<small>Etiquetas:</small><br><br>
										<?php $tags = $pagina->etiquetas; $etiquetas = explode(",", $tags);
											foreach ($etiquetas as $tagged) { ?>
												<span class="label tag"><?php echo $tagged; ?></span>
											<?php }?>
									<?php } ?>
									<hr>
									<p>
										<a class="badge badge-success" href="<?=base_url('/panel/post/edita_pagina/'.$pagina->id_post)?>" rel="tooltip" title="Editar pagina:<br /><?=$pagina->titulo?>"><i class="icon-edit icon-white"></i></a>
										<a class="badge badge-important btndel" href="<?=base_url('/panel/post/borrar_pagina/'.$pagina->id_post)?>" rel="tooltip" title="Borrar pagina:<br /><?=$pagina->titulo?>"><i class="icon-remove icon-white"></i></a>
									</p>
								</div>
								<?php if ($contador%4 == 0): ?>
									</div><div class="row-fluid">
								<?php endif ?> 
							<?php } ?><!-- Fin foreach -->
						</div>
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
				if(!confirm("Esta seguro que desea eliminar a esta página?")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});



	</script>
</body>
</html>
