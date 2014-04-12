<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<div id="body_content" class="span12">
						<div class="well">
							<div class="span8">
								<h2><?=$titulo_pagina?> <small><?=$descripcion_pagina?></small></h2>
							</div>
							<a href="<?php echo base_url('panel/menus/'); ?>" style="float:right;margin-left:10px;" class="btn btn-danger">Cancelar<span style='float:right;margin-left:10px;'><i class='icon-ban-circle icon-white'></i></span></a>
							<button id="btnCreaItem" class="btn btn-primary" style="float:right;margin-left:10px;">Crear el nuevo menu<span style='float:right;margin-left:10px;'><i class='icon-plus icon-white'></i></span></button>							
						</div>
						<div class="row-fluid">
					    	<div id="alerta_1" class="alert alert-error pull-right span12" style="margin-top:5px; display:none;">
				            	<button type="button" class="close" data-dismiss="alert">×</button>
					            <h4 class="alert-heading">Advertencia!</h4>
					            <p>Debe ingresar un titulo para el item del menu</p>
					      	</div>
						</div>
						<div class="accordion" id="accordion2">
							<div class="accordion-group">
							  <div class="accordion-heading">
							    <a id='paso_1' class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
							      <h4>Paso No. 1</h4>
							    </a>
							  </div>
							  <div id="collapseOne" class="accordion-body in collapse" style="height: auto; ">
							    <div class="accordion-inner">
						    		<h4>1.- Selecciona el tipo de elemento:</h4>
									<select id="sel_tipo" style="margin-top:10px;" name="tipo">
										<option value='0'>Selecciona el tipo</option>
										<option value='3'>Página</option>
										<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'blog' ")) == 1 ){ ?>
											<option value='5'>Blog</option>
											<option value='4'>Articulo de Blog</option>
										<?php } ?>
										<option value='1'>Inicio</option>
										<option value='2'>Contacto</option>
										<option value='6'>URL Directa</option>
										<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'catalogos' ")) == 1 ){ ?>
											<option value="7">Catálogo</option>
										<?php } ?>
										<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'galerias' ")) == 1 ){ ?>
											<option value="8">Galería de imágenes</option>
											<option value="9">Galería de audios</option>
											<option value="12">Galería de videos</option>
										<?php } ?>
										<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'documentos' ")) == 1 ){ ?>
											<option value="10">Documentos</option>
										<?php } ?>
										<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'eventos' ")) == 1 ){ ?>
											<option value="11">Calendario</option>
										<?php } ?>
									</select>
							    </div>
							  </div>
							</div>
							<div class="accordion-group">
							  <div class="accordion-heading">
							    <a id='paso_2' class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
							      <h4>Paso No. 2</h4>
							    </a>
							  </div>
							  <div id="collapseTwo" class="accordion-body collapse" style="height: 0px; ">
							    <div  class="accordion-inner">
							    		<div class='span4'>
								    		<h4>Ingresa el titulo para el item del menu.</h4><br>
								    		<label for="titulo">Titulo para el Item</label>
								    		<input neme="titulo" id="titulo" type="text">
								    		
								    		<fieldset>
									    		<label>Id y clases para css</label>	
									    		<label for="id_css">Id(s)</label>
									    		<input neme="id_css" id="id_css" type="text">
									    		
									    		<label for="clase">Clase(s)</label>
									    		<input neme="clase" id="clase" type="text">
								    		</fieldset>
								    		<label for="islogged">Es necesario que el usuario inicie sesión?</label>
								    		<select name="islogged" id="islogged">
								    			<option value="no">No</option>
								    			<option value="si">Si</option>
								    		</select>
								    		<label for="islogged">Atributos extras</label>
								    		<input type="text" name="atributos" id="atributos">
								    		<div style="clear:both;"></div>	
							    		</div>

							    		<div class='span6'>
							    	
								    		<h5>Selecciona el padre del elemento.</h5>
								    		<?=$padres;?>
								    	</div>	
								    	<div style="clear:both;"></div>
								    	<button class="sig_paso btn" id='btn_ultimo' sigbtn="paso_3">Siguiente Paso</button>
							    		
							    	<div style="clear:both;"></div>	

							    </div>
							  </div>
							</div>
							<div class="accordion-group" id="ultimo_paso">
								<div class="accordion-heading">
									<a id='paso_3' class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
									  <h4>Paso No. 3</h4>
									</a>
								</div>
									<div id="collapseThree" class="accordion-body collapse" style="height: 0px; ">
									<div class="accordion-inner">
									    	
									    	<h4 id="MensajePaso3">Selecciona la pagina a enlazar.</h4><br>
									    	<div id="cont_tipo"></div>
									      	<div style="clear:both;"></div>
									      	<div id="divUrl" style="display:none;">
									      		<label>Ingresa la url</label>
									      		<input class="" type="text" id="url" name="url">
									      	</div>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
</body>
<script type="text/javascript">
var postID = 0;
	$(document).ready(function(){
		

		$(function(){

			$("#sel_tipo").on("change",function(e){
				e.preventDefault();
				var mTipo = $(this);
				var valor_tipo = mTipo.val();

				if(valor_tipo == '0'){ 
					alert("Seleccione un tipo por favor"); 
					mTipo.focus(); 
					return false; 
				}

				switch(valor_tipo){
					case "3":
						$("#divUrl").hide();
						$("#cont_tipo").load("<?php echo base_url('panel/menus/get_paginas/2');?>");
						$("#paso_2").click();
					break;
					case "4":
						$("#divUrl").hide();
						$("#cont_tipo").load("<?php echo base_url('panel/menus/get_paginas/1');?>");
						$("#paso_2").click();
					break;
					case "5":																	
						$("#divUrl").hide();
						$("#ultimo_paso").hide();
						$('#btn_ultimo').hide();
						$("#cont_tipo").html("");
						$("#paso_2").click();
					break;
					case "1":
						$("#divUrl").hide();
						$("#ultimo_paso").hide();
						$('#btn_ultimo').hide();
						$("#cont_tipo").html("");
						$("#paso_2").click();
					break;
					case "2":
						$("#divUrl").hide();
						$("#ultimo_paso").hide();
						$('#btn_ultimo').hide();
						$("#cont_tipo").html("");
						$("#paso_2").click();
					break;
					case "6":
						$("#cont_tipo").html(""); 
						$("#divUrl").show();
						$("#paso_2").click();
					break;
					case "7":
						$("#divUrl").hide();
						$("#cont_tipo").load("<?php echo base_url('panel/menus/get_catalogos_menus'); ?>");
						$("#paso_2").click();
					break;
					case "8":
						$("#divUrl").hide();
						$("#cont_tipo").load("<?php echo base_url('panel/menus/get_galerias_imagenes'); ?>");
						$("#paso_2").click();
					break;
					case "9":
						$("#divUrl").hide();
						$("#cont_tipo").load("<?php echo base_url('panel/menus/get_galerias_audios'); ?>");
						$("#paso_2").click();
					break;
					case "10":
						$("#divUrl").hide();
						$("#ultimo_paso").hide();
						$('#btn_ultimo').hide();
						$("#cont_tipo").html("");
						$("#paso_2").click();
					break;
					case "11":
						$("#divUrl").hide();
						$("#ultimo_paso").hide();
						$('#btn_ultimo').hide();
						$("#cont_tipo").html("");
						$("#paso_2").click();
					break;
					case "12":
						$("#divUrl").hide();
						$("#cont_tipo").load("<?php echo base_url('panel/menus/get_galerias_videos'); ?>");
						$("#paso_2").click();
					break;
				}


			}); // End Click
		}); // End Function anonima
	

		$(".btnSel").live("click",function(e){
			e.preventDefault();
			$(".btnSel").removeClass("badge-success");
			$(this).addClass("badge-success");


			var mId = $(this).attr("id_post");
			$("tr").css("font-weight","normal");
			$("#mf_"+ mId).css("font-weight","bold");

			postID = mId;
		})

		$(".btnSeltr").live("click",function(e){
			e.preventDefault();
			$(".btnSel").removeClass("badge-success");
			$("i").removeClass("icon-ok-sign").addClass("icon-asterisk");

			$(this).find(".btnSel:first").addClass("badge-success");

			
			$(this).find(".btnSel:first > i").removeClass("icon-asterisk");
			$(this).find(".btnSel:first > i").addClass("icon-ok-sign");

			var mId = $(this).find(".btnSel:first").attr("id_post");
			$("tr").css("font-weight","normal").removeClass("green");
			$(this).css("font-weight","bold").addClass("green");
			postID = mId;
		})

		$(".sig_paso").on("click",function(e){
			e.preventDefault();
			if($("#titulo").val() == ""){ 
				$("#alerta_1").fadeIn('slow').delay(2000).fadeOut('slow');
				return false;
			}
			var sig = $(this).attr("sigbtn");
			$("#"+sig).click();
		});


		$(".clPadre").on('click',function(){
			$(".clPadre").removeClass('padre_sel');
			$(this).addClass('padre_sel');
		});

		$("#btnCreaItem").on("click",function(e){
			e.preventDefault();
			if($("#titulo").val() == ""){ 
				$("#alerta_1").fadeIn('slow').delay(2000).fadeOut('slow');
				return false;
			}else{
			var vidMenu = "<?=$menu_id?>";
			var vidPost = $(".badge-success").attr("id_post");
			var vTitulo = $("#titulo").val(); 
			var vPadre  = $("#menuPadres").find('.padre_sel').attr("idItem");
			var vidTipo = $("#sel_tipo").val();
			var vOrden  = 0;
			var vid_css = $("#id_css").val();
			var vclase = $("#clase").val();
			var visLogged = $("#islogged").val();
			var vatributos = $("#atributos").val();
			var vUrl = $("#url").val();
			if((vidTipo == "8") || (vidTipo == "9") || (vidTipo == "12")){
				vidPost = $("#galeria").val();
			}
			//var orden = $("#orden").val();
			if(vPadre == undefined){
				vPadre = 0;
			}

			var vDatos = "idmenu="+ vidMenu +"&idpost="+ vidPost +"&titulo="+ vTitulo+"&padre="+vPadre+"&tipo="+vidTipo+"&orden="+vOrden+"&id_css="+vid_css+"&clase="+vclase+"&misLogged="+visLogged+"&atributos="+vatributos+"&murl="+vUrl;
			//alert(vDatos);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('panel/menus/crea_item_menu') ?>",
				data: vDatos,
				success: function(datos){
					alert("El elemento del menu se creo satisfactoriamente.");
					location.href="<?php echo base_url('panel/menus') ?>";
				}
			});
			}
		});

		$(".alert").alert();
	});// End Ready document
</script>
</html>
