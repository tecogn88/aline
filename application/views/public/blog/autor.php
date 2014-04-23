<?php $this->load->view('/public/helper/head.php'); ?>
<?php $this->load->view('/public/helper/logo.php'); ?>
<?php if ($menu_top) { $this->load->view('/public/helper/menus/menu_top.php'); } ?>
<?php if ($menu_nav == TRUE) { $this->load->view('/public/helper/menus/menu_nav.php'); } ?>	

<!--  Contenido home  -->
<div class="container">
	<div class="row">
			<div class="span12 titulos">
				<h2 class="principal"><span><?php echo $autor->row('nombre'); ?></span></h2>
			</div>	
		</div>	
<div class="row">

	<!-- Home articulos  -->

	<div class="span9">
		<div class="span12">
			<h2>Sobre <?php echo $autor->row('nombre'); ?></h2>
			<div class="span3">
				<img src="<?php echo base_url('assets/media/usuarios/'.$autor->row('imagen')); ?>">
			</div>
			<div class="span6">
				<p><strong>Nombre:</strong> <?php echo $autor->row('nombre'); echo " ".$autor->row('apellidos'); ?></p>
				<p><strong>Nivel:</strong> <?php if ($autor->row('perfil') == 1) {
						echo "Administrador";
					} ?>
					<?php if ($autor->row('perfil') == 2) {
						echo "Editor";
					} ?>
				</p>
				<p><strong>Contacto:</strong> 
					<a href="mailto:<?php echo $autor->row('email'); ?>"><?php echo $autor->row('email'); ?></a>
				</p>
				<?php if (!is_null($autor->row('descripcion'))): ?>
					<p><strong>Descripcion:</strong> <?php echo $autor->row('descripcion'); ?></p>
				<?php endif ?>
				<?php if (!is_null($autor->row('hobies'))): ?>
					<p><strong>Gustos y aficiones:</strong> <?php echo $autor->row('hobies'); ?></p>
				<?php endif ?>
			</div>
		</div>
		<div class="span12">
			<?php if (strlen($autor->row('facebook'))>1 | strlen($autor->row('twitter'))>1 | strlen($autor->row('g_plus'))>1): ?>
				<strong>Redes Sociales</strong>
			<?php endif ?>
				<p>
					<?php if (strlen($autor->row('facebook'))>1): ?>
						<a href="<?php echo $autor->row('facebook'); ?>" target="_blank"><img src="<?php echo base_url('assets/img/fb-li.jpg'); ?>"></a>
					<?php endif ?>
					<?php if (strlen($autor->row('twitter'))>1): ?>
						<a href="<?php echo $autor->row('twitter'); ?>" target="_blank"><img src="<?php echo base_url('assets/img/tw-li.jpg'); ?>"></a>
					<?php endif ?>
					<?php if (strlen($autor->row('g_plus'))>1): ?>
						<a href="<?php echo $autor->row('g_plus'); ?>" target="_blank"><img src="<?php echo base_url('assets/img/yt-li.jpg'); ?>"></a>
					<?php endif ?>
				</p>
			<h2>Sus publicaciones:</h2>
			<?php foreach ($publicaciones as $post):
			if ($post->tipo == 1) { ?>
				<a href="<?php echo base_url('blog/articulo/'.$post->slug) ?>"><span class="label"><?php echo $post->titulo; ?></span></a>
			<?php } else { ?>
				<?php } ?>
			<?php endforeach ?>
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
	            		<a href="<?php echo base_url('blog/categoria/'.$categoria->id); ?>"><h3><?php echo $categoria->nombre; ?></h3></a>
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


