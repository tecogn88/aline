<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class="active"><a href="<?php echo base_url('panel/menus'); ?>" >Panel de menús<span class='label label-default' style='float:right'><i class='icon-list icon-white'></i></span></a></li>
							<li class=""><a href="<?php echo base_url('panel/menus/crea_menu'); ?>" >Agregar menú nuevo<span class='label label-default' style='float:right'><i class='icon-plus icon-white'></i></span></a></li>
						</ul>
					</div>
				</aside>		
				<div id="body_content" class="span10 panel_usuarios">
					<div class="well">
						<div class="row-fluid">
							<div class="span6">
								<h2>Menús <small>Crea edita y elimina menus de navegación</small></h2>
							</div>
							<div class="pull-right">
								<a class="btn btn-primary" href="<?php echo base_url('panel/menus/crea_menu'); ?>">Nuevo Menú<span style='margin-left:10px;'><i class='icon-plus icon-white'></i></span></a>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<?php if($menues == FALSE){ ?>
						<div class="alert">
						  	<strong>Aún no hay menus creados</strong>
						</div>
						<?php }else{ ?>
						<div class="row-fluid">
							<div class="accordion" id="accordion2">
								<?php foreach ($menues->result() as $menu){ ?>
									<div class="accordion-group">
									    <div class="accordion-heading padres" rel="tooltip" title="Haga clic para ver la información del menu" style="cursor:pointer;">
									    	<div class="row-fluid">
									    		<div class="span9">
										      		<a style="color:#555;text-decoration:none;" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $menu->id; ?>">
										        		<h4><?php echo $menu->titulo; ?></h4>
										      		</a>
									    		</div>
									    		<div class="span3" style="text-align:right;padding:5px;">
									    			<a class='btn btn-small' href='<?php echo base_url("/panel/menus/agrega_item/".$menu->id); ?>' rel='tooltip' title='Agrega items al menú: <br/>"<?php echo $menu->titulo; ?>"'>Agregar menu <i class='icon-plus icon-black'></i></a>
													<a class='btn btn-danger btn-small btndel' href='<?php echo base_url("/panel/menus/borra_menu/".$menu->id); ?>' rel='tooltip' title='Borrar menú: <br/>"<?php echo $menu->titulo; ?>"'>Eliminar <i class='icon-remove icon-white'></i></a>
									    		</div>
									    	</div>
									    </div>
									    <div id="collapse<?php echo $menu->id; ?>" class="accordion-body collapse in">
									      	<div class="accordion-inner">
									      		<div class="row-fluid">
									      			<div class="span3 well" style="text-align:center">
												        <h4>Detalles</h4>
												        <div class="row-fluid">
												        	<div class="span6" style="text-align:right;">
												        		<p><b>ID: </b></p>
												        		<p><b>Clase CSS: </b></p>
												        		<p><b>Ubicación: </b></p>
												        	</div>
												        	<div class="span6" style="text-align:left;">
														        <p><?php echo $menu->id ?></p>
														        <p><?php echo $menu->clase; ?></p>
														        <p><?php echo $menu->ubicacion ?></p>
												        	</div>
												        </div>
												        <hr>
												        <a class="btn btn-info" href='<?php echo base_url("/panel/menus/edita_menu/".$menu->id); ?>' rel='tooltip' title='Editar menú:  <br/>"<?php echo $menu->titulo; ?> "'>Editar <i class="icon-edit icon-white"></i></a>
												      		<!-- <a class='btn btn-primary' id='ver_items' href='<?php echo base_url("/panel/menus/elementosMenu/".$menu->id); ?>'>Ver menús</a> -->
									      			</div>
									      			<div class="span9 well" id="items_contenedor">
														<table id='tblMenus' class='table table-striped  table-bordered ' style="margin-bottom:0px;">
															<thead>
																<tr style='background-color: #D9EDF7;'>
																	<th class="span4">Nombre</th>
																	<th class='span2' style='text-align: center;'>Activar/Desactivar</th>
																	<th class='span2' style='text-align: center;'>Orden</th>
																	<th class='span2' style='text-align: center;'>Editar</th>
																	<th class='span2' style='text-align: center;'>Eliminar</th>
																</tr>
															</thead>
														</table>
														<div id="elementosmenus">
															<div class="row-fluid" style="margin:5px;">
																<?php $items = $this->menu->get_ItemsMenu($menu->id,$padre = 0); ?>
																<?php $idMenu = $menu->id; ?>
																<ul style='list-style:none;margin:0;'>
																	<?php if($padre == 0){ ?><ul id='menuPadres' style='list-style:none;margin:0;'><?php } ?>
																		<?php if($items->num_rows == 0 and $padre == 0){ ?>
																			<ul class='nav nav-pills nav-stacked' style='list-style:none;margin:0;'>
																				<li idItem='0' class='item_menu_' idItem='0'>No hay elementos en éste menú.</li>
																			</ul><br/>
																		<?php } ?> 
																		<?php foreach($items->result() as $row){
																			$hijos = $this->menu->get_hijos($idMenu,$row->idItem);
																			$estilo = "";
																			if ($row->estado == 1) {$estilo = "color:gray";}
																				$iconito = 'icon-thumbs-up'; $color="";
																				if($row->estado == 0){$iconito = "icon-thumbs-down";$color="style='color:gray;'";}
																					if($padre == 0){?>
																						<li class='soyPadre'>
																							<div class="row-fluid" style="border-bottom: solid 1px #dfdfdf;padding-top: 5px;">
																								<div class='span6 cont_items_first' style='text-align: left;'>
																									<span class='label label-inverse'><a <?php echo $color; ?> style='color:#fff;' idItem='<?php echo $row->idItem; ?>' class='clPadre' href='<?php echo base_url('panel/menus/edita_item/'. $row->idItem); ?>'> <?php echo $row->titulo; ?></a></span>	
																								 	<div  class='cont_act' style='float:right;margin-right:55px;'>
																									 	<a estado='<?php echo $row->estado; ?>' title='Activar/Desactivar Item' id="act_activar" class='item_link act_activar' href='<?php echo base_url('panel/menus/activa/'.$row->idItem); ?>'><i class='<?php echo $iconito; ?>'></i></a>  
																									</div>
																								</div>
																								<div class='span2 input-prepend' style='text-align: center;'>
																									<input type='number' name='orden' class='orden span4' value='<?php echo $row->orden; ?>' data-id='<?php echo $row->idItem; ?>' id="<?php echo $row->idItem; ?>">
																								</div>
																								<div class='span2' style='text-align: center;'>
																									<a title='Editar Item'  class='item_link act_editar' href='<?php echo base_url('panel/menus/edita_item/'.$row->idItem); ?>'><i class='icon-pencil'></i></a>
																								</div>
																								<div class='span2' style='text-align: center;'>
																									<a title='Eliminar Item'  class='item_link act_eliminar_hijo' data-id='<?php echo $row->idItem; ?>' href='<?php echo base_url('panel/menus/elimina_item/'.$row->idItem); ?>'><i class='icon-remove-sign'></i></a> 
																								</div>
																							</div>
																					<?php }else{ ?>
																						<li style='list-style:none;margin:0;'>
																							<div class="row-fluid" style="border-bottom: solid 1px #dfdfdf;padding-top: 5px;">
																								<div class='span6 cont_items_first' style='text-align: left;'>
																									<span class='label label-inverse'><a <?php echo $color; ?> style='color:#fff;' idItem='<?php echo $row->idItem; ?>' class='clPadre' href='<?php echo base_url('panel/menus/edita_item/'. $row->idItem); ?>'> <?php echo $row->titulo; ?></a></span>	
																								 	<div  class='cont_act' style='float:right;margin-right:55px;'>
																									 	<a estado='<?php echo $row->estado; ?>' title='Activar/Desactivar Item' id="act_activar" class='item_link act_activar' href='<?php echo base_url('panel/menus/activa/'.$row->idItem); ?>'><i class='<?php echo $iconito; ?>'></i></a>  
																									</div>
																								</div>
																								<div class='span2 input-prepend' style='text-align: center;'>
																									<input type='number' name='orden' class='orden span4' value='<?php echo $row->orden; ?>' data-id='<?php echo $row->idItem; ?>' id="<?php echo $row->idItem; ?>">
																								</div>
																								<div class='span2' style='text-align: center;'>
																									<a title='Editar Item'  class='item_link act_editar' href='<?php echo base_url('panel/menus/edita_item/'.$row->idItem); ?>'><i class='icon-pencil'></i></a>
																								</div>
																								<div class='span2' style='text-align: center;'>
																									<a title='Eliminar Item'  class='item_link act_eliminar_hijo' data-id='<?php echo $row->idItem; ?>' href='<?php echo base_url('panel/menus/elimina_item/'.$row->idItem); ?>'><i class='icon-remove-sign'></i></a> 
																								</div>
																							</div>
																					<?php } ?>
																					</li>	
																				<?php if($hijos > 0){ 
																					$padre1 = $row->idItem;
																					$items1 = $this->menu->dameItemsMenu($menu->id,$padre1); ?>
																					<?php //var_dump($items1) ?>
																					<?php foreach($items1 as $row1){ ?>
																							<li>
																							<div class="row-fluid" style="border-bottom: solid 1px #dfdfdf;padding-top: 5px;">
																								<div class='span6 cont_items_first' style='text-align: left;'>
																									<i class="icon-circle-arrow-right"></i> <a <?php echo $color; ?> idItem='<?php echo $row1->idItem; ?>' class='clPadre' href='<?php echo base_url('panel/menus/edita_item/'. $row1->idItem); ?>'> <?php echo $row1->titulo; ?></a>
																								 	<div  class='cont_act' style='float:right;margin-right:55px;'>
																									 	<a estado='<?php echo $row1->estado; ?>' title='Activar/Desactivar Item' id="act_activar" class='item_link act_activar' href='<?php echo base_url('panel/menus/activa/'.$row1->idItem); ?>'><i class='<?php echo $iconito; ?>'></i></a>  
																									</div>
																								</div>
																								<div class='span2 input-prepend' style='text-align: center;'>
																									<input type='number' name='orden' class='orden span4' value='<?php echo $row1->orden; ?>' data-id='<?php echo $row1->idItem; ?>' id="<?php echo $row1->idItem; ?>">
																								</div>
																								<div class='span2' style='text-align: center;'>
																									<a title='Editar Item'  class='item_link act_editar' href='<?php echo base_url('panel/menus/edita_item/'.$row1->idItem); ?>'><i class='icon-pencil'></i></a>
																								</div>
																								<div class='span2' style='text-align: center;'>
																									<a title='Eliminar Item'  class='item_link act_eliminar_hijo' data-id='<?php echo $row1->idItem; ?>' href='<?php echo base_url('panel/menus/elimina_item/'.$row1->idItem); ?>'><i class='icon-remove-sign'></i></a> 
																								</div>
																							</div>
																							</li>
																					<?php } ?>
																				<?php } ?>
																		<?php }?>
																</ul>
															</div>
														</div>
									      			</div>
									      		</div>
									      	</div>
									    </div>
									</div>
								<?php } ?>
							</div>
						</div>

						<?php } ?>
					</div>
				</div>
			</div>
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
	<!-- End div class="wrapper container" -->
<script type="text/javascript">

	$(".collapse").collapse();

		$(function(){
			$(".btndel").click(function(e){
				e.preventDefault();
				if(!confirm("Esta seguro que desea eliminar a este menu?")) { 
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

		/*$(function(){
			$(".cont_items_first").live("mouseover",function(){
				var div = $(this).find("div.cont_act");
				div.find("a.item_link").show();
			});

			$(".cont_items_first").live("mouseout",function(){
				$("a.item_link").hide();
			});

		});*/

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
			$(".act_eliminar_hijo").live("click",function(e){
				e.preventDefault();
				var valorId = $(this).attr('data-id');
				var answer = confirm("Esta seguro que desea eliminar definitivamente este elemento?");
				if (answer){
					$.post("<?php echo base_url('panel/menus/borrar_item'); ?>", { id: valorId});
					$(this).closest("li").remove();
				}				
			});
		});

		$(function(){
			$("#act_activar").live("click",function(e){
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

		$(document).on("change",".orden",function(e){
			var _ordenMenu = $(this).val();
			var _idItem = $(this).attr('data-id');
			$.ajax({
	          url: '<?php echo base_url("panel/menus/ordenar"); ?>',
	          async: false,
	          type: 'POST',
	          data: {id_item: _idItem, orden: _ordenMenu,menu_principal:"<?php echo $menu->id ?>"}
	        })
	        .success(function(data){
	          console.log(data);
	          if (data != "0") {
	            console.log(data);
	          	$('#elementosmenus').html(data);
	          }else{
	            console.log('valio barriga');
	          }
	        });
		});


</script>
</body>
</html>
