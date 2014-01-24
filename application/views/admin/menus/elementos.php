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
						<h2>Items de: <b class="alert alert-info"><?php echo $menu->row('titulo'); ?></b><small> Crea edita y elimina items del menu <i><?php echo $menu->row('titulo'); ?></i></small></h2>
					</div>
					<div class="row-fluid">
						<div class="well">
							<div class="span12">
								<a class="btn btn-primary" href="<?php echo base_url('panel/menus/crea_menu'); ?>">Nuevo Menu<span style='margin-left:10px;'><i class='icon-plus icon-white'></i></span></a>
								<a class='btn btn-warning' href='<?php echo base_url("/panel/menus/agrega_item/".$id); ?>'>Nuevo Item <i class='icon-plus icon-white'></i></a>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="well">
							<table id='tblMenus' class='table table-striped  table-bordered ' style="margin-bottom:0px;">
								<thead>
									<tr style='background-color: #D9EDF7;'>
										<th class="span6"><span class='label label-info' style='margin-right: 10px;'><i class='icon-font icon-white'></i></span>Nombre</th>
										<th class='span2' style='text-align: center;'>
											<span class='label label-info' style='margin-right: 10px;'><i class='icon-list icon-white'></i></span>Orden 
											<span class="badge badge-success" id='guarda_orden' style='float:right;display:none;'><a href='#'><i class='icon-ok icon-white'></i></a></span>
										</th>
										<th class='span2' style='text-align: center;'><span class='label label-info' style='margin-right: 10px;'><i class='icon-list icon-white'></i></span>Editar</th>
										<th class='span2' style='text-align: center;'><span class='label label-info' style='margin-right: 10px;'><i class='icon-list icon-white'></i></span>Eliminar</th>
									</tr>
								</thead>
							</table>
							<div id="elementosmenus">
								<?php echo $menus; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
	<!-- End div class="wrapper container" -->
<script type="text/javascript">
	
	$("#guarda_orden").on("click",function(e){
		var _orden = $('#orden').val();
		alert(_orden);
	});

	$(document).on("change",".orden",function(e){
		var _ordenMenu = $(this).val();
		var _idItem = $(this).attr('data-id');
		$.ajax({
          url: '<?php echo base_url("panel/menus/ordenar"); ?>',
          async: false,
          type: 'POST',
          data: {id_item: _idItem, orden: _ordenMenu,menu_principal:"<?php echo $id ?>"}
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

			/*$(".cont_items_first").live("mouseout",function(){
				$("a.item_link").hide();
			});*/

		});


		$(function(){
			$(".act_eliminar").live("click",function(e){
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