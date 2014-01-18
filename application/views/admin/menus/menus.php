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
					<div class="page-header">
						<h2>Menús <small>Crea edita y elimina menus de navegación</small></h2>
					</div>
					<div class="row-fluid">
						<div class="well">
							<div class="span12">
								<a class="btn btn-primary" href="<?php echo base_url('panel/menus/crea_menu'); ?>">Nuevo Menu<span style='margin-left:10px;'><i class='icon-plus icon-white'></i></span></a>
							</div>
						</div>
					</div>
					<!-- <div class="row-fluid">
						<div class="span8">
							<h2>Menús</h2>
							<?//=$menus?>
						</div>
						<div id="cont_items_menu" class="span4">
							
							<div class='' id="items_menu_div"></div>
						</div>
					</div> -->
					<div class="row-fluid">
						<table id='tblMenus' class='table table-striped  table-bordered '>
							<tbody>
								<thead>
									<tr style='background-color: #D9EDF7;'>
										<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-barcode icon-white'></i></span>ID</th>
										<th><span class='label label-info' style='margin-right: 10px;'><i class='icon-font icon-white'></i></span>Titulo</th>
										<th class='cont_accion'><span class='label label-info' style='margin-right: 10px;'><i class='icon-wrench icon-white'></i></span>Acciones</th>
									</tr>
								</thead>
								<?php foreach ($menues->result() as $row){ ?>
			    				<tr title='<?php echo $row->descripcion; ?>'>
			    					<td style='font-style:italic;font-weight:bold;'><?php echo $row->id; ?></td>
		    						<td><a href='<?php echo base_url("/panel/menus/elementosMenu/".$row->id); ?>'><?php echo $row->titulo  ?></a></td>
		    						<td>
		    							<div class='cont_accio'>
											<a class='badge badge-info	agrega_item' href='<?php echo base_url("/panel/menus/agrega_item/".$row->id); ?>' rel='tooltip' title='Agrega items al menú: <br/>"<?php echo $row->titulo; ?>"'><i class='icon-plus icon-white'></i></a>
											<a class='badge badge-warning' href='<?php echo base_url("/panel/menus/elementosMenu/".$row->id); ?>'><i class='icon-eye-open icon-white'></i></a>  
											<a class='badge badge-success' href='<?php echo base_url("/panel/menus/edita_menu/".$row->id); ?>' rel='tooltip' title='Editar menú:  <br/>"<?php echo $row->titulo; ?> "'><i class='icon-edit icon-white'></i></a> 
											<a class='badge badge-important btndel' href='<?php echo base_url("/panel/menus/borra_menu/".$row->id); ?>' rel='tooltip' title='Borrar menú: <br/>"<?php echo $row->titulo; ?>"'><i class='icon-remove icon-white'></i></a>  
										</div>
									</td>
				    			</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
	<!-- End div class="wrapper container" -->
<script type="text/javascript">
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

		$(function(){
			$(".cont_items_first").live("mouseover",function(){
				//$("a.item_link").hide();
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
