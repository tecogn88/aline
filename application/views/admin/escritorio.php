<?=$head?>
<body>
<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<div id="body_content" class="span12">
					<div class="row-fluid">
						<div class="well2">
							<div class="span10">
								<h1>Panel principal <small>Administre su sitio de manera sencilla y rápida.</small></h1>
							</div>
							<div class="span2">
								<a class="btn btn-inverse" href="<?php echo base_url('panel/configuracion'); ?>"><span style='margin-right:10px;'><i class='icon-cog icon-white'></i></span><b>Configuración general</b></a>
							</div>
						</div>
					</div>
				      
				      <div id="content_escritorio" style="margin:0 auto;">
						  <ul class="thumbnails">
						    <li class="span2">
						      <div class="thumbnail">
						        <span style="float:right;" class="badge-small badge-info">
						        	<a title="Agregar usuario" class="pop_red" href="<?php echo base_url('panel/usuarios/nuevo_usuario'); ?>" ><i class="icon-plus-sign icon-white"></i></a>
						        	<?php //echo $users; ?>
						        </span>
						      	<a href="<?php echo base_url('panel/usuarios'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/man_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;"><a class="link-panel" href="<?php echo base_url('panel/usuarios'); ?>">Usuarios</a></h4>
						        </div>
						      </div>
						    </li>

						    <!-- Acceso al blog -->
						    <?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'blog' ")) == 1 ){ ?>
						    <li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						        	<a title="Agregar usuario" class="pop_red" href="<?php echo base_url('panel/usuarios/nuevo_usuario'); ?>" ><i class="icon-plus-sign icon-white"></i></a>
						        	<?php //echo $users; ?>
						        </span>
						      	<a href="<?php echo base_url('panel/blog'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/pencil_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          	<a href="<?php echo base_url('panel/blog'); ?>"><h4 class="label label-info" style="text-align:center;">Blog</h4></a>
						        </div>
						      </div>
						    </li>
						    <?php } ?>
						    <li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						      		<a title="Agregar página" class="pop_red" href="<?php echo base_url('/panel/post/crea_pagina'); ?>" ><i class="icon-plus-sign icon-white"></i></a>
						      		<?php //echo $paginas; ?>
						      	</span>
						      	<a href="<?php echo base_url('panel/post/panel_paginas'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/app_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;"><a class="link-panel" href="<?php echo base_url('panel/post/panel_paginas'); ?>">Páginas</a></h4>
						        </div>
						      </div>
						    </li>

						    <li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						      		<a title="Agregar menú" class="pop_red" href="<?php echo base_url('panel/menus/crea_menu'); ?>" ><i class="icon-plus-sign icon-white"></i></a>
						      		<?php //echo $menus; ?>
						      	</span>
						      	<a  href="<?php echo base_url('panel/menus'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/tray_full_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style=""><a class="link-panel" href="<?php echo base_url('panel/menus'); ?>">Menús</a></h4>
						        </div>
						      </div>
						    </li>

						    <li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						      		<a title="Agregar slide" class="pop_red" href="<?php echo base_url('panel/slider/nuevoSlide'); ?>" ><i class="icon-plus-sign icon-white"></i></a>
						      		<?php //echo $slides; ?>
						      	</span>
						      	<a href="<?php echo base_url('panel/slider'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/display_off_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;"><a class="link-panel" href="<?php echo base_url('panel/slider'); ?>">Slider</a></h4>
						        </div>
						      </div>
						    </li>

						    <!-- acceso a los modulos html -->
						    <?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'modulos' ")) == 1 ){ ?>
							<li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						      		<a href="<?php echo base_url('panel/modulos/nuevoModulo'); ?>" ><i class="icon-plus-sign icon-white"></i></a>
						      		<?php //echo $modules; ?>
						      	</span>
						      	<a href="<?php echo base_url('panel/modulos'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/app_globe_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;"><a class="link-panel" href="<?php echo base_url('panel/modulos'); ?>">Modulos</a></h4>
						        </div>
						      </div>
						    </li>
						    <?php } ?>

						    <!-- <li class="span2">
						      <div class="thumbnail">
						      	<?php if($banners !=0){ ?>
						      		<span style="float:right;" class="badge-small badge-info">
						      			<a href="<?php echo base_url('panel/banners/crea_banner'); ?>"><i class="icon-plus-sign icon-white"></i></a>
						      			<?php //echo $banners; ?>
						      		</span>
						      	<?php }else{ ?>
						      		<span style="float:right;" class="badge"><?php echo $banners; ?></span>
						      	<?php } ?>
						      	<a href="<?php echo base_url('panel/banners'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/speaker_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;"><a class="link-panel" href="<?php echo base_url('panel/banners'); ?>">Banners</a></h4>
						        </div>
						      </div>
						    </li> -->

						    </ul>
							<ul class="thumbnails">
							<!-- Acceso al panel de socios -->
							<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'alianzas' ")) == 1 ){ ?>
						    <li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						      		<a href="#" ><i class="icon-plus-sign icon-white"></i></a>
						      		<?php //echo $modules; ?>
						      	</span>
						      	<a href="<?php echo base_url('panel/alianzas'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/case_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          	<a href="<?php echo base_url('panel/alianzas'); ?>"><h4 class="label label-info" style="text-align:center;">Socios</h4></a>
						        </div>
						      </div>
						    </li>
						    <?php } ?>

						    <!-- Acceso al Catalogo -->
						    <?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'catalogos' ")) == 1 ){ ?>
						    <li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						      		<a href="#" ><i class="icon-plus-sign icon-white"></i></a>
						      		<?php //echo $modules; ?>
						      	</span>
						      	<a href="<?php echo base_url('panel/catalogo/administra_catalogos'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/book_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <a href="<?php echo base_url('panel/catalogo/administra_catalogos'); ?>"><h4 class="label label-info" style="text-align:center;">Catálogos</h4></a>
						        </div>
						      </div>
						    </li>
						    <?php } ?>

						    <!-- Acceso a las galerias -->
						    <?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'galerias' ")) == 1 ){ ?>
						    <li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						      		<a href="#" ><i class="icon-plus-sign icon-white"></i></a>
						      		<?php //echo $modules; ?>
						      	</span>
						      	<a href="<?php echo base_url('panel/galerias'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/frame_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          	<a href="<?php echo base_url('panel/galerias'); ?>"><h4 class="label label-info" style="text-align:center;">Galerias</h4></a>
						        </div>
						      </div>
						    </li>
						    <?php } ?>

						    <!-- Acceso a las descargas -->
						    <?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'documentos' ")) == 1 ){ ?>
						    <li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						      		<a href="#" ><i class="icon-plus-sign icon-white"></i></a>
						      		<?php //echo $modules; ?>
						      	</span>
						      	<a href="<?php echo base_url('panel/acervo'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/outbox_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          	<a href="<?php echo base_url('panel/acervo'); ?>"><h4 class="label label-info" style="text-align:center;">Descargas</h4></a>
						        </div>
						      </div>
						    </li>
						    <?php } ?>

						    <!-- Acceso a los eventos -->
						    <?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'eventos' ")) == 1 ){ ?>
						    <li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						      		<a href="#" ><i class="icon-plus-sign icon-white"></i></a>
						      		<?php //echo $modules; ?>
						      	</span>
						      	<a href="<?php echo base_url('panel/eventos'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/calendar_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          	<a href="<?php echo base_url('panel/eventos'); ?>"><h4 class="label label-info" style="text-align:center;">Eventos</h4></a>
						        </div>
						      </div>
						    </li>
						    <?php } ?>

						    <!-- Acceso a los testimonios -->
						    <?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'testimonios' ")) == 1 ){ ?>
						    <li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						      		<a href="#" ><i class="icon-plus-sign icon-white"></i></a>
						      		<?php //echo $modules; ?>
						      	</span>
						      	<a href="<?php echo base_url('panel/testimonios'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/attach_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          	<a href="<?php echo base_url('panel/testimonios'); ?>"><h4 class="label label-info" style="text-align:center;">Testimonios</h4></a>
						        </div>
						      </div>
						    </li>
						    <?php } ?>
						</ul>
				  </div>
				</div>
			</div>
		<!-- Footer -->
		<?=$footer?>
	</div> 
	<!-- End div class="wrapper container" -->

	<script type="text/javascript">

		$(".info").hide().addClass("alert alert-info");
		$(document).ready(function(){
			$(".span2").addClass("animated bounceInDown");
		});
		
		$(document).ready(function(){
			$(".span2").live("mouseenter", function(){
				var division = $(this);
				$(this).find(".info").fadeIn("slow",function(){
					division.find("img").addClass("animated bounce");
				});
			});

			$(".span2").live("mouseleave",function(){
				var division = $(this);
				$(this).find(".info").hide();
				division.find("img").removeClass("animated bounce");
			});
		});
	</script>

	<script type="text/javascript">
		$('.pop_red').tooltip({
			trigger: 'hover',
			placement: 'bottom',
			animation: true
		});
	</script>

</body>
</html>
