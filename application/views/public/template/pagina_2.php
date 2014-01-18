<?php $this->load->view('/public/helper/head.php'); ?>
<?php $this->load->view('/public/helper/main_menu.php'); ?>
	
	<div class="container">
		<div class="row">
			<div class="span12 titulos">
				<h2 class="principal"><span>Noticias</span></h2>
			</div>	
		</div>	
		<div class="row">
			<div class="span9">
				<?php  $inicio = '/';$base2 = '/blog/'; $base1 = '/blog/categoria/'.$pagina->id_categoria;?>
				<p class="breadcrum">
					<a href="<?php echo base_url(''.$inicio); ?>">Inicio</a> / 
					<a href="<?php echo base_url(''.$base2); ?>">Blog</a> / 
					<a href="<?php echo base_url(''.$base1); ?>"><?php echo $categoria_nombre; ?></a> /
					<?php echo $pagina->titulo; ?>
				</p>
				<div class="contenidoarticulo">
					<h2 class="titulos noticia"><?=$pagina->titulo;?></h2>
					<?php if ($pagina->id_autor == 0){ ?>
					<span class="label label-inverse" style="text-transform: capitalize;">Anónimo</span>
					<?php }else{ ?><a href="<?php echo base_url('/blog/autor/'.$autor_id); ?>">
					<span class="label label-inverse" style="text-transform: capitalize;"><?php echo $autor; ?></span></a>
					<?php } ?>
					<span class="label"><?php echo $this->alinecms->dameFechaFormato($pagina->fecha_publicacion); ?></span><br>
					<?php if ($pagina->imagen != '' && strlen($pagina->imagen) > 5): ?>
					<img class="blog_img" src="<?php echo base_url('assets/img/'.$pagina->imagen); ?>">
					<?php endif ?>
					<p><?=$pagina->contenido;?></p>
				</div>
				<div class="articulosdecat">
					<h2 class="titulos noticia">Más articulos de la categoria <?php echo $categoria_nombre; ?></h2>
					<ul class="articulosdecat">
					<?php foreach ($articulos as $articulo) { ?>
						<?php $not = ""; $mhref = base_url('/'.$articulo->slug); 
	                        if($mhref == current_url()){ 
	                         	$not = "no"; } ?>
	                           	<li class="<?php echo $not; ?>">
	                           		<a href="<?php echo base_url($articulo->slug); ?>">
	                           			<span class="label label-info"><?php echo $articulo->titulo; ?></span>
	                           		</a>
	                          	</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		<!--Fin del contenido del sitio-->

		<!--Inicio de los productos destacados-->
		<div class="span3 bordertop">
			<h2>Articulos destacados</h2>
			<?php foreach ($destacados as $destacado): ?>
 			<div class="row no-margin">
            	<div class="span12 prodcuto">
		            <div class="img-left">
		            	<a href="<?php echo base_url($destacado->slug); ?>">
		            		<img class="img-principal" src="<?php echo base_url('assets/img/'.$destacado->imagen); ?>">
		            	</a>
		        	</div>
		        	<div class="cont-right">
			            <h3><a href="<?php echo base_url($destacado->slug); ?>"><?php echo $destacado->titulo; ?></a></h3>
			            <p class="description"><?php echo substr($destacado->contenido, 0, 45); ?></p>
	            	</div>
	            </div>
            </div>
 			<?php endforeach ?>
        	<div class="mod2">
				<h2>Articulos recientes</h2>
				<?php foreach ($recientes as $reciente): ?>
	 			<div class="row no-margin">
	            	<div class="span12 prodcuto">
			            <div class="img-left">
			            	<a href="<?php echo base_url($reciente->slug); ?>">
			            		<img class="img-principal" src="<?php echo base_url('assets/img/'.$reciente->imagen); ?>">
			            	</a>
			        	</div>
			        	<div class="cont-right">
				            <h3><a href="<?php echo base_url($reciente->slug); ?>"><?php echo $reciente->titulo; ?></a></h3>
				            <p class="description"><?php echo substr($reciente->contenido, 0, 45); ?></p>
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
 		</div>
	</div>

	<?php $this->load->view('public/helper/footer.php'); ?>
	</body>
</html>
