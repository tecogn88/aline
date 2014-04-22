<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
		<!-- Display messages -->
		<?php if(isset($success)){ ?>
			<div class="row-fluid">
				<div class="span12 alert alert-success">
					<?php echo $success; ?>
				</div>
			</div>
		<?php } ?>
		<?php if(isset($error)){ ?>
			<div class="row-fluid">
				<div class="span12 alert alert-error">
					<?php echo $error; ?>
				</div>
			</div>
		<?php } ?>
		<!-- Fin display messages -->
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<?php echo $columna_izq; ?>					
				</aside>
				<div id="body_content" class="span10 panel_usuarios">
					<div class="well">
						<div class="row-fluid">
							<div class="span6">
								<h2>Slider <small>Agrega y elimina slides</small></h2>
							</div>
							<div class="pull-right">
								<a id="btn_crea_banner" class="btn btn-primary" href="<?php echo base_url('panel/slider/nuevoSlide'); ?>">Nuevo Slide<span style='margin-left:10px;'><i class='icon-plus icon-white'></i></span></a>
								<a class="btn btn-inverse" href="<?php echo base_url('panel/slider/configuracionSlider'); ?>">Configuracion del slider<span style='margin-left:10px;'><i class='icon-wrench icon-white'></i></span></a>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<?php if($slides == FALSE){ ?>
							<div class="alert">
							  	<strong>No se han creado slides!</strong>
							</div>
							<?php }else{ ?>
							<div class="row-fluid">
								<?php $contador = 0; ?>
								<div class="accordion" id="accordion2">
									<?php foreach ($slides as $slide){ ?>
										<?php $contador++;
										?>
										<div class="accordion-group">
										    <div class="accordion-heading padres" rel="tooltip" title="Haga clic para ver la información del slide">
										    	<div class="row-fluid">
											    	<div class="span9">
												      	<a style="color:#555;text-decoration:none;" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $slide->id; ?>">
												        <?php if(strlen( trim($slide->nombre) ) > 20 ) { ?>
															<h4 style="margin-bottom:5px;"><?php echo substr($slide->nombre, 0,15).'...'; ?></h4>
														<?php }else{ ?>
															<h4 style="margin-bottom:5px;"><?php echo $slide->nombre; ?></h4>
														<?php } ?>
												      	</a>
											    	</div>
												    <div class="span3" style="text-align:right;padding:5px;">
												    	<a class="btn" href="<?=base_url('panel/slider/editaSlide/'.$slide->id)?>" rel="tooltip" title="Editar slide:<br /><?=$slide->nombre?>">editar</a>
												    	<a class="btn btn-danger btn-small" href="<?=base_url('panel/slider/eliminaSlide/'.$slide->id)?>" rel="tooltip" title="Borrar slide:<br /><?=$slide->nombre?>">eliminar</a>
												    </div>
										    	</div>
										    </div>
										    <div id="collapse<?php echo $slide->id; ?>" class="accordion-body collapse in">
										      <div class="accordion-inner">
										        <div class="span12 thumbnail" style="text-align:center;margin-bottom:10px;">
													<div class="span5">
														<?php if($slide->descripcion){ ?>
															<p><b>Texto</b></p>
															<p><?php if(strlen( trim($slide->descripcion) ) > 150 ) { ?>
																<?php echo substr($slide->descripcion, 0,148).'...'; ?>
															<?php }else{ ?>
																<?php echo $slide->descripcion; ?>
															<?php } ?></p>
														<?php } ?>
														<?php if ($slide->link) { ?>
															<p>
															<b>Link:</b><br><br>
															<span class="label"><a href="<?php echo $slide->link; ?>" target="_blank"><?php echo $slide->link; ?></a></span>
															</p>
															<hr>
														<?php } ?>
													</div>
													<div class="span7 imagen-slide">
														<img src="<?php echo base_url('assets/img/slider/'.$slide->imagen); ?>">
														<br>
													</div>
										      </div>
										    </div>
										 </div>
									<?php } ?><!-- Fin foreach -->
								</div>
							</div>
					<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
	<!-- End div class="wrapper container" -->
<script type="text/javascript">

	$(".collapse").collapse();
		
		$(function(){
			$(".btndel").click(function(e){
				e.preventDefault();
				if(!confirm("Esta seguro que desea eliminar a este slide?")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});
		
		$(".ver_items").on("click",function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			$("#items_menu_div").html("<img src='<?php echo base_url('assets/admin/img/139.gif');?>' >"); 
			$("#items_menu_div").load(href);
		});

		$("a[rel='tooltip']").tooltip();

		$(function(){
			$(".cont_items_first").live("mouseover",function(){
				$("a.item_link").hide();
				var div = $(this).find("div.cont_act");
				div.find("a.item_link").show();
			});
			$(".cont_items_first").live("mouseout",function(){
				$("a.item_link").hide();
			});

		});


		$(function(){
			$(".act_eliminar").live("click",function(e){
				e.preventDefault();
				var valorId = $(this).closest("div.cont_items_first").find("a.clPadre:first").attr("iditem");
				var answer = confirm("Esta seguro que desea eliminar definitivamente este elemento?")
				if (answer){
					$.post("<?php echo base_url('panel/menus/borrar_item'); ?>", { id: valorId});
					$(this).closest("li").remove();
				}				
			});
		});

		$(function(){
			$(".act_activar").live("click",function(e){
				e.preventDefault();
				var icono = $(this).find("i");
				var valorInicial = $(this).attr("estado");
				var idItem = $(this).closest("div.cont_items_first").find("a.clPadre:first").attr("iditem");
				var dirFuncion = "<?php echo base_url('panel/menus/activa_item') ?>";
				$.post(dirFuncion, { estado: valorInicial,idItem:idItem});
				if(valorInicial == 1){
					icono.addClass("icon-thumbs-down");
					icono.removeClass("icon-thumbs-up");
					$(this).attr("estado","0");
					$(this).closest("div.cont_items_first").find("a.clPadre:first").css("color","gray");
				}else{
					icono.addClass("icon-thumbs-up");
					icono.removeClass("icon-thumbs-down");
					$(this).attr("estado","1");
					$(this).closest("div.cont_items_first").find("a.clPadre:first").css("color","#08C");
				}				
								
			});
		});
</script>
</body>
</html>
