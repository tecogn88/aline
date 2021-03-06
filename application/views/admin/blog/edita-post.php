<?=$head?>
<?php echo ck_includes(); ?>
<body>
	<?=$header?>
<div class="wrapper container-fluid">
<div class="row-fluid">
	<aside id="menu_usuarios" class="span2">
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class="active"><a href="<?php echo base_url('panel/blog/'); ?>" >Panel de articulos<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
				<li class=""><a href="<?php echo base_url('panel/blog/panel_categorias'); ?>" >Panel de categorias<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
			</ul>
		</div>
	</aside>		
<div id="body_content" class="span10 panel_usuarios">
<!-- guarda_edicion -->
<form method="POST" action="<?php echo base_url('panel/blog/guarda_edicion_articulo/'.$row->id); ?>" name="frmArticuloNuevo" id="frmAddArticulo" class="form-horizontal" enctype="multipart/form-data">
	<div class="row-fluid">
		<div class="span12">
			<div class="well">
				<div class="span8">
					<h2><?=$titulo_pagina?> <small> <?=$descripcion_pagina?></small></h2>
				</div>
				<div class="pull-right">
					<!-- <input style="margin-left:10px;" class="btn btn-primary btn-medium" type="submit" name="btnGuardar" value="Guardar"/>
					<a href="<?php echo base_url('/panel/blog'); ?>" class="btn btn-danger">Cancelar</a> -->
					<a href="<?php echo base_url('panel/blog'); ?>" class="btn btn-danger" style="margin-left:10px;float:right;">Cancelar<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a>
					<button style="margin-left:10px;float:right;" class="btn btn-primary" name="btnGuardar" onclick="submit">Guardar<span style='float:right;margin-left:10px;'><i class='icon-ok-sign icon-white'></i></span></button>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
<div class="span12">
	<div class="span9">
		<div class="well">
<?php echo validation_errors('<div class="error"><span class="label label-important">', '</span></div>'); ?>
		<fieldset>
			<?php if ($row->imagen) { ?>
			<div class="imagen-articulo" class="thumbnail">
				<img src="<?php echo base_url('assets/img/'.$row->imagen); ?>">
			</div>
			<br>
			<?php }else{ ?>
				<div class="alert alert-block">
				  <h4>Éste articulo no tiene imagen!</h4>
				</div>
			<?php } ?>
			<b>Imagen:</b> <input type="file" name="imagen">
			<br><br>
			<div class="row-fluid">
			<div class="span6">
			<label><h4>Titulo</h4><em></em></label>
			<input placeholder="Ingresa el titulo aquí"   name="titulo" value="<?php if(set_value('titulo') != ""){echo set_value('titulo');}else{echo $row->titulo;} ?>" type="text" id="idtitulo" class="span12 focus">
			</div>		
			<div class="span6">
			<label><h4>Slug<small> (Slug, es el nombre del titulo sin espacios)</small></h4></label>
			<input placeholder='Ingresa "slug" aquí'   name="slug" value="<?php if(set_value('slug') != ""){echo set_value('slug');}else{echo $row->slug;} ?>" type="text" id="idslug" class="span12">
			</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<label><strong><h4>Autor</h4></strong><em></em></label>
					<select name="id_autor" id="id_autor" class="span12">
					<?php
						foreach ($autores->result() as $autor){
							if ($autor->id == $id_autor){ ?>
								<option value="<?=$autor->id?>" selected><?=$autor->nombre?></option>
							<?php }else{ ?>
								<option vlaue="0">Anónimo</option>
								<option value="<?=$autor->id?>"><?=$autor->nombre?></option>
							<?php }
						} ?>
					</select>
				</div>
				<div class="span6">
					<label><strong><h4>Meta-tiulo</h4></strong><em></em></label>
					<input name="m_titulo" value="<?php if(set_value('m_titulo') !=""){echo set_value('m_titulo');} else {echo $row->m_titulo;} ?>" type="text" class="span12">
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<br>
					<label><strong><h4>Meta-descripción</h4></strong></label>
					<textarea name="m_descripcion" class="span12"><?php
						 if(set_value('m_descripcion') != ""){echo set_value('m_descripcion');} else{echo $row->m_descripcion;} 
					 ?></textarea>
				</div>	
			</div>
			<br>
			<label><h4>Contenido</h4><em></em></label>
			<textarea name="contenido"  placeholder="Ingresa aquí el contenido de tu artículo" class="span10" id="ckeditor" rows="15" >
			<?php 
				if(set_value('contenido') != ""){echo set_value('contenido'); }
				else{echo $row->contenido;}
			?>
			</textarea>
			<?php $ck_config = array(     
				"replace" => "#ckeditor" // selector del objeto a reemplazar     
				, "options" => ck_options()     
			);
			echo jquery_ckeditor($ck_config); ?>
		</fieldset>
</div>
</div>
<div class="span3">

	<div class="well">
	<label><strong><h4>Seleccione una categoría</h4></strong><em></em></label>
				<select name="id_categoria" id="id_categoria">
				<?php
					foreach ($categorias->result() as $categoria){
						if ($categoria->id == $id_categoria){ ?>
							<option value="<?=$categoria->id?>" selected><?=$categoria->nombre?></option>
						<?php }else{ ?>
							<option value="<?=$categoria->id?>"><?=$categoria->nombre?></option>
						<?php }
					} ?>
				</select><?php //echo $id_categoria; ?>
	<p class="help-block">Categoría del artículo</p>
	</div>

	<div class="well">
		<label for="pag_inicio">
			<strong>
				<h4>En página de inicio	<input id="pag_inicio" <?php if((int)$row->pag_inicio == 1){echo "checked=checked";} ?> value="<?php echo $row->pag_inicio ?>" type="checkbox" name="pag_inicio" /></h4>
			</strong>
		</label>
	</div>

	<div class="well">
	<label><strong><h4>Etiquetas</h4></strong><em></em></label>
	<input name="etiquetas" value="<?php if(set_value('etiquetas') != ""){echo set_value('etiquetas');}else{echo $row->etiquetas;} ?>" type="text" class="span12" placeholder="Inserta las etiquetas aquí...">
	<p class="help-block">Separa con comas cada etiqueta.</p>
	</div>

	<input type="hidden" name="id" value="<?php if(set_value('id') != ""){ echo set_value('id'); }else{echo $row->id;} ?>">
				<input type="hidden" name="categoria" value="1">
				<input type="hidden" name="slug_old" value="<?php if(set_value('slug') != ""){ echo set_value('slug'); }else{echo $row->slug;} ?>">


</div>
</form> <!-- Fin formulario para crear nuevo articulo -->
</div>  <!-- Fin Row fluid  contenedor del form-->
</div>
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

		$("#pag_inicio").on("change",function(){
			if($(this).is(":checked")){
				$(this).val("1");
			}else{
				$(this).val("0");
			}
		});

	</script>

</body>
</html>
