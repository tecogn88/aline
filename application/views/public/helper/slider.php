<div class="slider5">
	<?php foreach ($slider as $slide): ?>
	<div class="slide">
		<img src="<?php echo base_url('assets/img/slider/'.$slide->imagen); ?>" class="alianza_img" alt="">
		<div class="slide-contenido">
			<h2 class="titulo_slider"><?php echo $slide->nombre; ?></h2>
			<p class="lead"><?php echo $slide->descripcion; ?></p>
	        <a href="<?php echo ''.$slide->link; ?>"><i><?php echo $slide->t_link; ?></i></a>
        </div>  
    </div>
	<?php endforeach ?>
</div> 