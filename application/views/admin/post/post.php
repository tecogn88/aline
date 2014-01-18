<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class="active"><a href="<?php echo base_url('panel/post/'); ?>" >Panel de articulos<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
							<li class=""><a href="<?php echo base_url('panel/post/crea_articulo'); ?>" >Agregar articulo<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
							<li class=""><a href="<?php echo base_url('panel/post/panel_categorias'); ?>" >Panel de categorias<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
							<li class=""><a href="<?php echo base_url('panel/post/crea_categoria'); ?>" >Crear categoria<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
						</ul>
					</div>
				</aside>
				<div id="body_content" class="span10 panel_usuarios">
					<div class="page-header">
						<h2>Articulos <small>Crea, edita y elimina nuevos articulos</small></h2>
					</div>
					<div class="row-fluid">
						<div class="well">
							<div class="span6">
								<a class="btn btn-primary" href="<?php echo base_url('/panel/post/crea_articulo'); ?>">Agregar Nuevo<span style='margin-left:10px;'><i class='icon-plus icon-white'></i></span></a>
							</div>
							<div class="span6">
								<div id="cont_perfiles"></div>	
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span10">
							<h2>Articulos</h2>
						</div>
						<div class="span2">
							<div class="pagination" style='margin:0px 0px 18px 0px;'><?php echo $paginacion ?></div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<!-- <div class="pagination" style='margin:0px 0px 18px 0px;'><?php echo $paginacion ?></div> -->
						<?php if($articulos == FALSE){ ?>
							<p>Aún no hay articulos registrados en el blog.</p>
						<?php }
						else{ ?>
						<table id="tblMenus" class="table table-striped  table-bordered ">
							<thead>
								<tr style='background-color: #D9EDF7;'>
									<th><span class='label label-info' style='margin-right: 10px;'><i class="icon-user icon-white"></i></span>  Autor</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class="icon-font icon-white"></i></span>  Titulo</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class="icon-tasks icon-white"></i></span>  Categoria</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class="icon-file icon-white"></i></span>  Contenido</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class="icon-home icon-white"></i></span>  Inicio</th>
									<th><span class='label label-info' style='margin-right: 10px;'><i class="icon-briefcase icon-white"></i></span>  Portafolio</th>
									<th class="cont_accion"><span class='label label-info' style='margin-right: 10px;'><i class="icon-wrench icon-white"></i></span>  Acciones</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($articulos as $articulo){ ?>
							    <tr>
							    	<td><?php $autor = $this->post->dameNombreAutor($articulo->id_autor); ?>
							    		<?php if ($articulo->id_autor == 0) {
							    			echo "Anónimo";
							    		}else{
							    		echo $autor; } ?>
							    	</td>
							    	<td style="font-style:italic;font-weight:bold;"><?=$articulo->titulo?></td>
							    	<td>
							    		<?php $categoria_nombre = $this->post->dameNombreCategoria($articulo->id_categoria); ?>
										<?php echo $categoria_nombre; ?>
									</td>
						    		<td><?php echo substr($articulo->contenido, 0,40) ?></td>
						    		<td><?php if ($articulo->pag_inicio == 0) {?>
						    			<!-- <i class="icon-ban-circle icon-black"></i> -->
						    		<?php }else{?>
						    			<i class="icon-ok icon-black"></i>
						    		<?php }?></td>
						    		<td><?php if ($articulo->portafolio == 0) {
						    			
						    		}else{ ?>
						    			<i class="icon-ok icon-black"></i>
						    		<?php }?></td>
						    		<td>
						    			<div class="cont_accion">
											<a class="badge badge-success" href="<?=base_url('panel/post/edita_post/'.$articulo->id)?>" rel="tooltip" title="Editar articulo:<br /><?=$articulo->titulo?>"><i class="icon-edit icon-white"></i></a>
											<a class="badge badge-important btndel" href="<?=base_url('panel/post/borrar_post/'.$articulo->id)?>" rel="tooltip" title="Borrar articulo:<br /><?=$articulo->titulo?>"><i class="icon-remove icon-white"></i></a>
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
