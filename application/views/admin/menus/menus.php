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
					<div class="row-fluid">
						<?php if($menues == FALSE){ ?>
							<p>Aún no hay menus creados.</p>
						<?php }else{ ?>
						<div class="row-fluid">
							<?php $contador = 0; ?>
							<?php foreach ($menues->result() as $menu){ ?>
								<?php $contador++; ?>
								<div class="span2 thumbnail" style="text-align:center;margin-bottom:10px;">
									<div class="well well-small">
										<?php if(strlen( trim($menu->titulo) ) > 20 ) { ?>
											<h4 style="margin-bottom:5px;"><?php echo substr($menu->titulo, 0,15).'...'; ?></h4>
										<?php }else{ ?>
											<h4 style="margin-bottom:5px;"><?php echo $menu->titulo; ?></h4>
										<?php } ?>
									</div>
									<img src="<?php echo base_url('assets/admin/img/ico/retina/tray_full_64.png');?>" alt="">
									<hr>
									<p>
										<a class='badge badge-info	agrega_item' href='<?php echo base_url("/panel/menus/agrega_item/".$menu->id); ?>' rel='tooltip' title='Agrega items al menú: <br/>"<?php echo $menu->titulo; ?>"'><i class='icon-plus icon-white'></i></a>
										<a class='badge badge-warning' href='<?php echo base_url("/panel/menus/elementosMenu/".$menu->id); ?>'><i class='icon-eye-open icon-white'></i></a>  
										<a class='badge badge-success' href='<?php echo base_url("/panel/menus/edita_menu/".$menu->id); ?>' rel='tooltip' title='Editar menú:  <br/>"<?php echo $menu->titulo; ?> "'><i class='icon-edit icon-white'></i></a> 
										<a class='badge badge-important btndel' href='<?php echo base_url("/panel/menus/borra_menu/".$menu->id); ?>' rel='tooltip' title='Borrar menú: <br/>"<?php echo $menu->titulo; ?>"'><i class='icon-remove icon-white'></i></a>
									</p>
								</div>
								<?php if ($contador%6 == 0): ?>
									</div><div class="row-fluid">
								<?php endif ?> 
							<?php } ?><!-- Fin foreach -->
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
