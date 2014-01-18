<?php $this->load->view('/public/helper/head.php'); ?>
<?php $this->load->view('/public/helper/main_menu.php'); ?>
	
	<div class="container">
		<div class="row">
			<div class="span12 titulos">
				<h2 class="principal"><span><?=$pagina->titulo;?></span></h2>
			</div>	
		</div>	
		<div class="row">
			<div class="span12">
				<!-- <span><?php echo $this->alinecms->dameFechaFormato($pagina->fecha_publicacion); ?></span><br />	 -->	
				<?php if ($pagina->imagen != '' && strlen($pagina->imagen) > 5): ?>
				<img src="<?php echo base_url('assets/img/'.$pagina->imagen); ?>">
				<?php endif ?>
				<p><?=$pagina->contenido;?></p>
			</div>
		<!--Fin del contenido del sitio-->

		<!--Inicio de los productos destacados-->
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
	</div>

	<?php $this->load->view('public/helper/footer.php'); ?>
	</body>
</html>
