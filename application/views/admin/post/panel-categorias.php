<?=$head?>
<?php echo ck_includes(); ?>
<body>
	<?=$header?>
<div class="wrapper container-fluid">
<div class="row-fluid">
	<aside id="menu_usuarios" class="span2">
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class=""><a href="<?php echo base_url('panel/post/'); ?>" >Panel de articulos<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
				<li class=""><a href="<?php echo base_url('panel/post/crea_articulo'); ?>" >Agregar articulo<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
				<li class="active"><a href="<?php echo base_url('panel/post/panel_categorias'); ?>" >Panel de categorias<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
				<li class=""><a href="<?php echo base_url('panel/post/crea_categoria'); ?>" >Crear categoria<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
			</ul>
		</div>
	</aside>	
<div id="body_content" class="span10 panel_usuarios">
	<div class="page-header">
		<h2><?=$titulo_pagina?> <small> <?=$descripcion_pagina?></small></h2>
	</div>
	<div class="row-fluid">
		<div class="well">
			<div class="span6">
				<a class="btn btn-primary" href="<?php echo base_url('/panel/post/crea_categoria'); ?>">Crear categoria<span style='margin-left:10px;'><i class='icon-plus icon-white'></i></span></a>
			</div>
			<div class="span6">
				<div id="cont_perfiles"></div>	
			</div>
		</div>
	</div>				
	<div class="row-fluid">
<div class="span12">
	<?=$categorias?>
</div> 
</div>  <!-- Fin Row fluid  contenedor del form-->
</div>	<!-- Fin body_content -->
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
</div> <!-- Row fluid general" -->
</div>	<!-- End div class="wrapper container" -->
	<script type="text/javascript">
		$("a[rel='tooltip']").tooltip();
		$(function(){
			$(".btndel").click(function(e){
				e.preventDefault();
				if(!confirm("Esta seguro que desea eliminar esta categoría?")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});
	</script>
</body>
</html>
