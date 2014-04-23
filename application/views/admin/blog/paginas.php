<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class="active"><a href="<?php echo base_url('panel/post/panel_paginas'); ?>" >Panel de páginas<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
							<li class=""><a href="<?php echo base_url('panel/post/crea_pagina'); ?>" >Agregar página nueva<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
						</ul>
					</div>
				</aside>
		
				<div id="body_content" class="span10 panel_usuarios">
					<div class="page-header">
						<h2>Páginas <small>Crea, edita y elimina nuevas páginas estaticas.</small></h2>
					</div>
					<div class="row-fluid">
						<div class="well">
							<div class="span6">
								<a class="btn btn-primary" href="<?php echo base_url('/panel/post/crea_pagina'); ?>">Agregar Nueva Página<span style='margin-left:10px;'><i class='icon-plus icon-white'></i></span></a>
							</div>
							<div class="span6">
								<div id="cont_perfiles"></div>	
							</div>
						</div>
					</div>	
					<div class="row-fluid">
						<?=$paginas?>
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
