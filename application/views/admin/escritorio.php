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
						        	<a href="<?php echo base_url('panel/usuarios/nuevo_usuario'); ?>" ><i class="icon-plus-sign icon-white"></i></a>
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
						    <!-- <li class="span2">
						      <div class="thumbnail">
						      	<a href="<?php echo base_url('panel/blog'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/pencil_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;">Blog</h4>
						          <p class="info" style="text-align:center;">Accede al panel del blog y crea, edita o elimina categorias y articulos de tu blog.</p>
						        </div>
						      </div>
						    </li> -->

						    <li class="span2">
						      <div class="thumbnail">
						      	<span style="float:right;" class="badge-small badge-info">
						      		<a href="<?php echo base_url('/panel/post/crea_pagina'); ?>" ><i class="icon-plus-sign icon-white"></i></a>
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
						      		<a href="<?php echo base_url('panel/menus/crea_menu'); ?>" ><i class="icon-plus-sign icon-white"></i></a>
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
						      		<a href="<?php echo base_url('panel/slider/nuevoSlide'); ?>" ><i class="icon-plus-sign icon-white"></i></a>
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

						    <li class="span2">
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
						    </li>

						    </ul>
							<ul class="thumbnails">
							<!-- Acceso al panel de socios -->
						    <!-- <li class="span2">
						      <div class="thumbnail">
						      	<a href="<?php echo base_url('panel/alianzas'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/case_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;">Socios</h4>
						          <p class="info" style="text-align:center; ">Accede al panel de los socios comerciales, aquí podras crear, editar y eliminar socios comerciales.</p>
						        </div>
						      </div>
						    </li> -->

						    <!-- Acceso al Catalogo -->
						    <!-- <li class="span2">
						      <div class="thumbnail">
						      	<a href="<?php echo base_url('panel/catalogo'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/book_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;">Catálogos</h4>
						          <p class="info" style="text-align:center; ">Accede al panel de catalogos, aquí podras crear, editar y eliminar catálogos, categorias y productos.</p>
						        </div>
						      </div>
						    </li> -->

						    <!-- Acceso a las galerias -->
						    <!-- <li class="span2">
						      <div class="thumbnail">
						      	<a href="<?php echo base_url('panel/galerias'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/frame_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;">Galerias</h4>
						          <p class="info" style="text-align:center; ">Accede al panel de galerias, aquí podras crear, editar y eliminar galerias.</p>
						        </div>
						      </div>
						    </li> -->

						    <!-- Acceso a las descargas -->
						    <!-- <li class="span2">
						      <div class="thumbnail">
						      	<a href="<?php echo base_url('panel/acervo'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/outbox_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;">Descargas</h4>
						          <p class="info" style="text-align:center; ">Accede al panel de descargas, aquí podras crear, editar o eliminar descargas.</p>
						        </div>
						      </div>
						    </li> -->

						    <!-- Acceso a los eventos -->
						    <!-- <li class="span2">
						      <div class="thumbnail">
						      	<a href="<?php echo base_url('panel/eventos'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/calendar_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;">Eventos</h4>
						          <p class="info" style="text-align:center; ">Accede al panel del calendario de eventos.</p>
						        </div>
						      </div>
						    </li> -->

						    <!-- Acceso a los testimonios -->
						    <!-- <li class="span2">
						      <div class="thumbnail">
						      	<a href="<?php echo base_url('panel/testimonios'); ?>">
						      		<div class="cont_ico">
						           		<img src="<?php echo base_url('assets/admin/img/ico/retina/attach_64.png');?>" alt="">
						            </div>
						    	</a>
						        <div class="caption">
						          <h4 class="label label-info" style="text-align:center;">Testimonios</h4>
						          <p class="info" style="text-align:center; ">Accede al panel de testimonios, aquí podras crear, editar y eliminar los testimonios.</p>
						        </div>
						      </div>
						    </li> -->
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

</body>
</html>
