<?php $this->load->view('/public/helper/head_1.php'); ?>
<meta name="title" content="<?php echo $pagina->m_titulo; ?>">
<meta name="description" content="<?php echo $pagina->m_descripcion; ?>">
</head>
<body>
<?php $this->load->view('/public/helper/main_menu.php'); ?>
	<div class="container">
    	<div class="row">
        	<div class="span12 titulos">
            	<h2 class="principal"><span><?=$pagina->titulo;?></span></h2>
        	</div>  
    	</div>
        <?php  $inicio = '/'; $base1 = '/portafolio/';?>
		<p class="breadcrums">
			<a href="<?php echo base_url(''.$inicio); ?>">Inicio</a> / 
			<a href="<?php echo base_url(''.$base1); ?>">Portafolio</a> / <?php echo $pagina->titulo; ?>
		</p>
		<div class="row">            	
	 	    <div class="span3">
	 	    	<ul id="art_portafolio">
	 	            <?php if(!$articulos_ed){ ?>
					No se encontraron artículos.
					<?php }else{ ?>
	 	            <?php foreach ($articulos_ed as $item): ?>
	 	            <?php $active = ""; $mhref = base_url('/paginas/proyectos/'.$item->slug); 
	 	            if($mhref == current_url()){
                	$active = "active";
            		} ?>
						<li class="portafolio <?php echo $active; ?>"><a href="<?php echo base_url('/paginas/proyectos/'.$item->slug); ?>"><?php echo $item->titulo; ?></a></li>	
					<?php endforeach ?><?php } ?>
	 	        </ul>	
	 	    </div>
	 	    <div class="span9">	
 	        	<div style="text-align:right;" class="fecha-nota">
				<!-- Escrito por <?php echo $pagina->id_autor; ?> /  --><span class="label"><?php echo $this->alinecms->dameFechaFormato($pagina->fecha_publicacion); ?></span>
				</div>
 	            <p>
 	             	<?php $imagen = $pagina->imagen;
 	             	if (strlen($imagen) > 3) { ?>
 	             	<p style="text-align:center;"><img class="porta" src="<?php echo base_url('assets/img/'.$pagina->imagen); ?>"></p>
 	             	<?php }?>
 	             	<?php echo $pagina->contenido; ?>
 	            </p>
 	            <div id="share">
                    <span class="st_facebook" displayText="Facebook"></span>
                    <span class="st_twitter" displayText="Tweet"></span>
                </div>
 	        </div>
 	    </div> 
    <div id="banners-hor">
        <?=$menu_left?>
    </div>

</div>
			<!-- Le main content -->
				<?php $this->load->view('public/helper/footer.php'); ?>
	
	
	</body>
</html>
