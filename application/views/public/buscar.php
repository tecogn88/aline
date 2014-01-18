<?php $this->load->view('/public/helper/head.php'); ?>
<?php //$this->load->view('public/helper/main_menu.php'); ?>
<?=$main_menu?>
<?php //$this->load->view('public/helper/slider.php'); ?>

<!--  Contenido home  -->
<div class="container">
	<div class="row">
			<div class="span12 titulos">
				<h2 class="principal"><span>Busqueda</span></h2>
			</div>	
		</div>	
<div class="row">

	<!-- Home articulos  -->

	<!-- <div class="span9">
		<?php if($articulos!=false){ ?>
			<?php foreach ($articulos as $post): ?>
				<div class="nota-secundaria">
					<h2 class="titulos busqueda"><a href="<?php echo base_url($post->slug); ?>"><?php echo $post->titulo; ?></a></h2>
					<i id="fecha"><span><?php echo $this->alinecms->dameFechaFormato($post->fecha_publicacion); ?></span></i>
					<div class="secundaria-box">
						<div class="sec-cont">
							<div class="intro-txt-2">
								<?php 
								$contenido = strip_tags($post->contenido);
								$contenido = substr($contenido, 0, 150);
								echo $contenido;
								if (strlen($contenido)>150) {
									echo "...";
								}
								 ?>
								<a class="read-more" href="<?php echo base_url($post->slug); ?>">+ Leer más</a>
							</div> 
					    </div>
					</div>
				</div>
			<?php endforeach ?>
		<?php }else{
			echo "NO se encontraron resultados";
		} ?> -->

		<!--<?php if($productos!=False){ ?>
			<?php foreach ($productos as $producto): ?>
				<div class="nota-secundaria">
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
				</div>
			<?php endforeach ?>
		<?php } ?>
		<?php if (!$productos && !$articulos): ?>
			<p>No se encontraron resultados</p>
		<?php endif ?>
		<div id="paginacion">
		<?php echo $paginacion; ?>-->
	</div>
	</div>
		<!-- <div class="span3 bordertop">
			<h2>Productos destacados</h2>
			<?php  $producto = $this->catalogos->get_destacados();
        	foreach ($producto->result() as $row){
            ?>
            <div class="row no-margin">
            	<div class="span12 prodcuto">
		            <div class="img-left">
		            	<img src="<?php echo base_url('assets/img/catalogo/'.$row->img_cat); ?>">
		        	</div>
		        	<div class="cont-right">
			            <h3><?php echo substr($row->nombre, 0, 25); ?></h3>
			            <p class="description"><?php echo substr($row->descripcion, 0, 45); ?></p>
			            <a class="read-more" href="<?php echo base_url('/tienda/producto/'.$row->id); ?>">+ Ver Más</a>
	            	</div>
	            </div>
            </div>
            <?php  } ?>
        </div> -->

	<!--  /Home articulos  -->
	<!--  Derecha   -->
	
	

	<!--  /Derecha  -->
</div>
</div>

<!--  /Contenido home  -->

<?php $this->load->view('/public/helper/footer.php'); ?>


