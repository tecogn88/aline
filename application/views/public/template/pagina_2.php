<?php $this->load->view('/public/helper/head_1.php'); ?>
<meta name="title" content="<?php echo $pagina->m_titulo; ?>">
<meta name="description" content="<?php echo $pagina->m_descripcion; ?>">
</head>
<body>
<?php $this->load->view('/public/helper/logo.php'); ?>
<?php if ($menu_top) { $this->load->view('/public/helper/menus/menu_top.php'); } ?>
<?php if ($menu_nav == TRUE) { $this->load->view('/public/helper/menus/menu_nav.php'); } ?>	
	
	<div class="container">
		<div class="row">
			<div class="span12 titulos">
				<h2 class="principal"><span>Noticias</span></h2>
			</div>	
		</div>	
		<div class="row">
			<div class="span12">
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
	                           		<a href="<?php echo base_url('blog/articulo/'.$articulo->slug); ?>">
	                           			<span class="label label-info"><?php echo $articulo->titulo; ?></span>
	                           		</a>
	                          	</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		<!--Fin del contenido del sitio-->
	</div>

	<?php if ($menu_footer == TRUE) { $this->load->view('/public/helper/menus/menu_footer.php'); } ?>
	<?php $this->load->view('public/helper/footer.php'); ?>
	</body>
</html>
