<?php $this->load->view('/public/helper/head.php'); ?>
<?php $this->load->view('/public/helper/logo.php'); ?>
<?php if ($menu_top) { $this->load->view('/public/helper/menus/menu_top.php'); } ?>
<?php if ($menu_nav == TRUE) { $this->load->view('/public/helper/menus/menu_nav.php'); } ?>	

<!--  Contenido home  -->
<div class="container">
	<div class="row">
			<div class="span12 titulos">
				<h2 class="principal"><span>Blog</span></h2>
			</div>	
		</div>	
<div class="row">

	<!-- Home articulos  -->

	<div class="span9">
		<?php  $inicio = '/';$base2 = '/blog/';?>
			<p class="breadcrum">
				<a href="<?php echo base_url(''.$inicio); ?>">Inicio</a> / 
				<a href="<?php echo base_url(''.$base2); ?>">Blog</a>
			</p>
		<?php if($articulos!=false){ ?>
			<?php foreach ($articulos as $post): ?>
				<div class="nota-secundaria">
					<h2 class="titulos busqueda"><a href="<?php echo base_url('/blog/articulo/'.$post->slug); ?>"><?php echo $post->titulo; ?></a></h2>
					<div style="text-align:right;" class="fecha-nota">
					<span class="label"><?php echo $this->alinecms->dameFechaFormato($post->fecha_publicacion); ?></span>
					</div>
					<div class="secundaria-box">
						<div class="sec-cont">
							<div class="img-left">
		            			<?php if (strlen($post->imagen) >1 ) { ?>
		            			<img class="img-principal" src="<?php echo base_url('assets/img/'.$post->imagen); ?>" style="margin: 0px 10px 10px 0px;">
		            			<?php }else{ ?>
		            			<?php } ?>
		        			</div>
							<div class="intro-txt-2">
								<?php 
								$contenido = strip_tags($post->contenido);
								$contenido = substr($contenido, 0, 400);
								if (strlen($contenido) > 400) {
									echo $contenido."...";
								}else{
									echo $contenido;
								}
								 ?>
								<a class="read-more" href="<?php echo base_url('/blog/articulo/'.$post->slug); ?>">+ Leer más</a>
							</div> 
					    </div>
					</div>
				</div>
			<?php endforeach ?>
		<?php } ?>

		<?php // if($productos!=False){ ?>
			<?php // foreach ($productos as $producto): ?>
				<!-- <div class="nota-secundaria">
					<h2 class="titulos busqueda"><a href="<?php echo base_url('tienda/producto/'.$producto->id); ?>"><?php echo $producto->nombre; ?></a></h2>
					<img class="buscarr" src="<?php echo base_url('assets/img/catalogo/'.$producto->img_cat); ?>">
					<div class="secundaria-box">
						<div class="sec-cont">
							<a class="read-more" href="<?php echo base_url('tienda/producto/'.$producto->id); ?>">+ Leer más</a>
								<?php echo substr($producto->descripcion, 0, 150); 
								if (strlen($producto->descripcion)>150) {
									echo "...";
								}
								?>
					    </div>
					</div>
				</div> -->
			<?php //endforeach ?>
		<?php //} ?>
		<?php //if (!$productos && !$articulos): ?>
		<?php if (!$articulos): ?>
			<p>No hay articulos en el blog!</p>
		<?php endif ?>
		<div id="paginacion">
		<?php echo $paginacion; ?>
	</div>
	</div>
		<div class="span3 bordertop">
			<?php if($destacados){ ?>
				<h2>Articulos destacados</h2>
				<?php foreach ($destacados as $destacado): ?>
	 			<div class="row no-margin">
	            	<div class="span12 prodcuto">
			            <div class="img-left">
			            	<a href="<?php echo base_url('blog/articulo/'.$destacado->slug); ?>">
			            		<img class="img-principal" src="<?php echo base_url('assets/img/'.$destacado->imagen); ?>">
			            	</a>
			        	</div>
			        	<div class="cont-right">
				            <h3><a href="<?php echo base_url('blog/articulo/'.$destacado->slug); ?>"><?php echo $destacado->titulo; ?></a></h3>
				            <p class="description"><?php echo substr($destacado->contenido, 0, 45); ?></p>
				            <!-- <a class="read-more" href="<?php echo base_url($destacado->slug); ?>">+ Ver Más</a> -->
		            	</div>
		            </div>
	            </div>
	 			<?php endforeach ?>
 			<?php } ?>
        	<div class="mod2">
				<h2>Articulos recientes</h2>
				<?php foreach ($recientes as $reciente): ?>
	 			<div class="row no-margin">
	            	<div class="span12 prodcuto">
			            <div class="img-left">
			            	<a href="<?php echo base_url('blog/articulo/'.$reciente->slug); ?>">
			            		<img class="img-principal" src="<?php echo base_url('assets/img/'.$reciente->imagen); ?>">
			            	</a>
			        	</div>
			        	<div class="cont-right">
				            <h3><a href="<?php echo base_url('blog/articulo/'.$reciente->slug); ?>"><?php echo $reciente->titulo; ?></a></h3>
				            <p class="description"><?php echo substr($reciente->contenido, 0, 45); ?></p>
				            <!-- <a class="read-more" href="<?php echo base_url($reciente->slug); ?>">+ Ver Más</a> -->
		            	</div>
		            </div>
	            </div>
	 			<?php endforeach ?>
 			</div>
        	<div class="mod2">
				<h2>Categorías</h2>
				<?php foreach ($categorias as $categoria): ?>
	 			<div class="row no-margin">
	            	<div class="span12 prodcuto">
				            <a href="<?php echo base_url('blog/categoria/'.$categoria->id); ?>">
				            	<h3><?php echo $categoria->nombre; ?></h3>
				            </a>
		            </div>
	            </div>
	 			<?php endforeach ?>
 			</div>
 			<div class="mod2">
				<h2>Autores</h2>
				<?php foreach ($usuarios as $usuario): ?>
	 			<div class="row no-margin">
	            	<div class="span12 prodcuto">
				            <a href="<?php echo base_url('blog/autor/'.$usuario->id); ?>">
				            	<h3><?php echo $usuario->nombre; ?></h3>
				            </a>
		            </div>
	            </div>
	 			<?php endforeach ?>
 			</div>
 		</div>

	<!--  /Home articulos  -->
	<!--  Derecha   -->
	
	

	<!--  /Derecha  -->
</div>
</div>

<!--  /Contenido home  -->
<?php if ($menu_footer == TRUE) { $this->load->view('/public/helper/menus/menu_footer.php'); } ?>
<?php $this->load->view('/public/helper/footer.php'); ?>


