<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class="active"><a href="<?php echo base_url('panel/blog/'); ?>" >Panel de articulos<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
							<li class=""><a href="<?php echo base_url('panel/blog/panel_categorias'); ?>" >Panel de categorias<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
						</ul>
					</div>
				</aside>
				<div id="body_content" class="span10 panel_usuarios">
					<div class="row-fluid">
						<div class="well">
							<div class="span8">
								<h2>Blog <small>Crea, edita y elimina los articulos.</small></h2>
							</div>
							<div class="pull-right">
								<a class="btn btn-primary" href="<?php echo base_url('/panel/blog/crea_articulo'); ?>">Agregar Nuevo<span style='margin-left:10px;'><i class='icon-plus icon-white'></i></span></a>
								<a class="btn btn-inverse" href="<?php echo base_url('/panel/blog/configuracion'); ?>">Configuración Blog <span style='margin-left:10px;'><i class='icon-cog icon-white'></i></span></a>	
							</div>
						</div>
					</div>
					<?php if($paginacion){ ?>
						<div class="row-fluid">
							<div class="span12">
								<div class="pagination"><?php echo $paginacion ?></div>
							</div>
						</div>
					<?php } ?>
					<div class="row-fluid">
						<div class="span12">
							<!-- <div class="pagination" style='margin:0px 0px 18px 0px;'><?php echo $paginacion ?></div> -->
						<?php if($articulos == FALSE){ ?>
						<div class="alert">
							<strong><h3>No se han encontrado articulos en el blog.</h3></strong>
						</div>
						<?php }
						else{ ?>
						<table id="tblMenus" class="table table-striped">
							<th><a href="<?php echo base_url('panel/blog/ordena_por_id'); ?>" rel="tooltip" title="Ordenar por ID">#</a></th>
							<th><a href="<?php echo base_url('panel/blog'); ?>" rel="tooltip" title="Ordenar por titulo">Titulo</a></th>
							<th><a href="<?php echo base_url('panel/blog/ordena_por_autor'); ?>" rel="tooltip" title="Ordenar por Autor">Autor</a></th>
							<th><a href="<?php echo base_url('panel/blog/ordena_por_categoria'); ?>" rel="tooltip" title="Ordenar por Categoría">Categoria</a></th>
							<th><a href="<?php echo base_url('panel/blog/ordena_por_inicio'); ?>" rel="tooltip" title="Ordenar por En el Home">Inicio</a></th>
							<th><a href="<?php echo base_url('panel/blog/ordena_por_estado'); ?>" rel="tooltip" title="Ordenar por Estado">Estado</a></th>
							<th class="cont_accion"><span class='label label-info' style='margin-right: 10px;'><i class="icon-remove icon-white"></i></span>  Eliminar</th>
							<tbody>
							<?php foreach ($articulos as $articulo){ ?>
							    <tr>
						    		<td><?php echo $articulo->id; ?></td>
							    	<td style="font-style:italic;font-weight:bold;"><a href="<?=base_url('panel/blog/edita_post/'.$articulo->id)?>" rel="tooltip" title="Editar articulo:<br /><?=$articulo->titulo?>"><?=$articulo->titulo?></a></td>
							    	<td><?php $autor = $this->blog->dameNombreAutor($articulo->id_autor); ?>
							    		<?php if ($articulo->id_autor == 0) {
							    			echo "Anónimo";
							    		}else{
							    		echo $autor; } ?>
							    	</td>
							    	<td>
							    		<?php $categoria_nombre = $this->blog->dameNombreCategoria($articulo->id_categoria); ?>
										<?php echo $categoria_nombre; ?>
									</td>
						    		<td><?php if ($articulo->pag_inicio == 0) {?>
						    			<!-- <i class="icon-ban-circle icon-black"></i> -->
						    		<?php }else{?>
						    			<i class="icon-ok icon-black"></i>
						    		<?php }?></td>
						    		<td>
						    			<?php if($articulo->estado == 1){ ?>
											<span class="label label-success">activo</span> <span class="label"><a style="text-decoration:none;color:#fff;" href="<?php echo base_url('panel/blog/desactivar_post/'.$articulo->id); ?>" rel="tooltip" title="Desactivar el articulo: '<?php echo $articulo->titulo; ?>'">desactivar</a></span> 
										<?php }else{ ?>
											<span class="label"><a style="text-decoration:none;color:#fff;" href="<?php echo base_url('panel/blog/activar_post/'.$articulo->id); ?>" rel="tooltip" title="Activar el articulo: '<?php echo $articulo->titulo; ?>'">activar</a></span> <span class="label label-warning">inactivo</span>
										<?php }?>
									</td>
						    		<td>
						    			<div class="cont_accion">
											<a class="label label-important btndel" href="<?=base_url('panel/blog/borrar_post/'.$articulo->id)?>" rel="tooltip" title="Borrar articulo:<br /><?=$articulo->titulo?>">eliminar</a>
										</div>
									</td>
								</tr>
							<?php }
							} ?>
							</tbody>
						</table>
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
				if(!confirm("Esta seguro que desea eliminar a este articulo?")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});
	</script>
</body>
</html>
