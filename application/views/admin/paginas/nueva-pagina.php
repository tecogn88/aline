<?=$head?>
<?php echo ck_includes(); ?>
<body>
	<?=$header?>
<div class="wrapper container-fluid">
<div class="row-fluid">
	<aside id="menu_usuarios" class="span2">
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class=""><a href="<?php echo base_url('panel/post/panel_paginas'); ?>" >Panel de páginas<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
				<li class="active"><a href="<?php echo base_url('panel/post/crea_pagina'); ?>" >Agregar página nueva<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
			</ul>
		</div>
	</aside>
		
<div id="body_content" class="span10 panel_usuarios">
<div class="row-fluid">
<!-- ***************** Formulario para crear nuevo articulo  *************** -->
<form method="POST" action="<?php echo base_url('panel/post/guarda_pagina') ?>" name="frmArticuloNuevo" id="frmAddArticulo" class="form-horizontal">
<div class="span12">
<div class="well">
	<div class="span8">
		<h2><?=$titulo_pagina?> <small> agrega contenido a tu sitio.</small></h2>
	</div>
	<a class="btn btn-danger" href="<?php echo base_url('panel/post/panel_paginas/'); ?>" style="margin-left:10px;float:right;">Cancelar<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a>
    <!-- <input  style="margin-left:10px;float:right;" type="submit" class="btn btn-primary" name="btnGuardar" value="Agregar página" /> -->
    <button style="margin-left:10px;float:right;" class="btn btn-primary" name="btnGuardar" onclick="submit">Agregar página<span style='float:right;margin-left:10px;'><i class='icon-plus icon-white'></i></span></button>

</div>
<div class="well">
	<?php if (validation_errors()): ?>
		<div class="alert alert-error">
			<button type="button" style="position: relative;top: -2px;line-height: 18px;right:0px;" class="close" data-dismiss="alert">&times;</button>
			<h3>Atención!</h3>
			<ul>
				<?php echo validation_errors('<li><span class="label label-important">', '</span></li>'); ?>
			</ul>
		</div>
	<?php endif ?>
		<fieldset>
		<div class="span12">
			<div class="span6">
				<label><h4>Titulo</h4><em></em></label>
				<input placeholder="Ingresa el titulo aquí"   name="titulo" value="<?php echo set_value('titulo'); ?>" type="text" id="idtitulo" class="span12 focus"><br>
				<label><h4>Slug<small> (El slug, es el nombre del titulo en texto simple y sin espacios)</small></h4></label>
				<input placeholder='Ingresa "slug" aquí'   name="slug" value="<?php echo set_value('slug'); ?>" type="text" id="idslug" class="span12"><br>
				<label><h4>Clase css</h4></label>
				<input type="text" name="clase_css" class="span12">
			</div>
			<div class="span6">
				<label><strong><h4>Etiquetas</strong><small> (Separa con comas cada etiqueta)</small></h4></label>
				<input name="etiquetas" value="<?php echo set_value('etiquetas'); ?>" type="text" class="span12" placeholder="Inserta las etiquetas aquí..."><br>
				<input type="hidden" name="categoria" value="2">
				<!-- Plantillas agregar -->
				<label>
					<h4>Selecciona la plantilla</h4>
				</label>
				<select name="plantilla" id="plantilla" class="span12">
					<option value="1" selected>Plantilla 1</option>
					<option value="2">Plantilla 2</option>
					<option value="3">Plantilla 3</option>
				</select>
			</div>
		</div>
		<div class="span12">
			<br>
				<label><h4>Contenido</h4><em></em></label>
				<textarea name="contenido" placeholder="Ingresa aquí el contenido de tu página" id="ckeditor">
					<?php echo set_value('contenido'); ?>
				</textarea>
				<?php $ck_config = array(     
					"replace" => "#ckeditor", // selector del objeto a reemplazar     
					"options" => ck_options_paginas()     
				);
				echo jquery_ckeditor($ck_config); ?>
		</div>
		</fieldset>
</div>
</form> <!-- Fin formulario para crear nuevo articulo -->
</div> <!-- Div Span12 -->
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

	</script>
</body>
</html>
