<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3>Eventos del <?php echo $fecha ?></h3>
</div>
<div class="modal-body">
	<?php if(!$eventos){ ?>
			<p>No se encontraron eventos</p>
	<?php }else{ ?>
			<ul class="eventos-modal">
			<?php foreach ($eventos as $evento): ?>
				<li><a href="<?php echo base_url('calendario/evento/'.$evento->id); ?>">
					<span class="titulo_evento"><?php echo $evento->nombre; ?></span><br />
					<img src="<?php echo base_url('assets/media/eventos/'.$evento->imagen); ?>" width="80px;">
					<?php echo $evento->descripcion; ?>
					<hr>
					</a>
				</li>
			<?php endforeach ?>
			</ul>
	<?php } ?>
</div>
<div class="modal-footer">
	<a href="#" class="btn" data-dismiss="modal">Cerrar</a>
</div>