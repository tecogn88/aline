<?php header('Content-Type: text/html; charset=UTF-8');   ?>

<header>
   <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo base_url();?>" target="_blank">NoriCMS</a>
          
          <?php if($this->alinecms->is_LoggedAdmin()) {?>
					<div class="btn-group pull-right">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<?php echo $this->alinecms->get_gravatar($this->session->userdata('email') ,18,TRUE) . " ";    echo $this->session->userdata('nombre'); ?>
						  <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
						  <li><a href="<?php echo base_url('/sesion/cerrar_sesion') ?>">Cerrar Sesion</a></li>
						</ul>
					</div>
          <?php } ?>

          <div class="nav-collapse">
            <ul class="nav">
					<li id="_0"  class="item">
						<a href="<?php echo base_url('panel/escritorio'); ?>">PANEL PRINCIPAL</a>
					</li>
					<li class="divider-vertical"></li>
					<li  id="_1" class="item" >
						<a href="<?php echo base_url('panel/usuarios'); ?>">Usuarios</a>
					</li>
					<!-- Menu de acceso al blog en el header -->
					<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'blog' ")) == 1 ){ ?>
					<li id="_2" class="item">
						<a href="<?php echo base_url('panel/blog'); ?>">Blog</a>
					</li>
					<?php } ?>
					<li id="_3" class="item">
						<a href="<?php echo base_url('panel/post/panel_paginas'); ?>">Páginas</a>
					</li>
					<li id="_4" class="item">
						<a href="<?php echo base_url('panel/menus'); ?>">Menús</a>
					</li>
					<li id="_5" class="item">
						<a href="<?php echo base_url('panel/configuracion'); ?>">Configuración</a>
					</li>
					<!-- Menu de acceso al catalogo en el header -->
					<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'catalogos' ")) == 1 ){ ?>
					<li id="_6" class="item">
						<a href="<?php echo base_url('panel/catalogo/administra_catalogos'); ?>">Catalogos</a>
					</li>
					<?php } ?>
					<!-- Menu de acceso al panel de socios en el header -->
					<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'alianzas' ")) == 1 ){ ?>
					<li id="_7" class="item">
						<a href="<?php echo base_url('panel/alianzas'); ?>">Socios</a>
					</li>
					<?php } ?>
					<li id="_8" class="item">
						<a href="<?php echo base_url('panel/slider'); ?>">Slider</a>
					</li>
					<!-- Menu de acceso al panel de descargas en el header -->
					<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'documentos' ")) == 1 ){ ?>
					<li id="_9" class="item">
						<a href="<?php echo base_url('panel/acervo'); ?>">Descargas</a>
					</li>
					<?php } ?>
					<!-- Menu de acceso al panel de galerias en el header -->
					<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'galerias' ")) == 1 ){ ?>
					<li id="_10" class="item">
						<a href="<?php echo base_url('panel/galerias'); ?>">Galerias</a>
					</li>
					<?php } ?>
					<!-- Menu de acceso al panel de eventos en el header -->
					<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'eventos' ")) == 1 ){ ?>
					<li id="_11" class="item">
						<a href="<?php echo base_url('panel/eventos'); ?>">Eventos</a>
					</li>
					<?php } ?>
					<!-- Menu de acceso al panel de testimonios en el header -->
					<?php if( mysql_num_rows(mysql_query("SHOW TABLES LIKE 'testimonios' ")) == 1 ){ ?>
					<li id="_12" class="item">
						<a href="<?php echo base_url('panel/testimonios'); ?>">Testimonios</a>
					</li>
					<?php } ?>
					<!-- <li id="_banners" class="item">
						<a href="<?php echo base_url('panel/banners'); ?>">Banners</a>
					</li>
 -->				</ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<script type="text/javascript">
$(".item").removeClass('active');
  <?php if( isset($menuactivo) && ! is_null($menuactivo) ){ ?>
	var menuactivo = "<?=$menuactivo?>";
	$("#<?=$menuactivo?>").addClass('active');
  <?php } ?>

	<?php if(isset($menuactivo) && $menuactivo == "--"): ?>
  		$(".item:not(:first)").hide();
	<?php endif; ?>

</script>


</header>
