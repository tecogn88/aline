<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class="active"><a href="<?php echo base_url('panel/banners/crea_banner'); ?>" >Panel de Banners</a></li>
						</ul>
					</div>
				</aside>
				<div id="body_content" class="span10 panel_usuarios">
					<div class="well">
						<div class="row-fluid">
							<div class="span9">
								<h2>Banners <small>Administra los banners publicitarios de tu página</small></h2>
							</div>
							<div class="pull-right">
								<a id="btn_crea_banner" class="btn btn-primary" href="<?php echo base_url('panel/banners/crea_banner'); ?>">Crear Banner <i class="icon-plus icon-white"></i></a>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<?php if(!$banners){ ?>
							<div class="alert"><h3>Aun no se han creado banners publicitarios!</h3></div>
						<?php }else{ ?>
							<div class="row-fluid">
							<?php $contador = 0; ?>
							<?php foreach ($banners as $banner){ ?>
								<?php $contador++; ?>
								<div class="span3 thumbnail" style="text-align:center;margin-bottom:10px;">
									<?php if(strlen( trim($banner->nombre) ) > 20 ) { ?>
										<h4 style="margin-bottom:5px;"><?php echo substr($banner->nombre, 0,15).'...'; ?></h4>
									<?php }else{ ?>
										<h4 style="margin-bottom:5px;"><?php echo $banner->nombre; ?></h4>
									<?php } ?>
									<?php if ($banner->imagen){ ?>
										<img src="<?php echo base_url('assets/media/banners/'.$banner->imagen); ?>" style="max-height:150px;">
									<?php }else{ ?>
										<img src="<?php echo base_url('assets/admin/img/ico/retina/man_64.png'); ?>" style="margin: 26px auto 10px auto;">
										<?php } ?>
									<br>
									<p>
										<a class="badge badge-success" href="<?=base_url('/panel/banners/edita_banner/'.$banner->id)?>" rel="tooltip" title="Editar banner:<br /><?=$banner->nombre?>"><i class="icon-edit icon-white"></i></a>
										<a class="badge badge-important btndel" href="<?=base_url('panel/banners/borrar_banner/'.$banner->id)?>" rel="tooltip" title="Borrar banner:<br /><?=$banner->nombre?>"><i class="icon-remove icon-white"></i></a>
									</p>
								</div>
								<?php if ($contador%4 == 0): ?>
									</div><div class="row-fluid">
								<?php endif ?> 
							<?php } ?><!-- Fin foreach -->
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
	<!-- End div class="wrapper container" -->
<script type="text/javascript">
		
		$(function(){
			$(".btndel").click(function(e){
				e.preventDefault();
				if(!confirm("Esta seguro que desea eliminar a este banner?")) { 
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
