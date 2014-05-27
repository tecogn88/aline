<?=$head?>
<body>
<?=$header?>
<div class="wrapper container-fluid">
	<div class="row-fluid">
		<aside id="menu_usuarios" class="span2">
			<div class="tabbable tabs-left">
				<ul class="nav nav-tabs">
					<li class=""><a href="<?php echo base_url('panel/blog/'); ?>" >Panel Blog<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></a></li>
					<li class=""><a href="<?php echo base_url('panel/blog/panel_categorias'); ?>" >Panel de categorias<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></a></li>
				</ul>
			</div>
		</aside>
		<div id="body_content" class="span10 panel_usuarios">
			<?php echo $this->session->flashdata('warning'); ?>
			<form method="POST" action="<?php echo base_url('panel/blog/GuardaConfiguracion') ?>" class="form-horizontal" enctype="multipart/form-data">
				<div class="well">
					<div class="span9">
						<h2><?php echo $titulo_pagina; ?><small> <?php echo $descripcion_pagina; ?></small></h2>
					</div>
					<div class="pull-right">
						<button class="btn btn-primary">Guardar</button>
						<a class="btn btn-danger" href="<?php echo base_url('panel/blog/'); ?>">Terminar</a>	
					</div>
				</div>
				<div class="row-fluid">
					<div class="span3">
						<label><h4>Número de articulos por página</h4></label>
						<input type="number" name="num_paginacion" value="<?php echo $paginacion; ?>">
						<label><h4>Meta-titulo</h4></label>
						<input type="text" name="m_titulo" value="<?php echo $m_titulo_blog; ?>">
					</div>
					<div class="span3">
						<label><h4>Número de articulos recientes</h4></label>
						<input type="number" name="num_recientes" value="<?php echo $no_recientes; ?>">
						<label><h4>Mostrar Breadcrumbs</h4></label>
						<div class="btn-group" data-toggle="buttons-radio">
							<?php $bread = ''; $bread1 = ''; if ($breadcrumbs == 1) {$bread1 = 'active';}else{$bread = 'active';} ?>
						  	<button id='bread_si' type="button" class="btn btn-inverse <?php echo $bread1 ?>"><i id='icon_bread_si' class="icon-ok icon-white"></i></button>
						  	<button id='bread_no' type="button" class="btn btn-inverse <?php echo $bread ?>"><i id='icon_bread_no' class="icon-ban-circle icon-white"></i></button>
						</div>
						<input name="breadcrumbs" id="breadcrumbs" type="hidden" value="<?php echo $breadcrumbs; ?>">
					</div>
					<div class="span6">
						<label><h4>Meta-descripción</h4></label>
						<textarea name="m_descripcion" rows="5" class="span12"><?php echo $m_descripcion_blog; ?></textarea>
					</div>
				</div>
			</form>	
		</div>	
		<!-- Fin body_content -->	
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> <!-- Row fluid general" -->
</div>	<!-- End div class="wrapper container" -->

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

	$(function(){
		$("#idslug").focus(function(){
			var slug = $("#idtitulo").val();
			$(this).val(convertToSlug(slug));
		});
	});


	function convertToSlug(Text)
	{
	    return Text
	        .toLowerCase()
	        .replace(/ /g,'-')
	        .replace(/[^\w-]+/g,'')
	        ;
	}


	function makeSlug(slugcontent)
	{
	    // convert to lowercase (important: since on next step special chars are defined in lowercase only)
	    slugcontent = slugcontent.toLowerCase();
	    // convert special chars
	    var   accents={a:/\u00e1/g,e:/u00e9/g,i:/\u00ed/g,o:/\u00f3/g,u:/\u00fa/g,n:/\u00f1/g}
	    for (var i in accents) slugcontent = slugcontent.replace(accents[i],i);

		var slugcontent_hyphens = slugcontent.replace(/\s/g,'-');
		var finishedslug = slugcontent_hyphens.replace(/[^a-zA-Z0-9\-]/g,'');
	    finishedslug = finishedslug.toLowerCase();
	    return finishedslug;
	}

	$("#pag_inicio").on("change",function(){
		if($(this).is(":checked")){
			$(this).val("1");
		}else{
			$(this).val("0");
		}
	});

	$(document).on("ready",function(){
		if($('#breadcrumbs').val() == 1){$('#icon_bread_no').removeClass('icon-white');}
		else{$('#icon_bread_si').removeClass('icon-white');}
	});
	$("#bread_si").on("click",function(){$("#breadcrumbs").val(1);$('#icon_bread_no').removeClass('icon-white');$('#icon_bread_si').addClass('icon-white');});
	$("#bread_no").on("click",function(){$("#breadcrumbs").val(0);$('#icon_bread_si').removeClass('icon-white');$('#icon_bread_no').addClass('icon-white');});
	$( "#cambio" ).delay(3500).slideUp('slow');
</script>
</body>
</html>
